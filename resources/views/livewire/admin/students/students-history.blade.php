

    <div class="table-responsive-md pb-3">
        @if(isset($users) && $users->count() > 0)

        <table class="table table-borderless mb-md-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("Admin")}}</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("number")}}</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("date")}}</div>
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
                                {{$user->user->name}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$user->add}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">{{ $user->created_at->format('H:i:s Y-m-d ') }}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- <div class="pt-2"> --}}
                {{-- {{$users->links()}}
            </div> --}}
        @else
            <div class="text-center e404 py-3">
                <img width="210" class="img-fluid mb-3" src="{{asset('dashboard/images/error.svg')}}" alt="">
                <h4>{{__("Empty list")}}</h4>
            </div>
        @endif
    </div>


