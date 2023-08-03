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
            $this->rewardDates[] = $reward->date;
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
        $date = Carbon::parse($date);
        $message = null;
        if($this->scale == 'week'){
            $message = 'Add a reward for week ' . $date->week;
        }
        if($this->scale == 'month'){
            $message = 'Add a reward for ' . $date->format('d F Y');
        }
        if($this->scale == 'year'){
            $message = 'Set a rewards for end of year ' . $date->format('Y');
        }

        $date = $date->format('Y-m-d');

        $rewards = Reward::whereQuitAttemptId($this->quitAttempt->id)->whereDate('date', $date)->get();

        $this->emit('set-modal', $message, $date, $this->quitAttempt->id, $rewards);

    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->setTimeLine();
        return view('livewire.quit-attempt.rewards');
    }
}
