<?php

namespace App\Http\Livewire\Modals;

use App\Models\Reward;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;
use Masmerise\Toaster\Toaster;

class AddRewardModal extends Component
{

    use WithFileUploads;

    public string $date;
    public array $daysOfWeek;
    public $selectedDay;
    public string $message;
    public string $rewardName;
    public int $quitAttemptId;
    public $rewards;
    public bool $showModal = false;
    public $rewardImage;
    public $rewardImagePreview;

    //TODO SET REWARDS AS COLLECTION NOT AN ARRAY FOR SPATIE MEDIA LIBRARY

    protected $listeners = [
        'set-modal' => 'setModal'
    ];

    public function setModal($message, $date, $quitAttemptId, $rewards): void
    {
        $this->date = $date;
        $this->message = $message;
        $this->quitAttemptId = $quitAttemptId;
        $this->rewards = Reward::whereIn('id', $rewards)->get();
        $this->showModal = true;
        $this->setDaysOfWeek();
    }

    public function updatedRewardImage(): void
    {
        $this->rewardImagePreview = $this->getBase64ImageString();
    }

    public function removeImage(): void
    {
        $this->rewardImagePreview = null; // Remove/reset the image preview
        $this->rewardImage = null; // Also, reset the associated image variable if necessary
    }

    public function getBase64ImageString(): string
    {
        return 'data:image/png;base64,' . base64_encode(file_get_contents($this->rewardImage->getRealPath()));
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

    public function isDateToday($day): string
    {
        return Carbon::parse($day)->format('d-m-Y') ===  Carbon::now()->format('d-m-Y') ? 'disabled' : '';
    }

    public function closeModal()
    {
        $this->showModal = false;
        return redirect()->to("/rewards/{$this->quitAttemptId}");
    }

    public function addReward(): void
    {
        $this->validate([
            'rewardName' => 'required|string|max:255',
            'rewardImage' => 'nullable|image|max:5048',
        ]);

        if ($this->rewardName && $this->quitAttemptId && $this->selectedDay) {
            $newReward = Reward::create([
                'name' => $this->rewardName,
                'quit_attempt_id' => $this->quitAttemptId,
                'date' => Carbon::parse($this->selectedDay)->format('Y-m-d')
            ]);

            if ($this->rewardImage) {
                $newReward->addMedia($this->rewardImage->getRealPath())->toMediaCollection('rewards');
            }

            $this->rewards[] = $newReward;
        }

        $this->rewardName = '';
        Toaster::success('Reward added!');

    }

    public function deleteReward(int $id): void
    {
        Reward::find($id)->delete();

        $this->rewards = $this->rewards->filter(function($reward) use ($id) {
            return $reward->id !== $id;
        });
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.modals.add-reward-modal');
    }
}
