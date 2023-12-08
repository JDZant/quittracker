@extends('adminlte::page')

@section('content')
    <div class="container mt-3">
        @if ($activeAttempt)
            <!-- Reward Section -->
            @if($nextReward)
                <div class="d-flex flex-column w-100">
                    @if($nextReward->date === \Carbon\Carbon::now()->format('Y-m-d'))
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h1 class="text-orange">{{ __('current-attempt.headers.reward_earned') }}</h1>
                                <button data-target="#claimReward" data-toggle="modal"
                                        class="btn-gold rounded btn btn-lg text-white">
                                    {{ __('current-attempt.claim_reward') }}
                                </button>
                            </div>
                            <h3>{{ __('current-attempt.headers.days_left') }}</h3>
                        </div>
                    @else
                        <h3>{!! __('current-attempt.headers.days_left', ['days' => $daysLeft, 'reward' => $nextReward?->name]) !!}</h3>
                    @endif
                    <div class="progress d-flex w-100 mb-3" style="height: 1.5rem;!important">
                        <div class="bg-orange text-white progress-bar progress-bar-striped"
                             role="progressbar"
                             style=" width:{{ $progress . '%' }}"
                             aria-valuenow="25"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ $progress }}%
                        </div>
                    </div>
                </div>
            @endif

            <!-- Attempt and Statistics Section -->
            <div class="row">
                <!-- Current Attempt -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>Current attempt</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>{{ __('current-attempt.table.no_smoke_since') }}</td>
                                    <td>{{ $activeAttempt->formatted_start_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{  __('current-attempt.table.no_smoke_for') }}</td>
                                    <td><strong>{{ $daysStopped }}</strong> days</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Reasons Section -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>{{ __('current-attempt.headers.reasons') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($activeAttempt->reasons as $reason)
                                <h3 class="mt-3">{{ $reason->reason }}</h3>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Total Attempts -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>{{ __('current-attempt.headers.total_attempts') }}</h5>
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{ $quitAttempts->total() }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Smoking Profile -->
                <div class="col-md-6">
                    <div class="card mt-3">
                        @include('pages/current-attempt.includes.smoking-profile')
                    </div>
                </div>
                <!-- Smoking Statistics -->
                <div class="col-md-6">
                    <div class="card mt-3">
                        @include('pages/current-attempt.includes.smoking-statistics')
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-orange mt-3 col-md-3 offset-md-9" data-toggle="modal"
                                data-target="#failModal">
                            {{ __('current-attempt.buttons.fail') }}
                        </button>
                    </div>
                </div>
            </div>
            <!-- Include Modals -->
            @include('modals.confirm')
            @include('modals.claim-reward', ['activeAttempt' => $activeAttempt])

        @else
            <!-- Start New Attempt -->
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="{{ route('quit-attempts.create') }}"
                       class="btn btn-primary btn-lg" {{ $activeAttempt ? 'disabled' : '' }}>Let's start!</a>
                </div>
            </div>
        @endif
    </div>
@endsection
