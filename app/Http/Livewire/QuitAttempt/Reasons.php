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

    public function updateComponent(){
        $this->render();
    }

    public function add(){
        $this->selectedReasons[] = '';
        $this->emit('updateComponent');
    }

    public function render()
    {
        return view('livewire.quit-attempt.reasons');
    }

}
