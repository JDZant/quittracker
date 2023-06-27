<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuitAttemptRequest;
use App\Models\QuitAttempt;
use App\Models\Reason;
use App\Models\SmokingData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuitAttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quitAttempts = QuitAttempt::with('reasons')
            ->whereUserId(Auth::user()->id)
            ->paginate(10);
        $activeAttempt = QuitAttempt::whereNull('end_date')
            ->whereUserId(Auth::user()->id)
            ->first();

        return view('pages.quit-attempt.index', [
            'quitAttempts' => $quitAttempts,
            'activeAttempt' => $activeAttempt
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.quit-attempt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuitAttemptRequest $request)
    {
        $data = $request->validated();
        $startDate = array_shift($data);
        $quitAttempt = QuitAttempt::create(['start_date' => $startDate]);
        $data['quit_attempt_id'] = $quitAttempt->id;
        $this->storeSmokingData($data);

        return redirect()->route('quit-attempts.index')
            ->with('success', 'Quit Attempt created successfully');
    }

    private function storeSmokingData($data){
        SmokingData::create($data);
    }

    private function storeReasons($data){
        Reason::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        QuitAttempt::findOrFail($id)->delete();

        return redirect()->route('quit-attempts.index')->with('status', 'Deleted quit attempt');
    }

}

