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
                                <h1 class="text-orange">Congratulations! You have earned a reward!</h1>
                                <button data-target="#claimReward" data-toggle="modal"
                                        class="btn-gold rounded btn btn-lg text-white">Claim reward
                                </button>
                            </div>
                            <h3>Your progress bar reached 100%!</h3>
                        </div>
                    @else
                        <h3>{{ $daysLeft }} days left until you can reward yourself with
                            "<strong>{{ $nextReward?->name }}</strong>"</h3>
                        <h4>Progress</h4>
                    @endif
                    <div class="progress d-flex w-100" style="height: 1.5rem;!important">
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
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>Cigarettes Per day</td>
                                    <td>{{ $activeAttempt->smokingData->cigarettes_per_day }}</td>
                                </tr>
                                <tr>
                                    <td>Nicotine per cigarrette (mg)</td>
                                    <td>{{ $activeAttempt->smokingData->nicotine_per_cigarette }}</td>
                                </tr>
                                <tr>
                                    <td>Tar per cigarrette (mg)</td>
                                    <td>{{ $activeAttempt->smokingData->tar_per_cigarette }}</td>
                                </tr>
                                <tr>
                                    <td>Cigarette per pack</td>
                                    <td>{{ $activeAttempt->smokingData->cigarettes_per_pack }}</td>
                                </tr>
                                <tr>
                                    <td>Cost per pack (€)</td>
                                    <td>{{ $activeAttempt->smokingData->cost_per_pack }}</td>
                                </tr>
                                </tbody>
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
                            <table class="table table-striped table-bordered">
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
                    <div class="">
                        <button type="button" class="btn btn-orange mt-3 col-md-3 offset-md-9" data-toggle="modal"
                                data-target="#failModal">I
                            failed
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
