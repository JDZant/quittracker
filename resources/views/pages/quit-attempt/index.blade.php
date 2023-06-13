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
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>My attempts</h4>
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
                                <th>{{ __('quit-attempts.table.end_date') }}</th>
                                <th>{{ __('quit-attempts.table.reasons') }}</th>
                                <th>{{ __('quit-attempts.table.actions') }}</th>
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
                                        <td class="text-danger">{{ $quitAttempt->formatted_end_date }}</td>
                                        @if($quitAttempt->reasons->isEmpty())
                                            <td>
                                                <span class="badge" style="background-color: #403f3d; color:white;">No reasons</span>
                                            </td>
                                        @else
                                            <td>
                                                @foreach ($quitAttempt->reasons as $reason)
                                                    <span class="badge badge-primary">{{ $reason->reason }}</span>
                                                @endforeach
                                            </td>
                                        @endif
                                        <td>
                                            <form action="{{ route('quit-attempts.destroy', $quitAttempt) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border: none; background: none;">
                                                    <i class="fas fa-trash" style="color: #403f3d;"></i>
                                                </button>
                                            </form>
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
    </div>
@endsection
