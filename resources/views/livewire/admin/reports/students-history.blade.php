<div>
    <div class="bg-white">
        <div class="container">
            @livewire('admin.layouts.sidebar-header-reports')
        </div>
    </div>
    <div class="container-fluid py-3">
        @include('layouts.admins.alert')
        <div class="main h-100">
            <div class="row g-0 mb-3">
                <div class="col-md-3 align-self-end">

                </div>

            </div>
    <div class="table-responsive-md pb-3">
        @if(isset($users) && $users->count() > 0)
        <h3>{{$user_name}}</h3>
        <table class="table table-borderless mb-md-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                    </th>

                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> المدرب</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> اسم الدرس</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> الموقع</div>
                    </th>

                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> الحصان</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> المستوي</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الدقائق</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> الحالة</div>
                    </th>

                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> تاريخ البدء</div>
                    </th>
                                        <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> تاريخ الانتهاء</div>
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td class="text-center p-1">
                            <div class="table-os">{{ $key++ }}</div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->coach?->name}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->lesson?->name}}
                            </div>
                        </td>
                                                <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->lesson?->location}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->horse?->name}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->level?->name}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->number_hours}}
                            </div>
                        </td>
                        
                        
                        
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->status == 1 ? 'حاضر':'غائب'}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">{{ \Carbon\Carbon::parse($user?->lesson?->date)->format('H:i:s Y-m-d') }}</div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">{{ \Carbon\Carbon::parse($user?->time_end)->format('H:i:s Y-m-d') }}</div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pt-2">
                {{$users->links()}}
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

</div>




