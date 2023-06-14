<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header card-header">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('smoking-data.header') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="start_date">{{ __('quit-attempts.forms.start_date') }}</label>
                            <div class="w-50">
                                <input type="date" max="{{ date('Y-m-d') }}" wire:model.lazy="start_date" name="start_date" value="start_date"
                                       id="start_date"
                                       class="form-control">
                                @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="cigarettes_per_pack">{{ __('smoking-data.forms.cigarettes_per_pack') }}</label>
                            <div class="w-50">
                                <input wire:model.lazy="cigarettes_per_pack" type="number" min="0"
                                       name="cigarettes_per_pack"
                                       value="cigarettes_per_pack" id="cigarettes_per_pack"
                                       class="form-control">
                                @error('cigarettes_per_pack')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="cigarettes_per_day">{{ __('smoking-data.forms.cigarettes_per_day') }}</label>
                            <div class="w-50">
                                <input wire:model.lazy="cigarettes_per_day" type="number" min="0"
                                       name="cigarettes_per_day"
                                       value="cigarettes_per_day" id="cigarettes_per_day"
                                       class="form-control">
                                @error('cigarettes_per_day')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="cost_per_pack">{{ __('smoking-data.forms.cost_per_pack') }} €</label>
                            <div class="w-50">
                                <input wire:model.lazy="cost_per_pack" type="number" min="0" step="0.01"
                                       name="cost_per_pack"
                                       value="cost_per_pack" id="cost_per_pack" class="form-control">
                                @error('cost_per_pack')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="nicotine_per_cigarette">{{ __('smoking-data.forms.nicotine_per_cigarette') }}
                                (mg)</label>
                            <div class="w-50">
                                <input wire:model.lazy="nicotine_per_cigarette" type="number" min="0" step="0.01"
                                       name="nicotine_per_cigarette"
                                       value="nicotine_per_cigarette" id="nicotine_per_cigarette"
                                       class="form-control">
                                @error('nicotine_per_cigarette')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="font-weight-normal"
                                   for="tar_per_cigarette">{{ __('smoking-data.forms.tar_per_cigarette') }}
                                (mg)</label>
                            <div class="w-50">
                                <input wire:model.lazy="tar_per_cigarette" type="number" min="0" step="0.01"
                                       name="tar_per_cigarette"
                                       value="tar_per_cigarette" id="tar_per_cigarette"
                                       class="form-control">
                                @error('tar_per_cigarette')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            @livewire('quit-attempt.reasons')
                        </div>

                        <div class="form-group d-flex justify-content-end">
                            <button type="submit"
                                    class="btn form-button">{{__('quit-attempts.buttons.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

