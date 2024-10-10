<div>
    <div class="height-header"></div>
    <!--news-->
    <section class="news py-md-5 py-3">
        <div class="container">
            <div class="border-bottom mb-3">
                <div class="clearfix  ">
                    <img class="float-md-end col-md-5 col-11 ps-3 py-3 img-fluid w-25"  src="{{ $page->image ? $page->image : url('front/img/privacy-policy-1.png')}}" alt="">

                    <h1 class="h4 text-warning mb-3">{{$page->title}}</h1>

                    <p>
                        {!! nl2br($page->description) !!}
                    </p>

                </div>

            </div>
        </div>
    </section>

</div>

