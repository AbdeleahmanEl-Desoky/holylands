<form class="mt-2" method="post" wire:submit.prevent="store">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="text-center mb-3">
                    <label for="File1" class="pointer">
                    <span class="img-edit mx-auto">
                        @if($imageTemp)
                            <img  width="120" height="120" src="{{ $imageTemp->temporaryUrl() }}" alt="">
                        @else
                            <img  width="120" height="120" src="{{ empty(['image']) ? url(empty(['image'])) : url('dashboard/images/lesson.png')}}" alt="">
                        @endif

                    </span>
                        <span class="d-block po mt-2"> اضغط هنا لاضافة الصورة</span>
                        @error('imageTemp')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </label>
                    <input type="file" wire:model.defer="imageTemp" accept=".jpg, .jpeg, .png" class="d-none" id="File1">
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

                <div class="col-md-6 mb-2 mt-4">
                    <div class="form-group mb-3">
                        <label class="control-label shadow-sm text-start btn btn-light mb-0 w-100 rounded fs-6 py-2"
                               style="cursor: pointer">
                            <input type="checkbox" class="checkbox_animated" value="1"
                                   wire:model="lesson.repetition"/>
                        تكرار اسبوعي
                        </label>
                    </div>
                </div>

                <div class="col-md-6 mb-2 mt-4">
                    <div class="form-group mb-3">
                        <label class="control-label shadow-sm text-start btn btn-light mb-0 w-100 rounded fs-6 py-2"
                               style="cursor: pointer">
                            <input type="checkbox" class="checkbox_animated" value="1"
                                   wire:model="lesson.time"/>
                            تكرار يومي
                        </label>
                    </div>
                </div>

                @if($lesson['repetition'])

                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label class="control-label">عدد التكرار</label>
                            <input wire:model.defer="lesson.repetition_number" placeholder="اضافة العدد"
                                   class="form-control @error('lesson.repetition_number') is-invalid @enderror" type="number">
                            @error('lesson.repetition_number')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                @endif

                @if($lesson['time'])

                    <div class="col-md-12 mb-2">

                        @foreach ($lesson_times as $key => $lesson_time)
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <div class="form-group mb-0">
                                        <label class="control-label"> {{ __('date lesson') }} {{$key}}</label>
                                        <input value="" wire:model.defer="lesson_times.{{$key}}.date"
                                               placeholder="{{ __('Add Name') }}"
                                               name="date"
                                               class="form-control  @error('lesson_times.'.$key.'.date') is-invalid @enderror"
                                               type="datetime-local">
                                        @error('lesson_times.'.$key.'.date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-2 form-group mb-2 ">
                                    @if(count($lesson_times) > 1 and $key > 0)
                                        <label for="episode-add" class="control-label d-block">حذف </label>
                                        <button class="btn btn-sm btn-danger mx-auto"
                                                wire:click.prevent="RemoveLessonTime({{$key}})"><i
                                                class="fas fa-minus"></i></button>
                                    @else
                                        <label for="episode-add" class="control-label d-block">إضافة </label>
                                        <button class="btn btn-sm btn-success mx-auto"
                                                wire:click.prevent="AddLessonTime()"><i
                                                class="fas fa-plus"></i></button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif

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
                type="submit">{{__("Store")}}</button>
        <button type="button" class="btn btn-danger close-btn" data-bs-dismiss="modal">{{__("Close")}}</button>
    </div>

</form>

