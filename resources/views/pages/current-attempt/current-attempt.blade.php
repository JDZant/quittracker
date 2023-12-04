@extends('adminlte::page')

@section('content')
    <div class="container mt-3">
        @if ($activeAttempt)
            <!-- Reward Section -->
            @if ($nextReward)
                <div class="row">
                    <div class="col-12">
                        @if ($nextReward->date === \Carbon\Carbon::now()->format('Y-m-d'))
                            <div class="alert alert-success" role="alert">
                                <h1>Congratulations! You have earned a reward!</h1>
                                <p>Your progress bar reached 100%!</p>
                                <button data-target="#claimReward" data-toggle="modal"
                                        class="btn btn-warning btn-lg">Claim reward
                                </button>
                            </div>
                        @else
                            <h3 class="text-warning">{{ $daysLeft }} days left until you can reward yourself with
                                "<strong>{{ $nextReward?->name }}</strong>"</h3>
                            <h4>Progress</h4>
                        @endif
                        <div class="progress mb-3">
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%
                            </div>
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
                            <table class="table">
                                <tr>
                                    <td>Haven't smoked since</td>
                                    <td>{{ $activeAttempt->formatted_start_date }}</td>
                                </tr>
                                <tr>
                                    <td>Haven't smoked for</td>
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
                            <h5>Reasons</h5>
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
                            <h5>Total attempts</h5>
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
                        <div class="card-header text-center">
                            <h5>Smoking profile</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Cigarettes Per day</td>
                                    <td>{{ $activeAttempt->smokingData->cigarettes_per_day }}</td>
                                </tr>
                                <tr>
                                    <td>Nicotine per cigarette (mg)</td>
                                    <td>{{ $activeAttempt->smokingData->nicotine_per_cigarette }}</td>
                                </tr>
                                <!-- ... more rows ... -->
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Smoking Statistics -->
                <div class="col-md-6">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>Smoking statistics</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Cigarettes not smoked since</td>
                                    <td>{{ $cigarettesNotSmokedSince }}</td>
                                </tr>
                                <tr>
                                    <td>Nicotine not inhaled since</td>
                                    <td>{{ $nicotineNotInhaledSince }} (mg)</td>
                                </tr>
                                <tr>
                                    <td>Tar not inhaled since</td>
                                    <td>{{ $tarNotInhaledSince }} (mg)</td>
                                </tr>
                                <tr>
                                    <td>Packets not bought since</td>
                                    <td>{{ $packetsNotBoughtSince }}</td>
                                </tr>
                                <tr>
                                    <td>Money not spent on cigarettes</td>
                                    <td>{{ $moneyNotSpentOnCigarettesSince }} (€)</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#failModal">I
                        failed
                    </button>
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
