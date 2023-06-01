@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header bg-gradient-blue">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('quit-attempts.header') }}</h4>
                            <a href="{{ route('quit-attempts.index') }}">
                                <h3><i class="fas text-white fa-long-arrow-alt-left"></i></h3>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('quit-attempts.store') }}" method="POST">
                            @csrf
                            <div class="form-group d-flex justify-content-between">
                                <label class="font-weight-normal" for="start_date">{{ __('quit-attempts.forms.start_date') }}</label>
                                <input type="date" name="start_date" id="start_date" class="form-control w-25">
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label class="font-weight-normal" for="end_date">{{ __('quit-attempts.forms.end_date') }}</label>
                                <input type="date" name="end_date" id="end_date" class="form-control w-25">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">{{__('quit-attempts.buttons.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
