<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{ __('Full Name') }}</label>
                        <input value="" wire:model.defer="user.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('user.name') is-invalid @enderror" type="text">
                        @error('user.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{ __('username') }}</label>
                        <input value="" wire:model.defer="user.username" placeholder="{{ __('Add username') }}"
                               name="username"
                               class="form-control @error('user.username') is-invalid @enderror" type="text">
                        @error('user.username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Mobile")}}</label>
                        <input wire:model.defer="user.mobile" placeholder="{{__("Add Mobile")}}"
                               class="form-control @error('user.mobile') is-invalid @enderror" type="number">
                        @error('user.mobile')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Email")}}</label>
                        <input wire:model.defer="user.email" placeholder="{{__("Add Email")}}"

                               class="form-control @error('user.email') is-invalid @enderror" type="email">
                        @error('user.email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Password")}} </label>
                        <input value="" wire:model.defer="user.password" placeholder="{{__("Add Password")}}"

                               class="form-control @error('user.password') is-invalid @enderror" type="password">
                        @error('user.password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("birth_date")}}</label>
                        <input wire:model.defer="user.birth_date" placeholder="{{__("Add birth_date")}}"
                               class="form-control @error('user.birth_date') is-invalid @enderror" type="date">
                        @error('user.birth_date')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("place_of_birth")}}</label>
                        <input wire:model.defer="user.place_of_birth" placeholder="{{__("Add place_of_birth")}}"
                               class="form-control @error('user.place_of_birth') is-invalid @enderror" type="text">
                        @error('user.place_of_birth')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("nationality")}}</label>
                        <input wire:model.defer="user.nationality" placeholder="{{__("Add nationality")}}"
                               class="form-control @error('user.nationality') is-invalid @enderror" type="text">
                        @error('user.nationality')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("job")}}</label>
                        <input wire:model.defer="user.job" placeholder="{{__("Add job")}}"
                               class="form-control @error('user.job') is-invalid @enderror" type="text">
                        @error('user.job')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("affiliation_date")}}</label>
                        <input wire:model.defer="user.affiliation_date" placeholder="{{__("Add affiliation_date")}}"
                               class="form-control @error('user.affiliation_date') is-invalid @enderror" type="date">
                        @error('user.affiliation_date')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("address")}}</label>
                        <input wire:model.defer="user.address" placeholder="{{__("Add address")}}"
                               class="form-control @error('user.address') is-invalid @enderror" type="text">
                        @error('user.address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("blood_type")}}</label>
                        <input wire:model.defer="user.blood_type" placeholder="{{__("Add blood_type")}}"
                               class="form-control @error('user.blood_type') is-invalid @enderror" type="text">
                        @error('user.blood_type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("url_facebook")}}</label>
                        <input wire:model.defer="user.url_facebook" placeholder="{{__("Add url_facebook")}}"
                               class="form-control @error('user.url_facebook') is-invalid @enderror" type="text">
                        @error('user.url_facebook')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("lesson_count")}}</label>
                        <input wire:model.defer="user.lesson_count" placeholder="{{__("Add lesson_count")}}"
                               class="form-control @error('user.lesson_count') is-invalid @enderror" type="number">
                        @error('user.lesson_count')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Coaches")}}</label>
                        <select wire:model.defer="user.coach_id"
                                class="form-control @error('user.coach_id') is-invalid @enderror">
                            <option value="0">{{__("Select Coach")}} ...</option>
                            @foreach($coaches as $key => $coach)
                                <option value="{{$coach->id}}">{{$coach->name}}</option>
                            @endforeach
                        </select>
                        @error('user.coach_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Levels")}}</label>
                        <select wire:model.defer="user.level_id"
                                class="form-control @error('user.level_id') is-invalid @enderror">
                            <option value="0">{{__("Select Level")}} ...</option>
                            @foreach($levels as $key => $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                        @error('user.level_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Status")}}</label>
                        <select wire:model.defer="user.status"
                                class="form-control @error('user.status') is-invalid @enderror">
                            <option value="0">{{__("Select Status")}} ...</option>
                            @foreach(\App\Models\User::statusList(false) as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('user.status')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
    <div class="modal-footer justify-content-center mt-2">
        <button wire:loading.attr="disabled" class="btn btn-primary mx-4"
                type="submit">{{__("Store")}}</button>
        <button type="button" class="btn btn-danger close-btn" data-bs-dismiss="modal">{{__("Close")}}</button>
    </div>

</form>

