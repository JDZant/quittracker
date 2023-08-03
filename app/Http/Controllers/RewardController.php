<?php

namespace App\Http\Controllers;

use App\Http\Requests\RewardRequest;
use App\Models\QuitAttempt;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuitAttempt $quitAttempt)
    {
        return view('pages.rewards.rewards', [
            'quitAttempt' => $quitAttempt
        ]);
    }

    public function show(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $currentAttempt = QuitAttempt::whereNull('end_date')->first();
        return view('pages.rewards.rewards', [
            'quitAttempt' => $currentAttempt
        ]);
    }

    public function store(RewardRequest $request){
        $data = $request->validated();
        Reward::create($data);
        return redirect()->back();
    }

}
