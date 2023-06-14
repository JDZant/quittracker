<?php

namespace App\Http\Livewire\QuitAttempt;

//libraries
use App\Models\Reason;
use Carbon\Carbon;

//livewire
use Livewire\Component;

//models
use App\Models\QuitAttempt;
use App\Models\SmokingData as SmokingDataModel;

class SmokingData extends Component
{
    public string $start_date;
    public int $cigarettes_per_day;
    public int $cigarettes_per_pack;
    public float $cost_per_pack;
    public float $nicotine_per_cigarette;
    public float $tar_per_cigarette;
    public array $selectedReasons = [];

    protected $listeners = ['reasonsUpdated' => 'updateReasons'];

    public function store()
    {
        $validatedData = $this->validate([
            'start_date' => 'required|date',
            'cigarettes_per_day' => 'required|integer|min:0',
            'cost_per_pack' => 'required|numeric|min:0',
            'nicotine_per_cigarette' => 'required|numeric|min:0',
            'tar_per_cigarette' => 'required|numeric|min:0',
            'cigarettes_per_pack' => 'required|integer|min:0',
        ]);

        //remove start_date from array
        $startDate = array_shift($validatedData);

        //create quit attempt
        $quitAttempt = QuitAttempt::create(['start_date' => $startDate]);

        //add quit attempt id to array
        $validatedData['quit_attempt_id'] = $quitAttempt->id;

        //create smoking data
        SmokingDataModel::create($validatedData);
        $this->emit('set-has-data', true);
        $this->emit('set-quit-attempt', $quitAttempt->id);

        //create reasons
        foreach($this->selectedReasons as $reason){
            Reason::create([
                'reason' => $reason,
                'quit_attempt_id' => $quitAttempt->id
            ]);
        }

        return redirect()->route('current-attempt')->with('status', 'Quit attempt added!');
    }

    public function updateReasons($selectedReasons): void
    {
        $this->selectedReasons = $selectedReasons;
    }

    public function render()
    {
        return view('livewire.quit-attempt.smoking-data');
    }
}
