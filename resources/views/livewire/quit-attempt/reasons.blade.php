<div class="row">
    <div class="col-md-12">
        <div class="form-group d-flex justify-content-between">
            <label class="font-weight-normal" for="reason">{{ __('reasons.forms.reason') }}</label>
            <div class="w-50 d-flex">
                <div class="w-100 d-flex flex-column">
                    @foreach($selectedReasons as $key => $value)
                        <div class="d-flex position-relative">
                            <div class="mb-2 flex-grow-1">
                                <input required wire:model.lazy="selectedReasons.{{ $key }}" type="text" name="reason"
                                       id="reason" class="form-control form-input-width pr-5">
                            </div>
                            @if($key > 0)
                                <div wire:click="remove({{$key}})" class="position-absolute" style="right: 10px; top: 42%; transform: translateY(-50%);">
                                    <i style="color:#8f8f8f; cursor:pointer;" class="far text-orange fa-minus-square"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <button wire:click.prevent="add" class="btn outline-none ml-auto text-blue btn-outline-0 scale-up">
                        {{ __('reasons.buttons.add') }}
                    </button>
                </div>
            </div>
            @error('reason')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
