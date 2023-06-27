<?php

namespace App\Http\Controllers;

use App\Models\QuitAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CurrentAttemptController extends Controller
{
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
    public function index()
    {
        $baseQuery = QuitAttempt::with('smokingData', 'reasons')
        ->whereUserId(Auth::user()->id);

        $activeAttempt = $baseQuery->whereNull('end_date')->first();
        if (isset($activeAttempt)) {
            $smokingData = $activeAttempt->smokingData;
            $daysStopped = Carbon::parse($activeAttempt->start_date)->diffInDays(now());
            $cigarettesNotSmokedSince = $smokingData->cigarettes_per_day * $daysStopped;
            $nicotineNotInhaledSince = $smokingData->nicotine_per_cigarette * $cigarettesNotSmokedSince;
            $tarNotInhaledSince = $smokingData->tar_per_cigarette * $cigarettesNotSmokedSince;
            $packetsNotBoughtSince = floor($cigarettesNotSmokedSince / $smokingData->cigarettes_per_pack);
            $moneyNotSpentOnCigarettesSince = $packetsNotBoughtSince * $smokingData->cost_per_pack;
        } else {
            $daysStopped = null;
            $cigarettesNotSmokedSince = null;
            $nicotineNotInhaledSince = null;
            $tarNotInhaledSince = null;
            $packetsNotBoughtSince = null;
            $moneyNotSpentOnCigarettesSince = null;
        }

        return view('pages.current-attempt.current-attempt', [
            'quitAttempts' => QuitAttempt::with('smokingData', 'reasons')->paginate(25),
            'activeAttempt' => $activeAttempt,
            'daysStopped' => $daysStopped,
            'cigarettesNotSmokedSince' => $cigarettesNotSmokedSince,
            'nicotineNotInhaledSince' => $nicotineNotInhaledSince,
            'tarNotInhaledSince' => $tarNotInhaledSince,
            'packetsNotBoughtSince' => $packetsNotBoughtSince,
            'moneyNotSpentOnCigarettesSince' => $moneyNotSpentOnCigarettesSince
        ]);
    }


    public function endCurrentAttempt(QuitAttempt $attempt){
        $attempt->end_date = Carbon::now();
        $attempt->save();
        return redirect()->back();
    }



}
