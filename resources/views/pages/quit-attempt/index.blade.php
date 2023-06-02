@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card mt-3">
                    <div class="card-header bg-gradient-blue">
                        <div class="d-flex justify-content-between">
                            <h4>Quit Attempts</h4>
                            <a href="{{ route('quit-attempts.create') }}">
                                <i class="fas text-white fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('quit-attempts.table.start_date') }}</th>
                                <th>{{ __('quit-attempts.table.reasons') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($quitAttempts as $quitAttempt)
                                <tr>
                                    <td>{{ $quitAttempt->start_date }}</td>
                                    @if($quitAttempt->reasons->isEmpty())
                                        <td>
                                            <span class="badge badge-danger">No reasons</span>
                                        </td>
                                    @else
                                        <td>
                                            @foreach ($quitAttempt->reasons as $reason)
                                                <span class="badge badge-primary">{{ $reason->reason }}</span>
                                            @endforeach
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $quitAttempts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
