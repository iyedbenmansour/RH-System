<?php

namespace App\Service;

use App\Entity\LeaveRequest;
use App\Repository\LeaveRequestRepository;
use Knp\Bundle\TimeBundle\DateTimeFormatter;
use DateInterval;
use DatePeriod;
use DateTimeInterface;

class LeaveTimeCalculator
{
    private $leaveRequestRepo;
    private $dateTimeFormatter;

    public function __construct(
        LeaveRequestRepository $leaveRequestRepo,
        DateTimeFormatter $dateTimeFormatter
    ) {
        $this->leaveRequestRepo = $leaveRequestRepo;
        $this->dateTimeFormatter = $dateTimeFormatter;
    }

    public function getConfirmedLeaveDays(string $employeeId, ?string $type = null): int
    {
        $criteria = ['employeeId' => $employeeId, 'isConfirmed' => true];
        if ($type) {
            $criteria['leaveType'] = strtolower($type);
        }

        $confirmedRequests = $this->leaveRequestRepo->findBy($criteria);
        
        $totalDays = 0;
        foreach ($confirmedRequests as $request) {
            $totalDays += $this->calculateWorkingDays(
                $request->getStartDate(),
                $request->getEndDate()
            );
        }
        
        return $totalDays;
    }

    public function calculateWorkingDays(DateTimeInterface $start, DateTimeInterface $end): int
    {
        $interval = new DateInterval('P1D');
        // Convert to DateTimeImmutable to guarantee modify() is available
        $endImmutable = \DateTimeImmutable::createFromInterface($end);
        $endPlusOne = $endImmutable->modify('+1 day');
        $period = new DatePeriod($start, $interval, $endPlusOne);
    
        $workingDays = 0;
        foreach ($period as $date) {
            if (!$this->isWeekend($date)) {
                $workingDays++;
            }
        }
        return $workingDays;
    }

    private function isWeekend(DateTimeInterface $date): bool
    {
        return $date->format('N') >= 6; // 6 and 7 are Saturday and Sunday
    }

    public function getRemainingLeaveDays(string $employeeId, string $type = 'Normal'): int
    {
        $allowance = $this->getLeaveAllowance($type);
        $usedDays = $this->getConfirmedLeaveDays($employeeId, $type);
        
        return $allowance - $usedDays;
    }

    private function getLeaveAllowance(string $type): int
    {
        return match(strtolower($type)) {
            'normal' => 18,
            'vacation' => 10,
            'sick' => 10,
            'personal' => 5,
            default => 0
        };
    }

    public function formatDateRange(DateTimeInterface $start, DateTimeInterface $end): string
    {
        return $this->dateTimeFormatter->formatDiff($start, $end);
    }

    public function getHumanReadableDuration(DateTimeInterface $start, DateTimeInterface $end): string
    {
        $days = $this->calculateWorkingDays($start, $end);
        return $days . ' ' . ($days === 1 ? 'day' : 'days');
    }
}