<div>
    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Levels")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
                        @if(auth()->user()->can('levels create') )
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreateLevel"
                               wire:click.prevent="CreateLevel" data-bs-original-title="" title=""><i
                                    class="fa-solid fa-user-plus pe-1"></i> {{__("Create Level")}} </a>
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
                @if($levels->count() > 0)
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
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Count Students")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Count Lessons")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التحكم</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($levels as $key => $level)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $levels->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$level->name}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$level->users->count()}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$level->lessons->count()}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">

                                        @if(auth()->user()->can('levels edit') )
                                            <a class="btn btn-sm mx-1 btn-primary text-white border-end" href="#"
                                               wire:click.prevent="EditLevel({{$level->id}})"
                                               data-bs-toggle="modal" data-bs-target="#EditLevel">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
{{--                                        @if(auth()->user()->can('levels delete') )--}}
{{--                                            <a class="btn btn-sm mx-1 btn-danger" href="#"--}}
{{--                                               wire:click.prevent="deleteId({{$level->id}})"--}}
{{--                                               data-bs-toggle="modal" data-bs-target="#deleteModalLevel">--}}
{{--                                                <i class="fa-solid fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pt-2">
                        {{$levels->links()}}
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

@if(auth()->user()->can('levels create') )

    <!--  Modal CreateLevel -->
        <div wire:ignore.self class="modal fade " id="CreateLevel" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Level') }}</h5>
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
                        @if($create_level)
                            @livewire('admin.levels.levels-create',[$level_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal CreateLevel -->
@endif

@if(auth()->user()->can('levels edit') )
    <!--  Modal EditLevel -->
        <div wire:ignore.self class="modal fade " id="EditLevel" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Level') }}</h5>
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
                        @if($level_id)
                            @livewire('admin.levels.levels-edit',[$level_id])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  Modal EditLevel -->
@endif

{{--@if(auth()->user()->can('levels delete') )--}}
{{--    <!-- Modal deleteModalLevel -->--}}
{{--        <div wire:ignore.self class="modal fade" id="deleteModalLevel" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="deleteModalLevelLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="deleteModalLevelLabel">{{__("Delete Confirm")}}</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true close-btn"></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <p>{{__("Are you sure want to delete?")}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary close-btn"--}}
{{--                                data-bs-dismiss="modal">{{__("Close")}}</button>--}}
{{--                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"--}}
{{--                                data-bs-dismiss="modal">{{__("Yes, Delete")}}</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Modal deleteModalLevel -->--}}
{{--    @endif--}}

</div>
