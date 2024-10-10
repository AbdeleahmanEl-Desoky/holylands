<div style="display: contents">
    <!-- Page header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('Notifications')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}"> {{__('Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Notifications')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="container-fluid">

            @include('layouts.admins.alert')


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form class="col-md-12" wire:submit.prevent="search">
                                <div class="input-group mb-3 " style="justify-content: center">

                                    <div>
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("User Name")}}" wire:model.defer="name">
                                    </div>

                                    <div>
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("type")}}" wire:model.defer="type">
                                    </div>

                                    <div>
                                        <input type="text" class="form-control form-control-sm"
                                               style="border-radius: .1875rem !important; margin-left: 10px !important"
                                               placeholder="{{__("Description")}}" wire:model.defer="description">
                                    </div>

                                    <div class="input-group-append ">
                                        <button wire:loading.attr="disabled" class="btn btn-block btn-primary btn-sm"
                                                type="submit"><i  wire:loading class="fas fa-sync fa-spin"></i> {{__("Search")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($notifications->count() > 0)
                                <table class="table color-bordered-table info-table  info-bordered-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("User Name")}}</th>
                                        <th>{{__("Description")}}</th>
                                        <th>{{__("type")}}</th>
                                        <th>{{__("type_id")}}</th>
                                        <th>{{__("external")}}</th>
{{--                                        <th width="300">{{__("Action")}}</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notifications as  $key => $notification)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$notification->user ? $notification->user->name : ''}}</a></td>
                                            <td>{{ Str::limit($notification->description,70) }}</td>
                                            <td>{{$notification->type}}</td>
                                            <td>{{$notification->type_id }}</td>
                                            <td>{{$notification->external == 1 ? "نعم" : "لا"}}</td>
{{--                                            <td>--}}
{{--                                                @if(auth()->user()->can('notifications show'))--}}
{{--                                                <a class="btn btn-sm btn-info btn-xs"--}}
{{--                                                   href="{{route('admin.notifications.show',$notification->id)}}"--}}
{{--                                                   title="{{__("Show")}}"><i--}}
{{--                                                        class="fa fa-eye"></i> </a>--}}
{{--                                                @endif--}}

{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="pt-2">
                                    {{$notifications->links()}}
                                </div>

                            @else
                                <div class="alert alert-danger m-4">{{__("Empty list")}}</div>
                        @endif
                        <!-- /.card-body -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

