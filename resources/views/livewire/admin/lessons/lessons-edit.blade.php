<form class="mt-2" method="post" wire:submit.prevent="update">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="text-center mb-3">
                    <label for="File1" class="pointer">
                    <span class="img-edit mx-auto">
                        @if($imageTemp)
                            <img
                                width="120" height="120"
                                src="{{ $imageTemp->temporaryUrl() }}">
                        @else
                            @if(!empty($lesson['image']))
                                <img
                                    width="120" height="120" data-holder-rendered="true"
                                    src="{{ $lesson['image']}}">
                            @endif
                        @endif
                    </span>
                        <span class="d-block po mt-2"> اضغط هنا لتعديل الصورة</span>
                        @error('imageTemp')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </label>
                    <input type="file" wire:model.defer="imageTemp" accept=".jpg, .jpeg, .png"
                           class="d-none @error('imageTemp') is-invalid @enderror "
                           id="File1">
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <input value="" wire:model.defer="lesson.name" placeholder="{{ __('Add Name') }}"
                               name="name"
                               class="form-control @error('lesson.name') is-invalid @enderror" type="text">
                        @error('lesson.name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("date lesson")}}</label>
                        <input wire:model.defer="lesson.date"
                               class="form-control @error('lesson.date') is-invalid @enderror" type="datetime-local">
                        @error('lesson.date')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Levels")}}</label>
                        <select wire:model.defer="lesson.level_id"
                                class="form-control @error('lesson.level_id') is-invalid @enderror">
                            <option value="0">{{__("Select Level")}} ...</option>
                            @foreach($levels as $key => $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                        @error('lesson.level_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("Coaches")}}</label>
                        <select wire:model.defer="lesson.coach_id"
                                class="form-control @error('lesson.coach_id') is-invalid @enderror">
                            <option value="0">{{__("Select Coach")}} ...</option>
                            @foreach($coaches as $key => $coach)
                                <option value="{{$coach->id}}">{{$coach->name}}</option>
                            @endforeach
                        </select>
                        @error('lesson.coach_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("number_hours")}}</label>
                        <input wire:model.defer="lesson.number_hours" placeholder="{{__("Add number_hours")}}"
                               class="form-control @error('lesson.number_hours') is-invalid @enderror" type="number">
                        @error('lesson.number_hours')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{__("number_students")}}</label>
                        <input wire:model.defer="lesson.number_students" placeholder="{{__("Add number_students")}}"
                               class="form-control @error('lesson.number_students') is-invalid @enderror" type="number">
                        @error('lesson.number_students')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label class="control-label">الموقع</label>
                        <input value="" wire:model.defer="lesson.location" placeholder="اضافة الموقع"
                               name="location"
                               class="form-control @error('lesson.location') is-invalid @enderror" type="text">
                        @error('lesson.location')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label class="control-label">{{ __('Description') }}</label>
                        <textarea rows="5" value="" wire:model.defer="lesson.description"
                                  placeholder="{{ __('Add Description') }}"
                                  id="description" data-description="@this" name="description"
                                  class="form-control editor @error('lesson.description') is-invalid @enderror"
                                  type="text"></textarea>
                        @error('lesson.description')
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
                type="submit">{{__("Update")}}</button>
        <button type="button" class="btn btn-danger close-btn" data-bs-dismiss="modal">{{__("Close")}}</button>
    </div>

</form>

