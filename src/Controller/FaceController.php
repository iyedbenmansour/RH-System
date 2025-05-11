<?php
namespace App\Controller;

use App\Entity\Face;
use App\Repository\FaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class FaceController extends AbstractController
{
    private $apiKey;
    private $apiSecret;
    private $apiUrl;
    private $cache;
    private $facesetToken;
    private $faceRepository;
    private $entityManager;

    public function __construct(
        FaceRepository $faceRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->apiKey = 'EkKSSClAqSK6Az6AfswteRtBfhJ6dAAR';
        $this->apiSecret = 'XCeCheUscy9EL4iOQbA6EeHenO2WI3WP';
        $this->apiUrl = 'https://api-us.faceplusplus.com/facepp/v3/';
        $this->cache = new FilesystemAdapter();
        $this->faceRepository = $faceRepository;
        $this->entityManager = $entityManager;
        $this->facesetToken = $this->initializeFaceset();
    }

   
#[Route('/face/upload', name: 'face_upload', methods: ['GET', 'POST'])]
public function upload(Request $request): Response
{
    if ($request->isMethod('POST')) {
        $userId = $request->get('user_id');
        $imageData = $request->get('image_data');

        if ($userId && $imageData) {
            try {
                $this->checkRateLimit();
                
                // Convert base64 to UploadedFile
                $imageFile = $this->base64ToUploadedFile($imageData, 'user_' . $userId . '.jpg');

                // Save image physically (optional)
                $uploadsDir = $this->getParameter('kernel.project_dir') . '/public/uploads/faces';
                if (!file_exists($uploadsDir)) {
                    mkdir($uploadsDir, 0755, true);
                }

                $newFilename = uniqid('face_') . '.jpg';
                $imageFile->move($uploadsDir, $newFilename);

                // Upload to Face++
                $savedFile = new UploadedFile(
                    $uploadsDir . '/' . $newFilename,
                    $newFilename,
                    'image/jpeg',
                    null,
                    true
                );
                $faceToken = $this->uploadToFacePlusPlus($savedFile);

                if ($faceToken) {
                    $this->addToFaceset($faceToken);

                    // Save to DB
                    $face = new Face();
                    $face->setImage('/uploads/faces/' . $newFilename)
                        ->setUserId((int)$userId)
                        ->setFaceToken($faceToken);

                    $this->entityManager->persist($face);
                    $this->entityManager->flush();

                    return new JsonResponse([
                        'success' => true,
                        'message' => 'Face uploaded and saved successfully!'
                    ]);
                }
            } catch (\Exception $e) {
                return new JsonResponse([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 400);
            }
        }

        return new JsonResponse([
            'success' => false,
            'error' => 'Please provide both user ID and image.'
        ], 400);
    }

    return $this->render('face/upload.html.twig');
}


private function base64ToUploadedFile(string $base64, string $filename): UploadedFile
{
    $data = explode(',', $base64);
    $data = base64_decode($data[1]);
    $filePath = sys_get_temp_dir().'/'.$filename;
    file_put_contents($filePath, $data);
    
    return new UploadedFile(
        $filePath,
        $filename,
        'image/jpeg',
        null,
        true
    );
}

    #[Route('/face/check', name: 'face_check', methods: ['GET', 'POST'])]
    public function check(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            /** @var UploadedFile $imageFile */
            $imageFile = $request->files->get('image');

            if ($imageFile) {
                try {
                    $this->checkRateLimit();
                    $result = $this->checkFace($imageFile);
                    return new JsonResponse($result);
                } catch (\Exception $e) {
                    return new JsonResponse(['error' => $e->getMessage()], 400);
                }
            }
            return new JsonResponse(['error' => 'No image provided'], 400);
        }

        return $this->render('face/check.html.twig');
    }

    private function initializeFaceset(): string
    {
        return $this->cache->get('faceset_token', function (ItemInterface $item) {
            $client = new Client();
            
            try {
                // Try to get existing faceset
                $response = $client->post($this->apiUrl . 'faceset/getfacesets', [
                    'form_params' => [
                        'api_key' => $this->apiKey,
                        'api_secret' => $this->apiSecret,
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                if (!empty($data['facesets'])) {
                    return $data['facesets'][0]['faceset_token'];
                }

                // Create new faceset if none exists
                $response = $client->post($this->apiUrl . 'faceset/create', [
                    'form_params' => [
                        'api_key' => $this->apiKey,
                        'api_secret' => $this->apiSecret,
                        'display_name' => 'MyFaceset',
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                return $data['faceset_token'];
            } catch (\Exception $e) {
                throw new \RuntimeException('Faceset initialization failed: ' . $e->getMessage());
            }
        });
    }

    private function addToFaceset(string $faceToken): void
    {
        $client = new Client();

        try {
            $client->post($this->apiUrl . 'faceset/addface', [
                'form_params' => [
                    'api_key' => $this->apiKey,
                    'api_secret' => $this->apiSecret,
                    'faceset_token' => $this->facesetToken,
                    'face_tokens' => $faceToken,
                ],
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to add face to faceset: ' . $e->getMessage());
        }
    }

    private function uploadToFacePlusPlus(UploadedFile $imageFile): string
    {
        $client = new Client();

        try {
            $response = $client->post($this->apiUrl . 'detect', [
                'multipart' => [
                    ['name' => 'api_key', 'contents' => $this->apiKey],
                    ['name' => 'api_secret', 'contents' => $this->apiSecret],
                    ['name' => 'image_file', 'contents' => fopen($imageFile->getPathname(), 'r')],
                    ['name' => 'return_landmark', 'contents' => '1'],
                ],
                'timeout' => 10,
            ]);

            $data = json_decode($response->getBody(), true);
            if (empty($data['faces'])) {
                throw new \RuntimeException('No faces detected in the image.');
            }

            return $data['faces'][0]['face_token'];
        } catch (\Exception $e) {
            throw new \RuntimeException('Face detection failed: ' . $e->getMessage());
        }
    }

    private function checkFace(UploadedFile $imageFile): array
{
    $client = new Client();

    try {
        $faceToken = $this->uploadToFacePlusPlus($imageFile);

        $response = $client->post($this->apiUrl . 'search', [
            'form_params' => [
                'api_key' => $this->apiKey,
                'api_secret' => $this->apiSecret,
                'face_token' => $faceToken,
                'faceset_token' => $this->facesetToken,
            ],
            'timeout' => 10,
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['error_message'])) {
            throw new \RuntimeException($data['error_message']);
        }

        $matchedToken = $data['results'][0]['face_token'] ?? null;
        $userId = $this->findUserIdByFaceToken($matchedToken);

        return [
            'confidence' => $data['results'][0]['confidence'] ?? 0,
            'face_token' => $matchedToken,
            'user_id' => $userId,
        ];

    } catch (\Exception $e) {
        throw new \RuntimeException('Face recognition failed: ' . $e->getMessage());
    }
}


  private function findUserIdByFaceToken(?string $faceToken): ?int
{
    if (!$faceToken) {
        return null;
    }

    $face = $this->faceRepository->findOneBy(['face_token' => $faceToken]);
    return $face ? $face->getUserId() : null;
}


    private function checkRateLimit(): void
    {
        $lastCall = $this->cache->getItem('faceplusplus_last_call');
        if ($lastCall->isHit() && (time() - $lastCall->get()) < 1) {
            sleep(1);
        }
        $lastCall->set(time());
        $this->cache->save($lastCall);
    }
}