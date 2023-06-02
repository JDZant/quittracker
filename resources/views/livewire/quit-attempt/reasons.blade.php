<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header bg-gradient-blue">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('reasons.header') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex justify-content-between">
                        <label class="font-weight-normal" for="reason">{{ __('reasons.forms.reason') }}</label>
                        <div class="w-50">
                            <input wire:model.lazy="reason" wire:keydown.enter="add" type="text" name="reason" id="reason" class="form-control">
                            @error('reason')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @foreach($reasons as $index => $selectedReason)
                        <div class="d-flex justify-content-between p-2">
                            {{ $selectedReason }}
                            <div class="btn" wire:click="remove({{ $index }})">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end mt-3">
                        <button wire:click="add" class="btn btn-primary">{{ __('reasons.buttons.add') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
