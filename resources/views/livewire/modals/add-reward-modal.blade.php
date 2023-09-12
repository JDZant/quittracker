<div>
    <div class="modal fade {{ $showModal ? 'show d-block' : '' }}"
         tabindex="-1"
         role="dialog"
         aria-labelledby="failModalLabel"
         aria-hidden="true"
         style="background: rgba(0,0,0,0.5);">
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <h5 class="modal-title" id="failModalLabel">{{ $message }}</h5>
                            <button type="button" wire:click="closeModal" class="close text-white" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="d-flex justify-content-center p-2">
                            @if($daysOfWeek)
                                <div class="row">
                                    @foreach($daysOfWeek as $day)
                                        <div class="col-md-3 p-1">
                                            <button wire:click="setSelectedDay('{{$day}}')"
                                                    class="btn date-button {{ $day == $selectedDay ? 'btn-selected border-white text-white' : 'btn-orange' }}">
                                                {{\Carbon\Carbon::parse($day)->format('l')}}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
                @if($selectedDay || $this->rewards)
                    <div>
                        <div class="modal-body">
                            <div id="rewards" class="d-flex flex-column pb-3 border-bottom mb-3">
                                @forelse($rewards as $reward)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="d-flex flex-column">
                                            <div>
                                                <strong class="text-orange">
                                                    Reward:
                                                </strong> {{$reward['name']}}
                                            </div>
                                            <div>
                                                <strong class="text-orange">
                                                    Date:
                                                </strong> {{ \Carbon\Carbon::parse($reward['date'])->format('d-m-Y') }}
                                            </div>
                                        </div>
                                        <div wire:click="deleteReward({{$reward['id']}})" class="cursor-pointer">
                                            <i class="fas fa-backspace text-orange fa-lg"></i>
                                        </div>
                                    </div>
                                @empty
                                    No planned rewards...
                                @endforelse
                            </div>
                            <label>Add new reward</label>
                            <div class="d-flex justify-content-between">
                                <input wire:keydown.enter="addReward" wire:model="rewardName" name="name"
                                       class="form-control">
                                <button wire:click="addReward"
                                        class="reward-modal-button btn btn-sm ml-2 bg-blue-custom btn-hover text-white">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
