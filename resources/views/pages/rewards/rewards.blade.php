@extends('adminlte::page')

@section('content')
    @if($quitAttempt)
        @livewire('quit-attempt.rewards', ['quitAttempt' => $quitAttempt])
    @else
        <div class="d-flex justify-content-center  mt-3 ">
            <div class="w-50 bg-secondary text-center rounded p-3">
                <h1>First add a quit attempt!</h1>
            </div>
        </div>
    @endif
@endsection

