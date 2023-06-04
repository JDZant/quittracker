<div>
    <div class="d-flex justify-content-around">
        @if(!$hasData)
            @livewire('quit-attempt.smoking-data')
        @endif
        @if($hasData)
            @livewire('quit-attempt.reasons', ['quitAttemptId' => $quitAttemptId])
        @endif
    </div>
</div>
