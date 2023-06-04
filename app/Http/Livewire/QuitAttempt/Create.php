<?php

namespace App\Http\Livewire\QuitAttempt;

use Livewire\Component;

class Create extends Component
{
    public bool $hasData = false;
    public $quitAttemptId;

    protected $listeners = [
        'set-has-data' => 'setHasData',
        'set-quit-attempt' => 'setQuitAttempt'
    ];

    public function setHasData($value): void
    {
        $this->hasData = $value;
    }

    public function setQuitAttempt($value): void
    {
        $this->quitAttemptId = $value;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.quit-attempt.create');
    }
}
