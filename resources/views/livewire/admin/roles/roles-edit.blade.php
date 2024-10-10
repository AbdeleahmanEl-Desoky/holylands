<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <style>
            .checkbox_animated:after {
                border: 1px solid #727272b8!important;
            }
        </style>
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="role.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('role.name') is-invalid @enderror" type="text">
                        @error('role.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label
                        class="control-label rounded-pill fs-4 border w-100 btn btn-primary mb-2 text-center txet-wight ">{{ __('Permissions') }}</label>
                    <div class="row">

                        @foreach($allPermissions as  $key => $permissions)
                            <div class="col-md-4 col-6 border-right border-bottom">
                                <div class="pt-3">
                                    <h2 class="fw-bold">{{__(ucwords($key))}}</h2>
                                    @foreach($permissions as $permission)

                                        <div class="">
                                            <label
                                                class="shadow-sm text-start btn btn-light mb-3 w-100 rounded fs-6 py-2"
                                                style="max-width: 300px;cursor: pointer">
                                                <input type="checkbox" class="checkbox_animated" value="{{$permission['id']}}"
                                                       wire:model.defer="permissionsList.{{$permission['id']}}"/>
                                                {{$permission['name']}}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <hr>

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
    <div class="justify-content-center mt-2">
        <button wire:loading.attr="disabled" class="btn btn-primary mx-4"
                type="submit">{{__("Update")}}</button>
        <button type="button" class="btn btn-danger close-btn" data-bs-dismiss="modal">{{__("Close")}}</button>
    </div>
</form>


