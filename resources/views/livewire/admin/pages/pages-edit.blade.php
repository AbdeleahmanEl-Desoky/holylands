<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row g-2">
        <div class="col-md-12">

            <div class="row g-2 mt-3">

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="card d-table p-1 m-auto">
                            @if($imageTemp)
                                <img width="150" class="img-fluid rounded"
                                     src="{{ $imageTemp->temporaryUrl() }}"
                                     data-holder-rendered="true">
                            @else
                                @if(!empty($page['image']))
                                    <img width="200" class="rounded-circle img-thumbnail"
                                         src="{{ $page['image'] }}"
                                         data-holder-rendered="true">
                                @endif
                            @endif
                        </div>

                        <div class="d-table p-1 m-auto uniform-uploader">
                            <input type="file" wire:model.defer="imageTemp"
                                   class="form-input-styled form-control submit2 @error('imageTemp') is-invalid @enderror"
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

            <div class="row">
                <div class="col-md-12">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">{{ __('Description') }}</label>
                        <textarea value="" rows="10" wire:model.defer="page.description"
                                  placeholder="{{ __('Add Description') }}"
                                  name="description" id="description2" data-description2="@this"
                                  class="form-control  @error('page.description') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('page.description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

            </div>
            {{--                <div class="col-md-6">--}}
            {{--                    <div class="form-group">--}}
            {{--                        <label class="control-label">{{ __('order') }}</label>--}}
            {{--                        <input value="" wire:model.defer="page.order" placeholder="{{ __('Add order') }}"--}}
            {{--                               name="order"--}}
            {{--                               class="form-control @error('page.order') is-invalid @enderror" type="number">--}}
            {{--                        @error('page.order')--}}
            {{--                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
            {{--                        @enderror--}}
            {{--                    </div>--}}
            {{--                </div>--}}
        </div>

        {{--            <div class="col-md-12">--}}
        {{--                <div class="form-group">--}}
        {{--                    <label class="control-label">{{ __('Url') }}</label>--}}
        {{--                    <input value="" wire:model.defer="page.url" placeholder="{{ __('Add url') }}"--}}
        {{--                           name="url"--}}
        {{--                           class="form-control @error('page.url') is-invalid @enderror" type="text">--}}
        {{--                    @error('page.url')--}}
        {{--                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
        {{--                    @enderror--}}
        {{--                </div>--}}
        {{--            </div>--}}


    </div>

    <div>
        <div wire:loading>
            <i class="fas fa-sync fa-spin"></i>
            {{__("Loading please wait")}} ...
        </div>
    </div>
    <div class="modal-footer justify-content-center mt-2">
        <button wire:loading.attr="disabled" class="btn btn-primary mx-4 w-25"
                type="submit">{{__("Update")}}</button>
        <button type="button" class="btn btn-danger close-btn w-25" data-bs-dismiss="modal">{{__("Close")}}</button>
    </div>
</form>

