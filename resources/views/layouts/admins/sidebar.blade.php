<nav class="navbar navbar-expand-lg navbar-light pb-0">
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <div class="text-center">
            <a class="navbar-brand d-lg-none d-block logo-mo my-4 " href="{{ route('admin.home') }}"><img
                    class="img-fluid" width="100" src="{{asset('dashboard/images/loge222.png')}}" alt=""></a>
        </div>
        <ul class="navbar-nav justify-content-center w-100 text-md-center position-relative mt-md-3">

            <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin') ? 'active' : ''}}">
                <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.home') }}"><i
                        class="fa-sharp fa-solid w-35p fa-house fs-5 pe-2"></i> {{__('Home')}} </a>
            </li>

            @if(auth()->user()->can('managers show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/managers') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.managers') }}"><i
                            class="fa-solid w-35p fa-user-group fs-5 pe-2"></i>{{__('Managers')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('students show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/students') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.students') }}"><i
                            class="fa-solid w-35p fa-user-graduate fs-5 pe-2"></i>{{__('Students')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('coaches show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/coaches') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.coaches') }}"><i
                            class="fa-solid w-35p fa-user-tie fs-5 pe-2"></i>{{__('Coaches')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('roles show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/roles') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.roles') }}"><i
                            class="fa-solid w-35p fa-lock fs-5 pe-2"></i>{{__('Roles')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('levels show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/levels') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.levels') }}"><i
                            class="fa-solid w-35p fa-layer-group fs-5 pe-2"></i>{{__('Levels')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('horses show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/horses') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.horses') }}"><i
                                class="fa-solid w-35p fa-horse-head fs-5 pe-2"></i>{{__('Horses')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('lessons show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/lessons*') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.lessons') }}"><i
                            class="fa-solid w-35p fa-calendar fs-5 pe-2"></i>{{__('Lessons')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('reports show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 @if (request()->is('admin/coaches-reports') or request()->is('admin/students-reports') ) active @endif">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.coaches-reports') }}"><i
                            class="fa-solid w-35p fa-chart-simple fs-5 pe-2"></i>{{__('Reports')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('posts show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/posts') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.posts') }}"><i
                            class="fa-solid w-35p fa-globe fs-5 pe-2"></i>{{__('Posts')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('pages show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/pages') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.pages') }}"><i
                            class="fa-solid w-35p fa-file fs-5 pe-2"></i>{{__('Pages')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('contacts show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/contacts') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.contacts') }}"><i
                            class="fa-solid w-35p fa-envelope fs-5 pe-2"></i>{{__('Contacts')}} </a>
                </li>
            @endif

            @if(auth()->user()->can('settings show') )
                <li class="nav-item mx-1 mb-md-0 mb-2 {{request()->is('admin/settings') ? 'active' : ''}}">
                    <a class="nav-link font-weight-bold text-white ps-md-2 ps-3" href="{{ route('admin.settings') }}"><i
                            class="fa-solid w-35p fa-gear fs-5 pe-2"></i>{{__('Settings')}} </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
