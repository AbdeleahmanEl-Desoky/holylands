<div>

    @if ($posts->count() > 0)
        <section class="blog py-5" id="blog">
            <div class="container">
                <div class="mb-md-5 mb-3 text-center">
                    <h2 class="text-primary placeholder">اخبارا الاكاديمية</h2>
                    <p class="placeholder d-block mx-auto maxw-700p" > هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة ولد النص العربى، حيث
                        يمكنك أن تولد مثل هذا النص نصوص الأخرى إضافة إلى زيادة عدد الحروف </p>
                </div>
                <div class="row g-md-4 g-3">
                    @foreach($posts as $key => $post)
                        <div class="col-md-3 col-6 mb-2">
                            <div data-aos="fade-right" data-aos-delay="{{$key+1}}00">
                                <div class="card card-body hover border-0 shadow rounded-3 ">
                                    <div class="h-180p d-flex justify-content-center align-items-center rounded-3 bg-light overflow-hidden">
                                        <img src="{{ $post->image ? $post->image : url('front/img/img-05.jpg')}}" class="card-img-top placeholder" alt="التفكير التصميمي">
                                    </div>
                                    <h5 class="card-title text-primary pt-md-3">
                                        <a href="{{ route('news-single',$post->id) }}" class="stretched-link placeholder">{{ Str::limit($post->title,50) }}</a>
                                    </h5>
                                    <p class="card-text text-secondary placeholder">{{ Str::limit($post->description,75) }}</p>

                                    <div class="d-flex justify-content-between align-items-center border-top pt-3 datea ">
                                        <h5 class="mb-0 placeholder"><i class="fa-regular fa-clock text-warning pe-1"></i> {{ \Carbon\Carbon::parse($post->created_at )->format('j F, Y') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif



</div>
