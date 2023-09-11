<?php

namespace App\Http\Controllers;

use App\Models\QuitAttempt;
use App\Traits\CalculatedSmokingData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CurrentAttemptController extends Controller
{
    use CalculatedSmokingData;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $baseQuery = QuitAttempt::with('smokingData', 'reasons')
        ->whereUserId(Auth::user()->id);

        $activeAttempt = $baseQuery->whereNull('end_date')->first();

        if (isset($activeAttempt)) {
            $nextReward = $activeAttempt
                ->rewards
                ->filter(function ($reward) {
                    return Carbon::parse($reward->date)->isToday() || Carbon::parse($reward->date)->isFuture();
                })
                ->sortBy('date')
                ->first();

            if ($nextReward) {
                $nextRewardDate = $nextReward->date;
            } else {
                $nextRewardDate = 0;
            }

            $quitAttemptStartDate = $activeAttempt->start_date;
            $totalPeriod = Carbon::parse($nextRewardDate)->diffInDays($quitAttemptStartDate);
            $elapsedTime = now()->diffInDays($quitAttemptStartDate);

            $progress = round(($elapsedTime / $totalPeriod) * 100, 2);

            $daysLeft = $totalPeriod - $elapsedTime;

            $metrics = $this->calculateSmokingData($activeAttempt);
        }

        return view('pages.current-attempt.current-attempt', [
            'quitAttempts' => QuitAttempt::with('smokingData', 'reasons')->paginate(25),
            'activeAttempt' => $activeAttempt ?? null,
            'daysStopped' => $this->daysStopped,
            'cigarettesNotSmokedSince' => $metrics['cigarettesNotSmokedSince'] ?? 0,
            'nicotineNotInhaledSince' => $metrics['nicotineNotInhaledSince'] ?? 0,
            'tarNotInhaledSince' => $metrics['tarNotInhaledSince'] ?? 0,
            'packetsNotBoughtSince' => $metrics['packetsNotBoughtSince'] ?? 0,
            'moneyNotSpentOnCigarettesSince' => $metrics['moneyNotSpentOnCigarettesSince'] ?? 0,
            'progress' => $progress ?? null,
            'daysLeft' => $daysLeft  ?? null,
            'nextReward' => $nextReward  ?? null
        ]);
    }

    public function endCurrentAttempt(QuitAttempt $attempt): \Illuminate\Http\RedirectResponse
    {
        $attempt->end_date = Carbon::now();
        $attempt->save();
        return redirect()->back();
    }



}
