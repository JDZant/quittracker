@extends('adminlte::page')

@section('content')
    @if($quitAttempt)
        @livewire('quit-attempt.rewards', ['quitAttempt' => $quitAttempt])
    @else
        <div class="d-flex flex-column w-100 full-height align-items-center justify-content-center">
            <div class="w-50 bg-orange text-white text-center rounded p-3">
                <h1>First add a quit attempt!</h1>
            </div>
        </div>

    @endif
@endsection

