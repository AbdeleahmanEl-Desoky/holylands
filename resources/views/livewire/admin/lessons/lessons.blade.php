<div>
    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Lessons")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
                        @if(auth()->user()->can('lessons create') )
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreateLesson"
                               wire:click.prevent="CreateLesson" data-bs-original-title="" title=""><i
                                    class="fa-solid fa-user-plus pe-1"></i> {{__("Create Lesson")}} </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">

                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">اسم الحصة</label>
                            <input type="text" class="form-control border-primary" wire:model.defer="name"
                                   placeholder="ابحث "
                                   id="PatientName">
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">{{__("Coaches")}}</label>
                            <select class="form-select border-primary" wire:model.defer="coach_id">
                                <option value="0">{{__("Select")}} ...</option>
                                @foreach($coaches as $coach)
                                    <option value="{{$coach->id}}">{{ $coach->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">{{__("Levels")}}</label>
                            <select class="form-select border-primary" wire:model.defer="level_id">
                                <option value="0">{{__("Select")}} ...</option>
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}">{{ $level->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">حالة الدرس</label>
                            <select class="form-select border-primary" wire:model.defer="date_status">
                                <option value="0">{{__("Select")}} ...</option>
                                <option value="1">لم تتنهى بعد</option>
                                <option value="2">منتهي</option>

                            </select>
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("date lesson")}}</label>
                            <input type="date" class="form-control border-primary" wire:model.defer="date"
                                   id="PatientName">
                        </div>

                        <div class="col-md-1 col-sm-2 col-2 align-self-end">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary py-2 w-100">
                                <i wire:loading class="fas fa-sync fa-spin"></i>
                                <i class="fa-solid py-1 fa-magnifying-glass"></i>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive pb-3">
                @if($lessons->count() > 0)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Name")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Coach")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Level")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("number_hours")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("number_students")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div
                                    class="bg-primary rounded-2 text-white py-2 px-1">{{__("number_students_booking")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("repetition")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("date lesson")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1"> الوقت المتبقى</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التحكم</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $key => $lesson)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $lessons->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        @if (!empty($lesson->image))
                                            <a class="text-decoration-none text-dark"
                                               href="{{ $lesson->image ? $lesson->image : url('dashboard/images/lesson.png')}}"
                                               data-fancybox="gallery-{{$lesson->id}}"
                                               data-caption="{{$lesson->name}}">
                                                <img
                                                    src="{{ $lesson->image ? $lesson->image : url('dashboard/images/lesson.png')}}"
                                                    width="25" class="pe-1"
                                                    data-holder-rendered="true">
                                                {{$lesson->name}}
                                            </a>
                                        @else
                                            {{$lesson->name}}
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$lesson->coach ? $lesson->coach->name : ''}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$lesson->level ? $lesson->level->name : ''}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$lesson->number_hours}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$lesson->number_students}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$lesson->users->count()}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">@if($lesson->repetition) <i
                                            class="fa-solid fa-check"></i>  @else - @endif</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ date('d/m/Y g:i:s A', strtotime($lesson->date))}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        @if($lesson->date <= Carbon\Carbon::now() and $lesson->created_at >= Carbon\Carbon::now())
                                            جارية الان
                                        @elseif($lesson->date > Carbon\Carbon::now())
                                            <span class="btn btn-secondary btn-sm">{{ \Carbon\Carbon::parse($lesson->date)->diffForHumans() }} <i class="fa-solid fa-clock"></i></span>
                                        @else
                                            <span class="btn btn-danger btn-sm">منتهي</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">

                                        @if(auth()->user()->can('lessons show') )
                                            <a href="{{route('admin.lessons.show',$lesson->id)}}"
                                               class="btn btn-sm mx-1 btn-light">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->can('lessons edit') )
                                            <a class="btn btn-sm mx-1 btn-primary text-white border-end" href="#"
                                               wire:click.prevent="EditLesson({{$lesson->id}})"
                                               data-bs-toggle="modal" data-bs-target="#EditLesson">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->can('lessons delete') )
                                            <a class="btn btn-sm mx-1 btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$lesson->id}})"
                                               data-bs-toggle="modal" data-bs-target="#deleteModalLesson">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{$lessons->links()}}
                    </div>
                @else
                    <div class="text-center e404 py-3">
                        <img width="210" class="img-fluid mb-3" src="{{asset('dashboard/images/error.svg')}}" alt="">
                        <h4>{{__("Empty list")}}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

@if(auth()->user()->can('lessons create') )

    <!--  Modal CreateLesson -->
        <div wire:ignore.self class="modal fade " id="CreateLesson" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Lesson') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($create_lesson)
                            @livewire('admin.lessons.lessons-create',[$lesson_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateLesson -->
@endif

@if(auth()->user()->can('lessons edit') )
    <!--  Modal EditLesson -->
        <div wire:ignore.self class="modal fade " id="EditLesson" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Lesson') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div wire:loading>
                                <i class="fas fa-sync fa-spin"></i>
                                {{__("Loading please wait")}} ...
                            </div>
                        </div>
                        @if($lesson_id)
                            @livewire('admin.lessons.lessons-edit',[$lesson_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditLesson -->
@endif

@if(auth()->user()->can('lessons delete') )
    <!-- Modal deleteModalLesson -->
        <div wire:ignore.self class="modal fade" id="deleteModalLesson" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalLessonLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLessonLabel">{{__("Delete Confirm")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{__("Are you sure want to delete?")}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                                data-bs-dismiss="modal">{{__("Yes, Delete")}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal deleteModalLesson -->
    @endif

</div>
