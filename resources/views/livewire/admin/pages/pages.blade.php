<div>
    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__("Pages")}}</h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
{{--                        @if(auth()->user()->can('pages create') )--}}
{{--                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#CreatePage"--}}
{{--                               data-bs-original-title="" title=""><i--}}
{{--                                    class="fa-solid fa-user-plus pe-1"></i> {{__("Create Page")}} </a>--}}
{{--                        @endif--}}
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">

                        <div class="col-md-4 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Title")}}</label>
                            <input type="text" class="form-control border-primary" wire:model.defer="title"
                                   placeholder="ابحث "
                                   id="PatientName">
                        </div>

                        <div class="col-md-4 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">{{__("Description")}}</label>
                            <input type="text" class="form-control border-primary" wire:model.defer="description"
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
                @if($pages->count() > 0)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Image")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Title")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Description")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التحكم</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $key => $page)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $pages->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        <a class="text-decoration-none text-dark"
                                           href="{{ $page->image ? $page->image : url('dashboard/images/newspaper.png')}}"
                                           data-fancybox="gallery-{{$page->id}}"
                                           data-caption="{{$page->name}}">
                                            <img
                                                src="{{ $page->image ? $page->image : url('dashboard/images/newspaper.png')}}"
                                                width="25" class="pe-1"
                                                data-holder-rendered="true">
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$page->title}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ Str::limit($page->description,50) }}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">

                                        @if(auth()->user()->can('pages edit') )
                                            <a class="btn btn-sm mx-1 btn-primary text-white border-end" href="#"
                                               wire:click.prevent="EditPage({{$page->id}})"
                                               data-bs-toggle="modal" data-bs-target="#EditPage">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->can('pages delete') )
                                            <a class="btn btn-sm mx-1 btn-danger" href="#"
                                               wire:click.prevent="deleteId({{$page->id}})"
                                               data-bs-toggle="modal" data-bs-target="#deleteModalPage">
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
                        {{$pages->links()}}
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

{{--@if(auth()->user()->can('pages create') )--}}
{{--    <!--  Modal CreatePage -->--}}
{{--        <div wire:ignore.self class="modal fade " id="CreatePage" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content text-center">--}}
{{--                    <div class="modal-header text-center">--}}
{{--                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Create Page') }}</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true"></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div>--}}
{{--                            <div wire:loading>--}}
{{--                                <i class="fas fa-sync fa-spin"></i>--}}
{{--                                {{__("Loading please wait")}} ...--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @livewire('admin.posts.pages-create')--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!--  Modal CreatePage -->--}}
{{--@endif--}}

@if(auth()->user()->can('pages edit') )
    <!--  Modal EditPage -->
        <div wire:ignore.self class="modal fade " id="EditPage" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ __('Edit Page') }}</h5>
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
                        @if($page_id)
                            @livewire('admin.pages.pages-edit',[$page_id])
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!--  Modal EditPage -->
@endif

@if(auth()->user()->can('pages delete') )
    <!-- Modal deleteModalPage -->
        <div wire:ignore.self class="modal fade" id="deleteModalPage" tabindex="-1" role="dialog"
             aria-labelledby="deleteModalPageLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalPageLabel">{{__("Delete Confirm")}}</h5>
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
        <!-- Modal deleteModalPage -->
    @endif

</div>
