<div>

    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Coaches")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
                        @if(auth()->user()->can('coaches create') )
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreateCoach"
                               wire:click.prevent="CreateCoach" data-bs-original-title="" title="">
                                <i class="fa-solid fa-user-plus pe-1"></i> {{__("Create Coach")}} </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">
                        <div class="col-md-3 col-sm-7">
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
                        <div class="col-md-3 col-sm-7">
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
                @if($coaches->count() > 0)
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
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Count Students")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Status")}}</div>
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
                        @foreach($coaches as $key => $coach)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $coaches->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$coach->name}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$coach->username}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$coach->email}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$coach->mobile}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$coach->users->count()}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{\App\Models\User::statusList($coach->status)}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ __($coach->roles->pluck('name')->implode(',')) }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">

{{--                                        @if(auth()->user()->can('coaches show') )--}}
{{--                                            <a href="{{route('admin.coaches.show',$coach->id)}}"--}}
{{--                                               class="btn btn-sm mx-1 btn-secondary">--}}
{{--                                                <i class="fa-solid fa-eye"></i>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                        @if(auth()->user()->can('coaches edit') )
                                            <a class="btn btn-sm mx-1 btn-primary"
                                               href="#" data-bs-toggle="modal" data-bs-target="#EditCoach"
                                               wire:click="EditCoach({{$coach->id}})"
                                               title="{{__("Edit")}}"><i
                                                    class="fa fa-edit"></i> </a>
                                        @endif
                                        @if(auth()->user()->can('coaches delete') )
                                            <a class="btn btn-sm mx-1 btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$coach->id}})"
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
                        {{$coaches->links()}}
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

@if(auth()->user()->can('coaches create') )
    <!--  Modal CreateCoach -->
        <div wire:ignore.self class="modal fade " id="CreateCoach" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Coach') }}</h5>
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
                        @if($create_coach)
                            @livewire('admin.coaches.coaches-create')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateCoach -->
    @endif

    @if(auth()->user()->can('coaches edit'))

        <div wire:ignore.self class="modal fade " id="EditCoach" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Coach') }}</h5>
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
                        @if($coach_id)
                            @livewire('admin.coaches.coaches-edit',[$coach_id])
                        @endif

                    </div>
                </div>
            </div>
        </div>

    @endif

    @if(auth()->user()->can('coaches delete') )
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
