<?php

namespace App\Http\Livewire\QuitAttempt;

use App\Models\Reason;
use Livewire\Component;

class Reasons extends Component
{
    public $quitAttemptId;
    public $reason;

    public function add(): void
    {
        $validatedData = $this->validate([
            'reason' => 'required|string|max:255',
        ]);

        $validatedData['quit_attempt_id'] = $this->quitAttemptId;

        Reason::create($validatedData);
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reasons = Reason::whereQuitAttemptId($this->quitAttemptId)->get();
        return view('livewire.quit-attempt.reasons', compact('reasons'));
    }
}
