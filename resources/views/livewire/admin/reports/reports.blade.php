<div>

    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <h2 class="text-primary">{{__('Reports')}} <span class="text-danger">( لم تنتهي بعد )</span></h2>
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">
                    <div class="d-inline">
                        @if(auth()->user()->can('reports print'))

                            {{--                            <a class="btn btn-primary  m-2 @if(empty($from) and empty($to) and empty($coach_id)) disabled  @endif"--}}
                            {{--                               target="_blank"--}}
                            {{--                               href="{{ route('admin.reports.print',['from' => $from,'to' => $to ,'coach_id' => $coach_id ]) }}"><i--}}
                            {{--                                    class="fa fa-print"></i> طباعة</a>--}}

                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">

                        <div class="col-md-2 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">{{__("Account Name")}}</label>
                            <select class="form-select border-primary" wire:model.defer="coach_id">
                                <option value="0">{{__("Select")}} ...</option>
                                @foreach($users as $key => $user)
                                    <option value="{{$user->id}}">{{ $user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">من تاريخ :</label>
                            <input type="date" class="form-control border-primary" wire:model.defer="from"
                                   placeholder="ابحث "
                                   id="PatientName">
                        </div>
                        <div class="col-md-2 col-sm-7">
                            <label class="text-primary mb-1" for="PatientName">إلى تاريخ :</label>
                            <input type="date" class="form-control border-primary" wire:model.defer="to"
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
                @if($user_lessons->count() > 0 and $coach_id)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">التاريخ</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">{{__("Name")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الحصص الكلي</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الطلاب</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد ساعات الحصص</div>
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
                                    <div
                                        class="table-os">{{ date('h:i:s m/d/Y', strtotime($user_lesson->lesson ? $user_lesson->lesson->date : null))  }}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div
                                        class="table-os">{{$user_lesson->coach ? $user_lesson->coach->name : null}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div
                                        class="table-os">{{ \App\Models\Lesson::where('coach_id',$coach_id)->count()}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div class="table-os">{{ $user_lessons->where('coach_id', $coach_id )->count()}}</div>
                                </td>

                                <td class="text-center p-1">
                                    <div
                                        class="table-os">{{ \App\Models\Lesson::where('coach_id',$coach_id)->sum('number_hours')}}</div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center e404 py-3">
                        <img width="170" class="img-fluid mb-3" src="{{asset('dashboard/images/error.png')}}" alt="">
                        <h4 class="text-danger ">{{__("Empty list")}}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
