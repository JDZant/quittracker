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
                <div class="p-3">
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex justify-content-between">
                            <h5 class="modal-title" id="failModalLabel">{{ $message }}</h5>

                        </div>

                        @if($daysOfWeek)
                            <div class="row p-3">
                                @foreach($daysOfWeek as $day)
                                    <div
                                        class="{{ \Carbon\Carbon::parse($day)->week === \Carbon\Carbon::now()->week ? 'col-md-3' : 'col-md-3' }}  p-1 ">
                                        <button wire:click="setSelectedDay('{{$day}}')"
                                                class="btn date-button {{ $day == $selectedDay ? 'btn-selected border-white text-white' : 'btn-orange' }}">
                                            {{\Carbon\Carbon::parse($day)->format('l')}}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if($selectedDay)
                            <div>
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
                        @endif
                    </div>

                </div>
                @if($selectedDay || $this->rewards)
                    <div>
                        <div class="modal-body">
                            <div id="rewards"
                                 class="d-flex flex-column pb-3 border-bottom border-top reward-scrollbar {{ count($rewards) >= 4 ? 'pr-2' : '' }}">
                                @forelse($rewards as $reward)
                                    <div
                                        class="d-flex justify-content-between text-black-50 bg-light-gray p-3 mt-3 rounded pb-2">
                                        <div class="d-flex flex-column">
                                            <div>
                                                <strong class="text-orange">
                                                    {{ \Carbon\Carbon::parse($reward['date'])->format('l d-m') }}       </strong>
                                            </div>
                                            <div>
                                                <strong>{{$reward['name']}}</strong>
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
                        </div>
                    </div>

                @endif
                <div class="w-100 d-flex justify-content-end pb-3 pr-3 ">
                    <button class="btn-confirm btn" wire:click="closeModal">Done</button>
                </div>
            </div>
        </div>
    </div>

</div>
