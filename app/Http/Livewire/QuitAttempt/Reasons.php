<?php

namespace App\Http\Livewire\QuitAttempt;

use App\Models\Reason;
use Livewire\Component;

class Reasons extends Component
{
    public $reasons = [];
    public $reason;

    public function add(): void
    {
        $validatedData = $this->validate([
            'reason' => 'required|string|max:255',
        ]);
        $this->reasons[] = $validatedData['reason'];
        $this->reason = null;
    }

    public function remove($index): void
    {
        unset($this->reasons[$index]);
    }

    public function store()
    {

    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.quit-attempt.reasons');
    }
}
