<div>
    @if($users->count() > 0)
        <table width="100%" >
            <thead>
            <tr class="bg-primary text-center">
                <th colspan="10">
                    <h3 class="text-white">تقرير الطلاب </h3>
                </th>
            </tr>
            <tr class=" text-right">
                <th colspan="5" align="end" style="font-size: 18px;border: 0"><span
                        style="display: inline-block;padding: 10px">تاريخ التقرير: <b>{{date("Y/m/d")}}</b> </span></th>
            </tr>

            <tr align="center" class="bg-primary">
                <th class="table-title" scope="col">#</th>
                <th class="table-title" scope="col">اسم الطالب</th>
                <th class="table-title" scope="col">عدد الدروس</th>
                <th class="table-title" scope="col">المستوى</th>
                <th class="table-title" scope="col">عدد الدروس المسجلة</th>
                <th class="table-title" scope="col">عدد الدروس المتبقية</th>
                <th class="table-title" scope="col">عدد الساعات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr align="center">
                    <th scope="row">{{ $key+1 }}</th>
                    <td><p>{{$user->name}}</p></td>
                    <td><p>{{ $user->lesson_count }}</p></td>
                    <td><p>{{ $user->level ? $user->level->name : 'فارغ' }}</p></td>
                    <td><p>{{$user->lessons->count()}}</p></td>
                    <td><p>{{ $user->lesson_count - $user->lessons->count()}}</p></td>
                    <td><p>{{ (int)$hours = $user->lessons->sum('number_hours') / 60}}</p></td>
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
