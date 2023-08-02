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
    public function index()
    {
        $baseQuery = QuitAttempt::with('smokingData', 'reasons')
        ->whereUserId(Auth::user()->id);

        $activeAttempt = $baseQuery->whereNull('end_date')->first();

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
            'moneyNotSpentOnCigarettesSince' => $metrics['moneyNotSpentOnCigarettesSince'] ?? 0
        ]);
    }


    public function endCurrentAttempt(QuitAttempt $attempt){
        $attempt->end_date = Carbon::now();
        $attempt->save();
        return redirect()->back();
    }



}
