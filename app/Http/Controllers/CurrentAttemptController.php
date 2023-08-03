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

        $nextRewardDate = $activeAttempt
            ->rewards
            ->where('date', '>', now())
            ->sortBy('date')
            ->first()
            ->date;

        $quitAttemptStartDate = $activeAttempt->start_date;
        $totalPeriod = Carbon::parse($nextRewardDate)->diffInDays($quitAttemptStartDate);
        $elapsedTime = now()->diffInDays($quitAttemptStartDate);

        $progress = round(($elapsedTime / $totalPeriod) * 100, 2);

        if (isset($activeAttempt)) {
            $metrics = $this->calculateSmokingData($activeAttempt);
        }

        return view('pages.current-attempt.current-attempt', [
            'quitAttempts' => QuitAttempt::with('smokingData', 'reasons')->paginate(25),
            'activeAttempt' => $activeAttempt,
            'daysStopped' => $this->daysStopped,
            'cigarettesNotSmokedSince' => $metrics['cigarettesNotSmokedSince'] ?? 0,
            'nicotineNotInhaledSince' => $metrics['nicotineNotInhaledSince'] ?? 0,
            'tarNotInhaledSince' => $metrics['tarNotInhaledSince'] ?? 0,
            'packetsNotBoughtSince' => $metrics['packetsNotBoughtSince'] ?? 0,
            'moneyNotSpentOnCigarettesSince' => $metrics['moneyNotSpentOnCigarettesSince'] ?? 0,
            'progress' => $progress
        ]);
    }

    public function endCurrentAttempt(QuitAttempt $attempt): \Illuminate\Http\RedirectResponse
    {
        $attempt->end_date = Carbon::now();
        $attempt->save();
        return redirect()->back();
    }



}
