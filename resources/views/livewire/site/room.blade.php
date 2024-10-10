<div>

    <div class="container-fluid ">
        <div class="row">
            @foreach ($coaches as $coach)
                            
            
                @if ($coach->coach_users_lessons->count() > 0 and $coach->coach_lessons()->whereBetween('date', [$from . " 00:00:00", $from . " 23:59:59"])->count() > 0 )
                    <div class="col-md-6">
                        <div class="m-4">
                            <div class="table-responsive"  wire:poll.60000ms>
                                <h3 class="border alert alert-secondary text-center"> المدرب {{$coach->name}} / المستوى
                                    {{ \App\Models\Level::where('id',$coach->coach_lessons()->value('level_id'))->value('name') }} </h3>
                                <table class="table">
                                    <thead style="background-color: #DB903C;">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الطالب</th>
                                        <th>الموعد</th>
                                        <th>الموقع</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($coach->coach_lessons()->whereBetween('date', [$from . " 00:00:00", $from . " 23:59:59"])->get() as $key => $coach_user)
                                            @foreach ($coach_user->users as $user_lesson)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$user_lesson->user ? $user_lesson->user->name : 'الطالب محذوف'}}</td>
                                                    <td>{{ $user_lesson->lesson ? date('g:i:s A', strtotime($user_lesson->lesson->date)) : 'الدرس محذوف' }}</td>
                                                    <td>{{$user_lesson->lesson ? $user_lesson->lesson->location : 'الدرس محذوف'}}</td>
                                                </tr>
                                            @endforeach

                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

    </div>


</div>
