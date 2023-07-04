<div class="w-100">
    <div class="d-flex  p-3">
        <div class="d-flex flex-column">
            <h1>Goals</h1>
            <h4>Select a {{ $scale }} to set a goal</h4>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-start">
        @foreach($timeLine as $date)
            <div class="calendar-item mb-3 mr-3 {{ $scale === 'week' ? 'p-3' : 'p-5' }} col-2  text-center">
                <div class="">
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
</div>
