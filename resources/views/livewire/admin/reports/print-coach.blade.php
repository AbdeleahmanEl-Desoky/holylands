<div>
    @if($coaches->count() > 0)
        <table width="100%" >
            <thead>
            <tr class="bg-primary text-center">
                <th colspan="10">
                    <h3 class="text-white">تقرير المدربين</h3>
                </th>
            </tr>
            <tr class=" text-right">
                <th colspan="5" align="end" style="font-size: 18px;border: 0"><span
                        style="display: inline-block;padding: 10px">تاريخ التقرير: <b>{{date("Y/m/d")}}</b> </span></th>
            </tr>

            <tr align="center" class="bg-primary">
                <th class="table-title" scope="col">#</th>
                <th class="table-title" scope="col">اسم المدرب</th>
                <th class="table-title" scope="col"> عدد الطلاب</th>
                <th class="table-title" scope="col">عدد الدروس</th>
                <th class="table-title" scope="col">دروس اليوم</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coaches as $key => $coach)
                <tr align="center">
                    <th scope="row">{{ $key+1 }}</th>
                    <td><p>{{$coach->name}}</p></td>
                    <td><p>{{ $coach->coach_users_lessons->count() }}</p></td>
                    <td><p>{{ $coach->coach_lessons->count() }}</p></td>
                    <td><p>{{$coach->coach_lessons->whereBetween('date', [ Illuminate\Support\Carbon::now()->format('Y-m-d') . " 00:00:00", Illuminate\Support\Carbon::now()->format('Y-m-d') . " 23:59:59"])->count()}}</p></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 style="color: red;text-align: center"> القائمة فارغة </h1>
    @endif

</div>
@section('js_code')
    <script type="text/javascript">
        $(window).on('load', function () {
            window.print();
        });
    </script>
@endsection
