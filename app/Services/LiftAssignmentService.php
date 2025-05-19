<?php

namespace App\Services;

class LiftAssignmentService
{
    private array $initialLifts;
    private array $peopleRequests;

    public function __construct(array $initialLifts, array $peopleRequests)
    {
        $this->initialLifts = $initialLifts;
        $this->peopleRequests = $peopleRequests;
    }

    public function findOptimalAssignment(): array
    {
        $numPeople = count($this->peopleRequests);
        $numLifts = count($this->initialLifts);

        $minTotalWaitTime = PHP_INT_MAX;
        $bestAssignmentDetails = null;
        $bestIndividualWaits = [];

        $assignmentPermutations = $this->generateAssignments($numPeople, $numLifts);

        foreach ($assignmentPermutations as $assignment) {
            $currentTotalWaitTime = 0;
            $currentIndividualWaits = [];
            $isValidOverallAssignment = true;
            $liftTasks = array_fill(0, $numLifts, []);

            foreach ($assignment as $personIdx => $liftIdx) {
                $liftTasks[$liftIdx][] = $this->peopleRequests[$personIdx];
            }

            for ($liftIdx = 0; $liftIdx < $numLifts; $liftIdx++) {
                $peopleForThisLift = $liftTasks[$liftIdx];

                if (empty($peopleForThisLift)) {
                    continue;
                }

                $firstDirection = null;

                foreach ($peopleForThisLift as $person) {
                    if ($firstDirection === null) {
                        $firstDirection = $person['direction'];
                    } elseif ($firstDirection !== $person['direction']) {
                        $isValidOverallAssignment = false;
                        break;
                    }
                }

                if (!$isValidOverallAssignment) break;

                if ($firstDirection === 'n') {
                    usort($peopleForThisLift, fn($a, $b) => $a['floor'] <=> $b['floor']);
                } else {
                    usort($peopleForThisLift, fn($a, $b) => $b['floor'] <=> $a['floor']);
                }

                $liftCurrentFloor = $this->initialLifts[$liftIdx]['floor'];
                $liftTimeElapsed = 0;

                foreach ($peopleForThisLift as $person) {
                    $travelToPickup = abs($liftCurrentFloor - $person['floor']);
                    $liftTimeElapsed += $travelToPickup;

                    $currentIndividualWaits[$person['id']] = $liftTimeElapsed;
                    $currentTotalWaitTime += $liftTimeElapsed;

                    $liftTimeElapsed += 1;
                    $liftCurrentFloor = $person['floor'];
                }
            }

            if ($isValidOverallAssignment && $currentTotalWaitTime < $minTotalWaitTime) {
                $minTotalWaitTime = $currentTotalWaitTime;
                $bestIndividualWaits = $currentIndividualWaits;

                $bestAssignmentDetails = $liftTasks;
            }
        }


        $finalWaits = [];
        foreach ($this->peopleRequests as $person) {
            $finalWaits[$person['id']] = $bestIndividualWaits[$person['id']] ?? PHP_INT_MAX;
        }

        return [
            'total_wait_time' => $minTotalWaitTime === PHP_INT_MAX ? 'No valid assignment found' : $minTotalWaitTime,
            'individual_waits' => $finalWaits,
            'assignment_details' => $bestAssignmentDetails,
        ];
    }

    private function generateAssignments(int $numPeople, int $numLifts): array
    {
        $assignments = [];
        $totalAssignments = pow($numLifts, $numPeople);

        for ($i = 0; $i < $totalAssignments; $i++) {
            $currentAssignment = [];
            $temp = $i;
            for ($p = 0; $p < $numPeople; $p++) {
                $currentAssignment[] = $temp % $numLifts;
                $temp = intdiv($temp, $numLifts);
            }
            $assignments[] = array_reverse($currentAssignment);
        }
        return $assignments;
    }
}
