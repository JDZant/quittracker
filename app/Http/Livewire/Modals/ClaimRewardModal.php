<?php

namespace App\Http\Livewire\Modals;

use App\Models\QuitAttempt;
use App\Models\Reward;
use Livewire\Component;

class ClaimRewardModal extends Component
{
    public QuitAttempt $activeAttempt;
    public ?Reward $claimedReward = null;

    public function mount(){
        $this->claimedReward = $this->activeAttempt->rewards->first();
    }

    public function claim()
    {
        $this->claimedReward->delete();
        return view('current-attempt');
    }

    public function render()
    {
        return view('livewire.modals.claim-reward-modal');
    }
}
