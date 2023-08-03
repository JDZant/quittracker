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

    public function store(RewardRequest $request){
        $data = $request->validated();
        Reward::create($data);
        return redirect()->back();
    }

}
