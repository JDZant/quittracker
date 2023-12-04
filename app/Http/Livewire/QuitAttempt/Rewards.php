<?php

namespace App\Http\Livewire\QuitAttempt;

use App\Models\QuitAttempt;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Component;


class Rewards extends Component
{
    public string $scale;
    public QuitAttempt $quitAttempt;
    public Carbon $startDate;
    public Carbon $endDate;
    public array $timeLine;
    public Collection $rewards;
    public array $rewardDates = [];

    protected $listeners = [
        'set-reward-dates' => 'setRewardDates'
    ];

    public function mount(): void
    {
        $this->scale = 'week';
        $this->rewards = $this->quitAttempt->rewards;
        $this->setRewardDates();
        $this->setTimeLine();
    }

    public function setRewardDates(): void
    {
        foreach ($this->rewards as $reward) {
            $this->rewardDates[] = Carbon::parse($reward->date)->weekOfYear;
        }
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

    public function setModalData($date): void
    {
        $dateObj = Carbon::parse($date);
        $message = null;
        $startOfWeek = $dateObj->copy()->startOfWeek();
        $endOfWeek = $dateObj->copy()->endOfWeek();

        if($this->scale == 'week'){
            $message = 'Select a day to add a reward';
            $rewards = Reward::whereQuitAttemptId($this->quitAttempt->id)
                ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
                ->get()
                ->pluck('id')->toArray();
        }

        $formattedDate = $dateObj->toDateString();

        $this->emit('set-modal', $message, $formattedDate, $this->quitAttempt->id, $rewards);


    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->setTimeLine();
        return view('livewire.quit-attempt.rewards');
    }
}
