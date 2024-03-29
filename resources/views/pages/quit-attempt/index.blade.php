@extends('adminlte::page')

@section('content')
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="mt-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>My attempts</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('quit-attempts.table.start_date') }}</th>
                            <th>{{ __('quit-attempts.table.end_date') }}</th>
                            <th>{{ __('quit-attempts.table.reasons') }}</th>
                            <th>{{ __('quit-attempts.table.status') }}</th>
                            {{--                      <th>{{ __('quit-attempts.table.actions') }}</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if($quitAttempts->isEmpty())
                            <tr>
                                <td>
                                    <span>No results</span>
                                </td>
                            </tr>
                        @else
                            @foreach ($quitAttempts as $quitAttempt)
                                <tr>
                                    <td>{{ $quitAttempt->formatted_start_date }}</td>
                                    @if($quitAttempt->end_date)
                                        <td>
                                            {{ $quitAttempt->formatted_end_date }}
                                        </td>
                                    @else
                                        <td>
                                            -
                                        </td>
                                    @endif
                                    @if($quitAttempt->reasons->isEmpty())
                                        <td>
                                            <span class="badge" style="background-color: #403f3d; color:white;">No reasons</span>
                                        </td>
                                    @else
                                        <td>
                                            {{ $quitAttempt->reasons->pluck('reason')->implode(', ') }}
                                        </td>
                                    @endif
                                    <td>
                                        @if(!is_null($quitAttempt->end_date))
                                            <span class="badge bg-orange text-white p-2">Failed</span>
                                        @else
                                            <span class="badge bg-success p-2">Ongoing</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex mt-3">
                        {{ $quitAttempts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
