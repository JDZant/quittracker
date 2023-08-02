<?php

namespace App\Traits;

use Carbon\Carbon;

trait CalculatedSmokingData
{
    public $daysStopped;
    public function calculateSmokingData($quitAttempt): array
    {
        $metrics = [];

        $smokingData = $quitAttempt->smokingData;
        $this->daysStopped = Carbon::parse($quitAttempt->start_date)->diffInDays(now());

        $metrics['cigarettesNotSmokedSince'] = $smokingData->cigarettes_per_day * $this->daysStopped;
        $metrics['nicotineNotInhaledSince'] = $smokingData->nicotine_per_cigarette * $metrics['cigarettesNotSmokedSince'];
        $metrics['tarNotInhaledSince'] = $smokingData->tar_per_cigarette * $metrics['cigarettesNotSmokedSince'];
        $metrics['packetsNotBoughtSince'] = floor($metrics['cigarettesNotSmokedSince'] / $smokingData->cigarettes_per_pack);
        $metrics['moneyNotSpentOnCigarettesSince'] = $metrics['packetsNotBoughtSince'] * $smokingData->cost_per_pack;

        return $metrics;
    }
}
