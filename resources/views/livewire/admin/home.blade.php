<section class="container">
    <div class="row max-w970 mx-auto mt-md-5 mt-3">
        <div class="col-12"><h1 class="text-primary h-3 text-center mb-4">الصفحة الرئيسية </h1></div>


        @foreach($models as $index => $model)
            <div class="col-md-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-2 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-2 g-1">
                        <div class="col-sm-5 text-center">
                            @if ($index == "Roles"  )
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/00.png')}}" alt="">
                            @elseif ($index == "Coaches"  )
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/coach.png')}}" alt="">
                            @elseif($index == "Students")
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/user.png')}}"
                                     alt="">
                            @elseif($index == "Lessons")
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/lesson.png')}}"
                                     alt="">
                            @elseif($index == "Contacts")
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/new-email.png')}}"
                                     alt="">
                            @else
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/list.png')}}" alt="">
                            @endif
                        </div>
                        <div class="col-sm-7 text-sm-start text-center">
                            <h5 class="fw-bold mb-0"> عدد {{ __($index) }} </h5>
                            <h2 class="fw-bolder fs-45p text-primary text-black pah mb-0">{{$model}}</h2>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

        @foreach($levels as $key => $level)
            <div class="col-md-4 col-6 mb-4">
                <div class="card shadow border-0 rounded-2 p-md-3 p-2 h-100">
                    <div class="row h-100 align-items-center g-md-2 g-1">
                        <div class="col-sm-5 text-center">
                            @if ($level->order == 1  )
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/level-1.png')}}"
                                     alt="">
                            @elseif ($level->order == 2  )
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/level-2.png')}}"
                                     alt="">
                            @elseif($level->order == 3)
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/level-3.png')}}"
                                     alt="">
                            @elseif($level->order == 4)
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/level-4.png')}}"
                                     alt="">
                            @else
                                <img width="70" class="img-fluid" src="{{asset('dashboard/images/levels.png')}}"
                                     alt="">
                            @endif
                        </div>
                        <div class="col-sm-7 text-sm-start text-center">
                            <h5 class="fw-bold mb-0"> طلاب {{$level->name}}</h5>
                            <h2 class="fw-bolder fs-45p text-primary text-black pah mb-0"> {{$level->users->count()}}</h2>

                        </div>
                    </div>
                </div>
            </div>

        @endforeach


    </div>
</section>
