<div>
    <div class="container-fluid py-3 mt-4">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h4 class="text-primary">اسم الدرس /  <span>{{$lesson->name}}</span> / <span class="text-danger">{{__("Lessons Show")}}</span> </h4>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">

                    </div>
                </div>
                <div class="col-md-9">
                </div>
            </div>
            <div class="table-responsive pb-3">
                @if($user_lessons->count() > 0)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">اسم الطالب</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("attendance")}}</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user_lessons as $key => $user_lesson)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key+1 }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$user_lesson->user ? $user_lesson->user->name : ''}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">
                                        @if($user_lesson->status)
                                            <i class="fa-solid fa-check text-success fw-bold"></i>
                                        @else
                                            <i class="fa-solid fa-xmark text-danger fw-bold"></i>
                                        @endif
                                       </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center e404 py-3">
                        <img width="210" class="img-fluid mb-3" src="{{asset('dashboard/images/error.svg')}}" alt="">
                        <h4>{{__("Empty list")}}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
