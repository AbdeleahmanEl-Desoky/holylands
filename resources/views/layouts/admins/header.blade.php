<header class="shadow-sm text-white fixed-top">
    <div class="border-0 ">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-2">
                <a class="navbar-brand me-0 d-md-inline-block d-none position-relative" target="_blank"
                   href="{{route('admin.home')}}"><img width="100"  class="img-fluid"
                                                       src="{{asset('dashboard/images/logo-holy.jpeg')}}" alt=""></a>

                <p>اهلا وسهلا بك</p>

                <div class="d-flex justify-content-center align-self-center">
                    <img class="rounded-circle border border-white shadow" width="30" height="30"
                         src="{{asset('dashboard/images/1.png')}}" alt="">
                    <div class="ps-2">
                        <p class="mb-0 fs-12p">{{ Str::limit(auth()->user()->name,15) }}</p>
                        <div class="dropdown">
                            <a href="#" class="btn py-1 px-0 border-0 dropdown-toggle text-white fs-12p" type="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __(auth()->user()->roles->pluck('name')->implode(',')) }}
                            </a>
                            <ul class="dropdown-menu ">
                                {{--                                <li><a class="dropdown-item" href="#">Action</a></li>--}}
                                <li><a class="dropdown-item fs-12p "
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                       href="{{ route('admin.logout') }}"><i
                                            class="fa-solid fa-sign-in  pe-1"></i>{{__("Logout")}}
                                    </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <!--  mobile-->
        <div class="d-md-none d-flex justify-content-between">
            <a class="navbar-brand me-0 d-md-none d-block" href="{{route('admin.home')}}"><img width="100"
                                                                                               class="img-fluid"
                                                                                               src="{{ asset('dashboard/images/logo-holy.jpeg')}}"
                                                                                               alt=""></a>
            <button class="navbar-toggler position-relative border-0 collapsed mt-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                                <span class="our-btn">
                                    <span class="the-bar"></span>
                                    <span class="the-bar"></span>
                                    <span class="the-bar"></span>
                                </span>
                <span class="btn overlaymnu d-lg-none d-block">
                                    <span class="our-btn"></span>
                            </span>
            </button>
        </div>

        @if(auth()->check())
            @livewire('admin.layouts.sidebar')
        @endif
    </div>
</header>
