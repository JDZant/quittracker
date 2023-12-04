@extends('adminlte::page')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Notification Settings') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('notification-settings.update', ['user' => $user]) }}">
                        @csrf
                        @method('PUT')
                        <!-- Recipient Email -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email">{{ __('Recipient address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email', auth()->user()->email) }}" required
                                   autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Notifications Toggle -->
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="email_notifications" value="0">
                                <input type="checkbox" class="custom-control-input" id="email_notifications"
                                       name="email_notifications" value="1"
                                       @if($user->notificationSettings?->email_notifications) checked @endif>
                                <label class="custom-control-label"
                                       for="email_notifications">{{ __('Enable Email Notifications') }}</label>
                            </div>
                        </div>

                        <!-- Notification Frequency -->
                        <div class="form-group">
                            <label for="frequency">{{ __('Notification Frequency') }}</label>
                            <select id="frequency" class="form-control @error('frequency') is-invalid @enderror"
                                    name="frequency" required>
                                <option value="daily"
                                        @if ($user->notificationSettings?->frequency  === 'daily') selected @endif>
                                    Daily
                                </option>
                                <option value="weekly"
                                        @if ($user->notificationSettings?->frequency === 'weekly') selected @endif>
                                    Weekly
                                </option>
                                <option value="monthly"
                                        @if ($user->notificationSettings?->frequency === 'monthly') selected @endif>
                                    Monthly
                                </option>
                            </select>

                            @error('frequency')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-orange">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
