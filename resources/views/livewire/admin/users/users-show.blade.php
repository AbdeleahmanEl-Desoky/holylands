<div style="display: contents">

    <!-- Page header -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>{{__('Users Show')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__("Home")}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.users')}}">{{__('Users')}}</a></li>
                            <li class="breadcrumb-item active">{{__('Users Show')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /page header -->


    <!-- Content area -->
    <div class="content">
        <div class="container-fluid">

            @include('layouts.admins.alert')
            <div class="row">
                <div class="col-sm-12 col-lg-12 xl-100">
                    <div class="card-body">
                        <div class="default-according" id="accordionicon">
                            <div class="card">
                                <div class="card-header bg-primary" id="heading11">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-white" data-bs-toggle="collapse"
                                                data-bs-target="#collapse11" aria-expanded="true"
                                                aria-controls="collapse11"><i class="fa fa-user"></i>{{$user->name}}
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse show" id="collapse11" aria-labelledby="headingOne"
                                     data-bs-parent="#accordionicon">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table border">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__("Image")}}</th>
                                                    <th>{{__("Full Name")}}</th>
                                                    <th>{{__("Mobile")}}</th>
                                                    <th>{{__("Email")}}</th>
                                                    <th>{{__("Status")}}</th>
                                                    <th>{{__("Role")}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">{{$user->id}}</th>
                                                    <td>
                                                        <img width="70" class="rounded-circle img-thumbnail"
                                                             src="{{ $user->image ? $user->image : url('dashboard/images/1.png')}}"
                                                             data-holder-rendered="true">
                                                    </td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @if($user->status == 1  )
                                                            <span
                                                                class="btn btn-success btn-xs">{{ \App\Models\User::statusList($user->status)}}</span>
                                                        @elseif( $user->status == 2)
                                                            <span
                                                                class="btn btn-danger btn-xs">{{ \App\Models\User::statusList($user->status)}}</span>
                                                        @elseif( $user->status == 0)
                                                            <span
                                                                class="btn btn-info btn-xs">{!! \App\Models\User::statusList($user->status) !!}</span>
                                                        @else
                                                            <span
                                                                class="btn btn-primary btn-xs">{!! \App\Models\User::statusList($user->status) !!}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ __($user->roles->pluck('name')->implode(',')) }}
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>


