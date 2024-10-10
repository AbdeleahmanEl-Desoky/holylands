<ul class="nav nav-tabs navs-o border-bottom-0">


    @if(auth()->user()->can('reports show') )
        <li class="nav-item ms-1">
            <a class="nav-link rounded-0 text-p fw-bold px-md-3 px-1 {{request()->is('admin/coaches-reports') ? 'active' : ''}} "
               aria-current="page"
               href="{{ route('admin.coaches-reports') }}"><img
                    class="d-block mx-auto mb-1" width="44" src="{{asset('dashboard/images/coaches-r.png')}}"
                    alt="">
                {{__("Coaches")}}</a>
        </li>
    @endif

        @if(auth()->user()->can('reports show') )
            <li class="nav-item ms-1">
                <a class="nav-link rounded-0 text-p fw-bold px-md-3 px-1 {{request()->is('admin/students-reports') ? 'active' : ''}} "
                   aria-current="page"
                   href="{{ route('admin.students-reports') }}"><img
                        class="d-block mx-auto mb-1" width="44" src="{{asset('dashboard/images/users-r.png')}}"
                        alt="">
                    {{__("Students")}}</a>
            </li>
        @endif





</ul>
