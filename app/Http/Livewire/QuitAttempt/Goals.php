<?php

namespace App\Http\Livewire\QuitAttempt;

use Illuminate\Support\Carbon;
use Livewire\Component;

class Goals extends Component
{
    public $scale = 'week';
    public $startDate;
    public $endDate;
    public $timeLine;

    public function mount(): void
    {
        $this->startDate = now();
        $this->endDate = $this->startDate->copy()->addYears(1);

        $currentDate = $this->startDate->copy();
        $this->timeLine = [];

        if ($this->scale == 'week') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                array_push($this->timeLine, $currentDate->copy());
                $currentDate->addWeek();
            }
        } elseif ($this->scale == 'month') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                array_push($this->timeLine, $currentDate->copy());
                $currentDate->addMonth();
            }
        } elseif ($this->scale == 'year') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                array_push($this->timeLine, $currentDate->copy());
                $currentDate->addYear();
            }
        }
    }

    public function render()
    {
        return view('livewire.quit-attempt.goals');
    }
}
