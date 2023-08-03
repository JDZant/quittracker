@extends('adminlte::page')

@section('content')
    @if($activeAttempt)
        <div class="container col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>{{ __('Current attempt') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h3>Stopped since</h3>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#failModal">I failed</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Haven't smoked since</td>
                                        <td>{{ $activeAttempt->formatted_start_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Haven't smoked for</td>
                                        <td><strong>{{ $daysStopped }}</strong> days</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-center">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>{{ __('Reasons') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mt-3">
                                @foreach ($activeAttempt->reasons as $reason)
                                    <h3>{{ $reason->reason }}</h3>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>{{ __('Total attempts') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h1>{{ $quitAttempts->total() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>{{ __('Smoking profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Cigarettes Per Day</td>
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
                </div>
                <div class="col-6">
                    <div class="card mt-3">
                        <div class="card-header text-center">
                            <h5>{{ __('Smoking statistics') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mt-3">
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
                    </div>
                </div>
            </div>
        </div>
        @include('modals.confirm')

    @else
        <div class="d-flex justify-content-center">
            <div class="col-2">
                <div class="text-center mt-3">
                    <a href="{{ route('quit-attempts.create') }}">
                        <button {{ $activeAttempt ? 'disabled' : '' }} class="btn bg-blue-custom text-white btn-hover btn-lg">Lets start!</button>
                    </a>
                </div>
            </div>
        </div>
    @endif


@endsection

