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
                    <div class="d-inline">
                        @if(auth()->user()->can('reports print'))

                            <a class="btn btn-primary"
                               target="_blank"
                               href="{{ route('admin.students-print',['user_id' => $user_id ,'level_id' => $level_id ]) }}"><i
                                    class="fa fa-print"></i> طباعة</a>

                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row g-1 justify-content-end" wire:submit.prevent="search">
                        <div class="col-md-4 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">اسم الطالب</label>
                            <select class="form-select border-primary" wire:model.defer="user_id">
                                <option value="0">{{__("Select")}} ...</option>
                                @foreach($students as $key => $user)
                                    <option value="{{$user->id}}">{{ $user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-7">
                            <label for="WaitingList" class="text-primary mb-1">{{__("Levels")}}</label>
                            <select class="form-select border-primary" wire:model.defer="level_id">
                                <option value="0">{{__("Select")}} ...</option>
                                @foreach($levels as $key => $level)
                                    <option value="{{$level->id}}">{{ $level->name}}</option>
                                @endforeach
                            </select>
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
            <div class="table-responsive-md pb-3">
                @if($users->count() > 0)
                    <table class="table table-borderless mb-md-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("Name")}}</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الدروس</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">المستوى</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الدروس المسجلة</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الدروس المتبقية</div>
                            </th>
                            <th scope="col" class="text-center p-1">
                                <div class="bg-primary rounded-2 text-white py-2 px-1">عدد الدقائق</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $key + $users->firstItem() }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{$user->name}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $user->lesson_count }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os">{{ $user->level ? $user->level->name : 'فارغ' }}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os"> {{$user->lessons}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os"> {{ $user->lesson_count - $user->lessons}}</div>
                                </td>
                                <td class="text-center p-1">
                                    <div class="table-os"> {{ $user->lessons_sum_hours}}</div>
                                </td>
                              
                                <td>
                                    
                                <a class="btn btn-primary"
                               target="_blank"
                               href="{{ route('admin.students-history',['user_id' => $user->id ,'level_id' => $level_id ]) }}"><i
                                    class="fa fa-print"></i> تقرير</a>
                                
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
