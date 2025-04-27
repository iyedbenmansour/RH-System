<?php

namespace App\Service;

use App\Repository\JobRepository;
use App\Repository\ApplicantRepository;

class StatisticsService
{
    private $jobRepository;
    private $applicantRepository;

    public function __construct(JobRepository $jobRepository, ApplicantRepository $applicantRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->applicantRepository = $applicantRepository;
    }

    public function getCompanyStatistics(int $companyId): array
    {
        $jobs = $this->jobRepository->findBy(['companyId' => $companyId]);
        
        $stats = [
            'total_jobs' => count($jobs),
            'total_applications' => 0,
            'status_counts' => [
                'Pending' => 0,
                'Reviewed' => 0,
                'Interviewed' => 0,
                'Accepted' => 0,
                'Rejected' => 0,
            ],
            'jobs' => [],
        ];

        foreach ($jobs as $job) {
            $applications = $this->applicantRepository->findBy(['jobId' => $job->getId()]);
            $jobStats = [
                'id' => $job->getId(),
                'title' => $job->getTitle(),
                'total_applications' => count($applications),
                'status_counts' => [
                    'Pending' => 0,
                    'Reviewed' => 0,
                    'Interviewed' => 0,
                    'Accepted' => 0,
                    'Rejected' => 0,
                ],
            ];

            foreach ($applications as $application) {
                $status = $application->getStatus();
                $jobStats['status_counts'][$status]++;
                $stats['status_counts'][$status]++;
            }

            $stats['total_applications'] += $jobStats['total_applications'];
            $stats['jobs'][] = $jobStats;
        }

        // Calculate percentages
        $stats['acceptance_rate'] = $stats['total_applications'] > 0 
            ? round(($stats['status_counts']['Accepted'] / $stats['total_applications']) * 100, 2)
            : 0;

        return $stats;
    }

    public function getJobStatistics(int $jobId): array
    {
        $job = $this->jobRepository->find($jobId);
        $applications = $this->applicantRepository->findBy(['jobId' => $jobId]);

        $stats = [
            'job' => $job,
            'total_applications' => count($applications),
            'status_counts' => [
                'Pending' => 0,
                'Reviewed' => 0,
                'Interviewed' => 0,
                'Accepted' => 0,
                'Rejected' => 0,
            ],
            'applications' => $applications,
        ];

        foreach ($applications as $application) {
            $stats['status_counts'][$application->getStatus()]++;
        }

        return $stats;
    }
}