<?php

namespace App\Http\Livewire\QuitAttempt;

use App\Models\Reason;
use Livewire\Component;

class Reasons extends Component
{
    public array $selectedReasons = [''];

    protected $listeners = [
        'updateComponent',
        'getReasons'
    ];

    public function updatedSelectedReasons(): void
    {
        $this->emit('reasonsUpdated', $this->selectedReasons);
    }

    public function updateComponent(): void
    {
        $this->render();
    }

    public function add(): void
    {
        $this->selectedReasons[] = '';
        $this->emit('updateComponent');
    }

    public function remove($key): void
    {
        unset($this->selectedReasons[$key]);
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.quit-attempt.reasons');
    }

}
