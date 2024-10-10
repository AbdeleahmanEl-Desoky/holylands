<footer class="pt-5 bg-light2" id="footer">
    <div class="container">
        <div class="row g-0 py-3">
            <div class="col-lg-4 col-md-6 text-lg-start text-center mb-2">
                <a class="mb-3 d-inline-block placeholder" href="#"><img class="img-fluid" width="145" src="{{asset('front/img/logo.png')}}" alt=""></a>
                <p class="fs-15p placeholder">من هنا انطلقنا، حيث تمتد جذورنا إلى أعوام كثيرة</p>

                <p class="fs-15p placeholder">لنصبح خير مرشد لكم في مجالالإعلام الرقمي،</p>

            </div>
            <div class="col-lg-2 col-6 footer-links mb-2">
                <h5 class="placeholder text-warning fw-bold">الصفحات</h5>
                <ul class="nav flex-column">
                    <li class="nav-item fw-bold"><a class="nav-link text-secondary placeholder mb-1" href="#">الرئيسية </a>
                    </li>
                    <li class="nav-item fw-bold"><a class="nav-link text-secondary placeholder mb-1" href="#images">فعاليات الاكاديمية</a>
                    </li>
                    <li class="nav-item fw-bold"><a class="nav-link text-secondary placeholder mb-1" href="#about">من نحن</a>
                    </li>
                    <li class="nav-item fw-bold"><a class="nav-link text-secondary placeholder mb-1" href="#contact-us">اتصل بنا </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-6 footer-links mb-2">
                <h5 class="fw-bold text-warning placeholder">الدعم الفني</h5>
                <ul class="nav flex-column">
                    <li class="nav-item fw-bold"><a class="placeholder mb-1 nav-link text-secondary" href="#">الأسئلة الشائعة </a>
                    </li>
                    <li class="nav-item fw-bold"><a class="placeholder mb-1 nav-link text-secondary" href="{{route('privacy-policy')}}">سياسة الخصوصية</a>
                    </li>
                    <li class="nav-item fw-bold"><a class="placeholder mb-1 nav-link text-secondary" href="#contact-us">اتصل بنا</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-links mb-2 text-md-start text-center">
                <h5 class="placeholde text-warning">تحميل</h5>
                <ul class="nav flex-column">
                    <li class="nav-item fw-bold">
                        <a class="placeholder mb-1 nav-link text-secondary" href="https://play.google.com/store/apps/details?id=com.telesecop.holylands">
                            <img class="img-fluid" width="200" src="{{asset('front/img/google-play.png')}}" alt="">
                        </a>
                    </li>
                    <li class="nav-item fw-bold">
                        <a class="placeholder mb-1 nav-link text-secondary" href="https://apps.apple.com/il/app/%D8%A7%D9%84%D8%A7%D8%B1%D8%A7%D8%B6%D9%8A-%D8%A7%D9%84%D9%85%D9%82%D8%AF%D8%B3%D8%A9-%D9%84%D9%84%D9%81%D8%B1%D9%88%D8%B3%D9%8A%D8%A9/id6449150037">
                            <img class="img-fluid" width="200" src="{{asset('front/img/app.png')}}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-md-flex justify-content-between align-items-center py-3" style="border-top: 3px solid #364552">
            <p class="mb-md-0 order-md-1 order-2 text-center">جميع الحقوق محفوظة لصالح  اكاديمية الأرض المقدسية للفروسية 2023 </p>
            <ul class="nav justify-content-center order-md-2 order-1">
                <li class="nav-item mb-2">
                    <a href="{{($setting = \App\Models\Setting::where('name',"url_twitter")->first()) ? $setting->value : '#'}}" target="_blank"
                       class="placeholder nav-link btn-warning hover w-35p h-35p d-flex justify-content-center align-items-center text-white rounded-circle mx-2"
                       title="twitter"><i class="fa-brands text-white fa-twitter"></i></a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{($setting = \App\Models\Setting::where('name',"url_facebook")->first()) ? $setting->value : '#'}}" target="_blank"
                       class="placeholder nav-link btn-warning hover w-35p h-35p d-flex justify-content-center align-items-center text-white rounded-circle mx-2"
                       title="facebook"><i class="fa-brands text-white fa-facebook-f"></i></a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{($setting = \App\Models\Setting::where('name',"url_instagram")->first()) ? $setting->value : '#'}}" target="_blank"
                       class="placeholder nav-link btn-warning hover w-35p h-35p d-flex justify-content-center align-items-center text-white rounded-circle mx-2"
                       title="instagram"><i class="fa-brands text-white fa-instagram"></i></a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{($setting = \App\Models\Setting::where('name',"url_whatsapp")->first()) ? $setting->value : '#'}}" target="_blank"
                       class="placeholder nav-link btn-warning hover w-35p h-35p d-flex justify-content-center align-items-center text-white rounded-circle mx-2"
                       title="skype"><i class="fa-brands text-white fa-whatsapp"></i></a>
                </li>
{{--                <li class="nav-item mb-2">--}}
{{--                    <a href="#" target="_blank"--}}
{{--                       class="placeholder nav-link btn-warning hover w-35p h-35p d-flex justify-content-center align-items-center text-white rounded-circle mx-2"--}}
{{--                       title="linkedin"><i class="fa-brands text-white fa-linkedin-in"></i></a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</footer>
