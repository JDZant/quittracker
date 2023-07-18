<div class="w-100">
    <div class="d-flex justify-content-between p-3">
        <div class="d-flex flex-column">
            <h1>Goals</h1>
            <h4>Select a {{ $scale }} to set a goal</h4>
        </div>
        <div class="d-flex flex-column">
            <label>
                <select wire:model="scale" class="form-control">
                    <option {{ $scale === 'week' ? 'selected' : '' }} value="week">Week</option>
                    <option {{ $scale === 'month' ? 'selected' : '' }} value="month">Month</option>
                    <option {{ $scale === 'year' ? 'selected' : '' }} value="year">Year</option>
                </select>
            </label>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-start">
        @foreach($timeLine as $date)
            <div class="calendar-item mb-3 mr-3 p-5 col-2 text-center"
                 data-toggle="modal"
                 data-date="{{ $date }}"
                 data-target="#addGoalModal">
                <div>
                    @if($scale == 'week')
                        <strong>{{ 'Week ' . $date->weekOfYear }}</strong>
                    @elseif($scale == 'month')
                        <strong>{{ $date->format('F') }}</strong>
                    @elseif($scale == 'year')
                        <strong>{{ $date->format('Y') }}</strong>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @include('modals.add-goal')
</div>
