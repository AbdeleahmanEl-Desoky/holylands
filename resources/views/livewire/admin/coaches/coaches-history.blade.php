

    <div class="table-responsive-md pb-3">
        <div class="mb-3">
            <label>{{ __('Start Date') }}</label>
            <input type="date" wire:model="startDate" class="form-control">
        </div>

        <div class="mb-3">
            <label>{{ __('End Date') }}</label>
            <input type="date" wire:model="endDate" class="form-control">
        </div>

        <button wire:click="exportToExcel" class="btn btn-success mb-3">{{ __('Export to Excel') }}</button>

        @if(isset($histories) && $histories->count() > 0)

        <table class="table table-borderless mb-md-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1">#</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("level")}}</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("number_hours")}}</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("count_users")}}</div>
                    </th>
                    <th scope="col" class="text-center p-1">
                        <div class="bg-primary rounded-2 text-white py-2 px-1"> {{__("date")}}</div>
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($histories as $key => $history)
                    <tr>
                        <td class="text-center p-1">
                            <div class="table-os">{{ $key++ }}</div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$history->level->name}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$history->number_hours}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">
                                {{$history->users->count()}}
                            </div>
                        </td>
                        <td class="text-center p-1">
                            <div class="table-os">{{ $history->created_at->format('H:i:s Y-m-d ') }}</div>
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


