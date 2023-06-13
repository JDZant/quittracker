<div class="row">
    <div class="col-md-12">
        <div class="form-group d-flex justify-content-between">
            <label class="font-weight-normal" for="reason">{{ __('reasons.forms.reason') }}</label>
            <div class="w-50 d-flex">
                <div class="w-100 d-flex flex-column">
                    {{--                  @for ($index = 0; $index < $this->reasonNumber; $index++)
                                          <div class="mb-2">
                                              <input wire:keydown.enter="add"
                                                     type="text" name="reason" id="reason" class="form-control form-input-width">
                                          </div>
                                      @endfor--}}
                    @foreach($selectedReasons as $key => $value)
                        <div class="mb-2">
                            <input required wire:model.lazy="selectedReasons.{{ $key }}" type="text" name="reason"
                                   id="reason" class="form-control form-input-width">
                        </div>
                    @endforeach

                    <button wire:click.prevent="add" class="btn ml-auto text-blue">
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
