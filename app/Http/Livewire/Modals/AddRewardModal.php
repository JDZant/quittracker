<?php

namespace App\Http\Livewire\Modals;

use App\Models\Reward;
use Livewire\Component;

class AddRewardModal extends Component
{
    public string $date;
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
        $this->showModal = false;
        $this->date = $date;
        $this->message = $message;
        $this->quitAttemptId = $quitAttemptId;
        $this->rewards = $rewards;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function addReward(): void
    {
        if ($this->rewardName && $this->quitAttemptId && $this->date) {
            $newReward = Reward::create([
                'name' => $this->rewardName,
                'quit_attempt_id' => $this->quitAttemptId,
                'date' => $this->date
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
