<?php

namespace App\Http\Livewire\QuitAttempt;

use Illuminate\Support\Carbon;
use Livewire\Component;


class Goals extends Component
{
    public string $scale;
    public Carbon $startDate;
    public Carbon $endDate;
    public $timeLine;

    public function mount(): void
    {
        $this->scale = 'week';
        $this->setTimeLine();
    }

    public function setTimeLine(): void
    {
        $this->startDate = now();
        $currentDate = $this->startDate->copy();
        if($this->scale === 'year'){
            $this->endDate = $this->startDate->copy()->endOfYear()->addYears(4);
        } else {
            $this->endDate = $this->startDate->copy()->endOfYear();
        }
        $this->timeLine = [];
        if ($this->scale == 'week') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                $this->timeLine[] = $currentDate->copy();
                $currentDate->addWeek();
            }
        } elseif ($this->scale == 'month') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                $this->timeLine[] = $currentDate->copy();
                $currentDate->addMonth();
            }
        } elseif ($this->scale == 'year') {
            while ($currentDate->lessThanOrEqualTo($this->endDate)) {
                $this->timeLine[] = $currentDate->copy();
                $currentDate->addYear();
            }
        }
    }

    public function render()
    {
        $this->setTimeLine();
        return view('livewire.quit-attempt.goals');
    }
}
