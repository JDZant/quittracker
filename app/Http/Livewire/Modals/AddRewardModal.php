<?php

namespace App\Http\Livewire\Modals;

use App\Models\Reward;
use Illuminate\Support\Carbon;
use Livewire\Component;

class AddRewardModal extends Component
{
    public string $date;
    public array $daysOfWeek;
    public $selectedDay;
    public string $message;
    public string $rewardName;
    public int $quitAttemptId;
    public array $rewards = [];
    public bool $showModal = false;

    protected $listeners = [
        'set-modal' => 'setModal'
    ];

    public function setModal($message, $date, $quitAttemptId, $rewards): void
    {
        $this->date = $date;
        $this->message = $message;
        $this->quitAttemptId = $quitAttemptId;
        $this->rewards = $rewards;
        $this->showModal = true;
        $this->setDaysOfWeek();
    }

    //TODO this is quickfix. SelectedDay and should be stored in the same variable
    public function setSelectedDay($day) {
        $this->selectedDay = $this->selectedDay === $day ? null : $day;
        $this->date = $day;
    }

    public function setDaysOfWeek(): void
    {
        $selectedDate = Carbon::parse($this->date);
        $endOfSelectedWeek = $selectedDate->copy()->endOfWeek();

        // Check if the selected date is in the current week
        if ($selectedDate->weekOfYear == Carbon::now()->weekOfYear) {
            $remainingDaysOfTheWeek = $endOfSelectedWeek->diffInDays(now());
            for ($i = 0; $i <= $remainingDaysOfTheWeek; $i++) {
                $this->daysOfWeek[] = $selectedDate->copy()->addDays($i)->format('d-m-Y');
            }
        } else {
            for ($i = 0; $i < 7; $i++) {
                $this->daysOfWeek[] = $selectedDate->copy()->startOfWeek()->addDays($i)->format('d-m-Y');
            }
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        return redirect()->to("/rewards/{$this->quitAttemptId}");
    }

    public function addReward(): void
    {
        if ($this->rewardName && $this->quitAttemptId && $this->selectedDay) {
            $newReward = Reward::create([
                'name' => $this->rewardName,
                'quit_attempt_id' => $this->quitAttemptId,
                'date' => Carbon::parse($this->date)->format('Y-m-d')
            ]);
            $this->rewards[] = $newReward;
        }
        $this->rewardName = '';
    }

    public function deleteReward(int $id): void
    {
        Reward::find($id)->delete();
        $this->rewards = array_values(array_filter($this->rewards, function($reward) use ($id) {
            return $reward['id'] !== $id;
        }));
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.modals.add-reward-modal');
    }
}
