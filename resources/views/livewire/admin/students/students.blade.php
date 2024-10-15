<div>

    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Students")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <a class="btn btn-primary" href="{{ route('students.export') }}">
                        <i class="fa fa-download"></i> Download Excel
                    </a>
                    <div class="d-inline">
                        @if(auth()->user()->can('students create') )
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreateStudent"
                               wire:click.prevent="CreateStudent" data-bs-original-title="" title="">
                                <i class="fa-solid fa-user-plus pe-1"></i> {{__("Create Student")}} </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">
                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("البحث")}} </label>
                            <input type="text" wire:model.defer="search_all" class="form-control border-primary"
                                   placeholder="البحث"
                                   id="PatientName">
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Name")}} </label>
                            <input type="text" wire:model.defer="name" class="form-control border-primary"
                                   placeholder="البحث بالاسم"
                                   id="PatientName">
                        </div>
                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("username")}} </label>
                            <input type="text" wire:model.defer="username" class="form-control border-primary"
                                   placeholder="البحث بالاسم"
                                   id="PatientName">
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">{{__("Status")}}</label>
                            <select class="form-select border-primary" wire:model.defer="status_id">
                                <option value="">{{__("Select")}} ...</option>
                                <option value="3">{{ __('Awaiting review')}}</option>
                                <option value="1">{{ __('Acceptable')}}</option>
                                <option value="2">{{ __('Disabled')}}</option>
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Email")}} </label>
                            <input type="text" wire:model.defer="email" class="form-control border-primary"
                                   placeholder="{{__("Email")}}"
                                   id="PatientName">
                        </div>
                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Mobile")}} </label>
                            <input type="text" wire:model.defer="mobile" class="form-control border-primary"
                                   placeholder="059000000"
                                   id="PatientName">
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
                        <div class="col-md-1 col-sm-2 col-2 align-self-end">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary py-2 w-100">
                                <i wire:loading class="fas fa-sync fa-spin"></i>
                                <i class="fa-solid py-1 fa-magnifying-glass"></i>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive-md pb-3">
                @if($students->count() > 0)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("Name")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("username")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Email")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Mobile")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Coach")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Status")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الحصص المتبقية</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">المستوي</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Role")}}</div>
                            </th>

                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التحكم</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $key => $student)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $students->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        {{$student->name}}
                                    </div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        {{$student->username}}
                                    </div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$student->email}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$student->mobile}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$student->coach ? $student->coach->name : 'فارغ'}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{\App\Models\User::statusList($student->status)}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">{{$student->lesson_motabaky}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">{{$student->level->name}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">{{ __($student->roles->pluck('name')->implode(',')) }}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">

                                        {{--                                        @if(auth()->user()->can('students show') )--}}
                                        {{--                                            <a href="{{route('admin.students.show',$student->id)}}"--}}
                                        {{--                                               class="btn btn-sm mx-1 btn-secondary">--}}
                                        {{--                                                <i class="fa-solid fa-eye"></i>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        @endif--}}
                                        <a class="btn btn-sm mx-1 btn-light"
                                        href="#" data-bs-toggle="modal" data-bs-target="#HistoryStudent"
                                        wire:click="HistoryStudent({{$student->id}})"
                                        title="{{__("history")}}"><i class="fa-solid fa-clock-rotate-left"></i> </a>

                                        @if(auth()->user()->can('students edit') )
                                            <a class="btn btn-sm mx-1 btn-primary"
                                               href="#" data-bs-toggle="modal" data-bs-target="#EditStudent"
                                               wire:click="EditStudent({{$student->id}})"
                                               title="{{__("Edit")}}"><i
                                                    class="fa fa-edit"></i> </a>
                                        @endif
                                        @if(auth()->user()->can('students delete') )
                                            <a class="btn btn-sm mx-1 btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$student->id}})"
                                               data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                        {{$students->links()}}
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

@if(auth()->user()->can('students create') )
    <!--  Modal CreateStudent -->
        <div wire:ignore.self class="modal fade " id="CreateStudent" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Student') }}</h5>
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
                        @if($create_student)
                            @livewire('admin.students.students-create')
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--  Modal CreateStudent -->
    @endif

    @if(auth()->user()->can('students edit'))

        <div wire:ignore.self class="modal fade " id="EditStudent" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Student') }}</h5>
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
                        @if($student_id)
                            @livewire('admin.students.students-edit',[$student_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endif



    <div wire:ignore.self class="modal fade " id="HistoryStudent" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('History Student') }}</h5>
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
                    @if($student_id)
                        @livewire('admin.students.students-history',[$student_id])
                    @endif
                </div>
            </div>
        </div>
    </div>


    @if(auth()->user()->can('students delete') )
    <!-- Modal deleteModal -->
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{__("Delete Confirm")}}</h5>
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
        <!-- Modal deleteModal -->
    @endif

</div>
