<div>
    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Roles")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
                        @if(auth()->user()->can('roles create'))
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreateRole"
                               data-bs-original-title="" title=""><i
                                    class="fa-solid fa-user-plus pe-1"></i> {{__("Create Role")}} </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">

                        <div class="col-md-4 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Name")}}</label>
                            <input type="text" class="form-control border-primary" wire:model.defer="name"
                                   placeholder="ابحث "
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
                @if($roles->count() > 0)
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
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("users")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Roles")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التحكم</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $roles->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ __($role->name) }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$role->users()->count()}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">
                                        <a class="btn btn-sm mx-1 btn-primary text-white border-end" href="#"
                                           data-bs-toggle="modal" data-bs-target="#ShowRole-{{$role->id}}">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                    </div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">

                                        @if(auth()->user()->can('roles edit') )
                                            <a class="btn btn-sm mx-1 btn-primary text-white border-end" href="#"
                                               wire:click.prevent="EditRole({{$role->id}})"
                                               data-bs-toggle="modal" data-bs-target="#EditRole">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->can('roles delete') )
                                            <a class="btn btn-sm mx-1 btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$role->id}})"
                                               data-bs-toggle="modal" data-bs-target="#deleteModalRole">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!--  Modal ShowRole -->
                                    <div wire:ignore.self class="modal fade " id="ShowRole-{{$role->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content text-center">
                                                <div class="modal-header text-center">
                                                    <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Roles') }}</h5>
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
                                                    <div class="my-4 text-end row">
                                                        <div class="col-2 mb-2"> <span class="btn btn-success rounded-2 mb-2 mx-1 text-white w-100 h-100">{!!  $role->name == "Admin" ? __("All permissions") : $role->permissions()->pluck('name')->implode('</span></div>  <div class="col-2 mb-2"> <span class="btn btn-success rounded-2 mb-2 text-white mx-1 w-100 h-100"> ') !!}</span><div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  Modal ShowRole -->

                        @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{$roles->links()}}
                    </div>
                @else
                    <div class="text-center e404 py-3">
                        <img width="400" class="img-fluid mb-3" src="{{asset('dashboard/img/img404.jpg')}}" alt="">
                        <h4>{{__("Empty list")}}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

@if(auth()->user()->can('roles create') )
    <!--  Modal CreateRole -->
        <div wire:ignore.self class="modal fade " id="CreateRole" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Role') }}</h5>
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
                        @livewire('admin.roles.roles-create')
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateRole -->
@endif

@if(auth()->user()->can('roles edit') )
    <!--  Modal EditRole -->
        <div wire:ignore.self class="modal fade " id="EditRole" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Role') }}</h5>
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
                        @if($role_id)
                            @livewire('admin.roles.roles-edit',[$role_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--  Modal EditRole -->
@endif

@if(auth()->user()->can('roles delete') )
    <!-- Modal deleteModalRole -->
        <div wire:ignore.self class="modal fade" id="deleteModalRole" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalRoleLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalRoleLabel">{{__("Delete Confirm")}}</h5>
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
        <!-- Modal deleteModalRole -->
    @endif

</div>
