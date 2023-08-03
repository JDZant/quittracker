<div>
    <div wire:ignore.self class="modal fade {{ $showModal ? 'show d-block' : '' }}"
         id="addRewardModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="failModalLabel"
         aria-hidden="true"
         style="background: rgba(0,0,0,0.5);">
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failModalLabel">{{ $message }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <div class="modal-body">
                        <div id="rewards" class="d-flex flex-column pb-3 border-bottom mb-3">
                            @if($rewards)
                                <label>Planned rewards</label>
                            @endif
                            @forelse($rewards as $reward)
                                <div class="d-flex justify-content-between pb-2">
                                    <div class="">
                                        {{$reward['name']}}
                                    </div>
                                    <div wire:click="deleteReward({{$reward['id']}})" class="cursor-pointer">
                                        <i class="text-primary fas fa-backspace fa-lg"></i>
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
                            <button wire:click="addReward" class="btn btn-sm ml-2 bg-blue-custom btn-hover text-white">Add
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary btn-hover" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
