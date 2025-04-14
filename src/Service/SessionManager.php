<?php

namespace App\Service;

use App\Entity\Admin;
use App\Entity\Company;
use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionManager
{
    private $requestStack;
    private $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function loginAdmin(int $adminId): void
    {
        $session = $this->requestStack->getSession();
        $session->set('user_type', 'admin');
        $session->set('user_id', $adminId);
    }

    public function loginCompany(int $companyId): void
    {
        $session = $this->requestStack->getSession();
        $session->set('user_type', 'company');
        $session->set('user_id', $companyId);
    }

    public function loginCandidat(int $candidatId): void
    {
        $session = $this->requestStack->getSession();
        $session->set('user_type', 'candidat');
        $session->set('user_id', $candidatId);
    }

    public function logout(): void
    {
        $session = $this->requestStack->getSession();
        $session->remove('user_type');
        $session->remove('user_id');
    }

    public function isLoggedIn(): bool
    {
        $session = $this->requestStack->getSession();
        return $session->has('user_type') && $session->has('user_id');
    }

    public function getUserType(): ?string
    {
        $session = $this->requestStack->getSession();
        return $session->get('user_type');
    }

    public function getUserId(): ?int
    {
        $session = $this->requestStack->getSession();
        return $session->get('user_id');
    }

    public function getCurrentUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        $userType = $this->getUserType();
        $userId = $this->getUserId();

        switch ($userType) {
            case 'admin':
                return $this->entityManager->getRepository(Admin::class)->find($userId);
            case 'company':
                return $this->entityManager->getRepository(Company::class)->find($userId);
            case 'candidat':
                return $this->entityManager->getRepository(Candidat::class)->find($userId);
            default:
                return null;
        }
    }
}