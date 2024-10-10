<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row g-2">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('Title') }}</label>
                        <input value="" wire:model.defer="page.title" placeholder="{{ __('Add Title') }}"
                               name="title"
                               class="form-control @error('page.title') is-invalid @enderror" type="text">
                        @error('page.title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('order') }}</label>
                        <input value="" wire:model.defer="page.order" placeholder="{{ __('Add order') }}"
                               name="order"
                               class="form-control @error('page.order') is-invalid @enderror" type="number">
                        @error('page.order')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">{{ __('Url') }}</label>
                    <input value="" wire:model.defer="page.url" placeholder="{{ __('Add url') }}"
                           name="url"
                           class="form-control @error('page.url') is-invalid @enderror" type="text">
                    @error('page.url')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group" wire:ignore>
                <label class="control-label">{{ __('Description') }}</label>
                <textarea value="" rows="5" wire:model.defer="page.description"
                          placeholder="{{ __('Add Description') }}"
                          name="description" id="description" data-description="@this"
                          class="form-control  @error('page.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('page.description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

            </div>

        </div>

        <div class="row g-2">

            <div class="col-md-12">
                <div class="form-group">
                    <div class="card d-table p-1 m-auto">
                        @if($imageTemp)
                            <img width="150" class="img-fluid rounded"
                                 src="{{ $imageTemp->temporaryUrl() }}"
                                 data-holder-rendered="true">

                        @else
                            <img width="200" class="img-fluid rounded"
                                 src="{{ $image ? url($image) : url('dashboard/img/image1.png')}}"
                                 data-holder-rendered="true">
                        @endif
                    </div>

                    <div class="d-table p-1 m-auto uniform-uploader">
                        <input type="file" wire:model.defer="imageTemp"
                               class="form-input-styled form-control @error('imageTemp ') is-invalid @enderror"
                               data-fouc=""
                        >
                        <span class="filename">{{__("File Image ")}}</span>
                        @error('imageTemp')
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div class="text-center mt-3 mb-3">
        <button wire:loading.attr="disabled" class="btn btn-primary w-25"
                type="submit">{{__("Store")}}</button>
    </div>
</form>

