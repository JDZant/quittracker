<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('reasons.header') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex justify-content-between">
                        <label class="font-weight-normal" for="reason">{{ __('reasons.forms.reason') }}</label>
                        <div class="">
                            <input wire:model.lazy="reason" wire:keydown.enter="add" type="text" name="reason"
                                   id="reason" class="form-control">
                            @error('reason')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <div>
                            <button wire:click="add" class="btn form-button">{{ __('reasons.buttons.add') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('Your reasons') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if($reasons->isEmpty())
                        <span>No reasons yet..</span>
                    @endif
                    @foreach($reasons as $index => $selectedReason)
                        <div class="d-flex justify-content-between p-2">
                            {{ $selectedReason->reason }}
                            <div class="btn" wire:click="remove({{ $index }})">
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
