<div>
    <div class="height-header"></div>
    <!--news-->
    <section class="news py-md-5 py-3">
        <div class="container">
            <div class="border-bottom mb-3">
                <div class="clearfix  ">
                <img class="float-md-end col-md-5 col-11 ps-3 py-3 img-fluid" src="{{ $post->image ? $post->image : url('front/img/img-10.png')}}" alt="">

                <h1 class="h4 text-warning mb-3">{{$post->title}}</h1>

                    <p>
                        {!! nl2br($post->description) !!}
                    </p>

                </div>
                <div class="d-md-flex justify-content-md-between py-3">
                    <p class=""><i class="fa-regular fa-clock"></i>{{ \Carbon\Carbon::parse($post->created_at )->format('j F, Y') }}</p>
                    <ul class="nav justify-content-lg-start justify-content-center align-items-center text-center text-lg-start">
                        <li class="nav-item">
                            <h5 class="fw-bold px-2 mb-0">شارك:</h5>
                        </li>

                        <li class="nav-item">
                            <div class="sharethis-inline-share-buttons sher"></div></a>
                        </li>
                    </ul>
                </div>

            </div>

            <h3 class="border-right-2 mb-4 ps-2">مقالات مشابهة</h3>
            <div class="row news">
                @foreach($posts as $key => $post)
                <div class="col-md-3 col-6 mb-4">
                    <div class="card card-body pb-1">
                        <div class="d-flex justify-content-center align-items-start overflow-hidden">
                            <a href="{{ route('news-single',$post->id) }}" class="stretched-link d-flex justify-content-center align-items-center h-180p">
                                <img src="{{ $post->image ? $post->image : url('front/img/img-10.png')}}" class="card-img-top" alt="...">
                            </a>
                        </div>

                        <div class="mb-3">
                            <h5 class="card-title text-warning mt-2 mb-0">{{ Str::limit($post->title,50) }}</h5>
                            <p class="card-text ">{!! Str::limit($post->description,75) !!}</p>
                        </div>
                        <div class="d-flex align-items-center border-top">
                            <div class="person-img">
                                <img width="70" src="{{ $post->user ? $post->user->image : url('front/img/img-10.png')}}" alt="">
                            </div>
                            <div class="ps-3">
                                <p class="mb-0">الأراضي المقدسة للفروسية</p>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($post->created_at )->format('j F, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

</div>



@section('js_code')

    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6180ea6e6c54f40014a7fc0e&product=inline-share-buttons" async="async"></script>

@endsection
