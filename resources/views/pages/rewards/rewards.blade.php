@extends('adminlte::page')

@section('content')
    @livewire('quit-attempt.rewards', ['quitAttempt' => $quitAttempt])
@endsection

