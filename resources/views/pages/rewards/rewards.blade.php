@extends('adminlte::page')

@section('content')
    @if($quitAttempt)
        @livewire('quit-attempt.rewards', ['quitAttempt' => $quitAttempt])
    @else
        <div class="d-flex flex-column w-100 p-3 align-items-center justify-content-center">
            <div class=" info-container p-3 text-center rounded">
                <h5>Cannot add rewards yet.</h5>
            </div>
        </div>
    @endif
@endsection

