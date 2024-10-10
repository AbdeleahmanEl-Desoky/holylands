<form class="modal-body " method="post" wire:submit.prevent="update">
    {{csrf_field()}}

    <div class="row g-2">

        <div class="col-md-12">
            <div class="form-group">
                <div class="card d-table p-1 m-auto">
                    @if($imageTemp)
                        <img width="150" class="img-fluid rounded"
                             src="{{ $imageTemp->temporaryUrl() }}"
                             data-holder-rendered="true">

                    @else

                        @if(!empty($post['image']))
                            <img width="200" class="img-fluid rounded"
                                 src="{{ $post['image'] }}"
                                 data-holder-rendered="true">
                        @endif
                    @endif
                </div>

                <div class="d-table p-1 m-auto uniform-uploader">
                    <input type="file" wire:model.defer="imageTemp"
                           class="form-input-styled form-control submit2 @error('imageTemp') is-invalid @enderror"
                           data-fouc=""
                    >
                    <span class="filename" >{{__("Image")}}</span>
                    @error('imageTemp')
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                </div>
            </div>
        </div>

    </div>

    <div class="row g-2">

        <div class="col-12">

            <div class="form-group">
                <label class="control-label">{{ __('Title') }}</label>
                <input value="" wire:model.defer="post.title" placeholder="{{ __('Add Title') }}"
                       name="title"
                       class="form-control @error('post.title') is-invalid @enderror" type="text">
                @error('post.title')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>


            <div class="form-group">
                <label class="control-label">{{ __('Description') }}</label>
                <textarea rows="5" value="" wire:model.defer="post.description" placeholder="{{ __('Add Description') }}"
                          id="description" data-description="@this"    name="description"
                          class="form-control editor @error('post.description') is-invalid @enderror"
                          type="text"></textarea>
                @error('post.description')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

        </div>
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

