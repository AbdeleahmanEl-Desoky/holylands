<div>
    <section class="py-5 contact-us" id="contact-us">
        <div class="container">
            <div class="text-center py-4" wire:ignore>
                <h2 class="text-white title-o placeholder pb-3 position-relative" data-aos="fade-up">تواصل معنا</h2>
                <h5 class="fw-bold d-block text-white placeholder" data-aos="fade-up">لا تترد في التواصل معنا ، فريقنا الفني في
                    انتظاركم </h5>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9 col-11 mt-4">
                    <form wire:submit.prevent="store" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" wire:model.defer="contact.name" class="form-control @error('contact.name') is-invalid @enderror placeholder" id="name" placeholder="اسم المستخدم">
                                    @error('contact.name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <label for="name">اسم المستخدم</label>
                                </div>
                            </div>
                            <div class="col-md-6 order-1">
                                <div class="form-floating mb-3">
                                    <input type="email" wire:model.defer="contact.email" class="form-control @error('contact.email') is-invalid @enderror placeholder" id="email" placeholder="البريد الالكتروني">
                                    @error('contact.email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <label for="email">البريد الالكتروني</label>
                                </div>
                            </div>
                            <div class="col-12 order-2">
                                <div class="form-floating mb-3">
                                    <input type="text"  wire:model.defer="contact.title" class="form-control @error('contact.title') is-invalid @enderror placeholder" placeholder="الموضوع">
                                    @error('contact.title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <label for="name">العنوان</label>
                                </div>
                            </div>
                            <div class="col-12 order-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control @error('contact.message') is-invalid @enderror placeholder" wire:model.defer="contact.message" style="min-height: 200px" placeholder="الرسالة"></textarea>
                                    @error('contact.message')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <label for="name">الموضوع</label>
                                </div>
                            </div>
                            <div class="col-md-6 order-md-4 order-5" wire:ignore>
                                <div class="d-md-flex">
                                    <div class="d-flex align-items-center px-3 py-2" data-aos="zoom-out-left"
                                         data-aos-delay="0">
                                    <span class="bg-light22 w-50p h-50p rounded-circle d-flex justify-content-center align-items-center"><i
                                            class="fa-solid fa-phone fs-4 text-warning"></i></span>
                                        <p class="mb-0 ps-3 placeholder">+{{($setting = \App\Models\Setting::where('name',"mobile")->first()) ? $setting->value : '123456789'}}</p>
                                    </div>
                                    <div class="d-flex align-items-center px-3 py-2" data-aos="zoom-out-left"
                                         data-aos-delay="300">
                                    <span class="bg-light22 w-50p h-50p rounded-circle d-flex justify-content-center align-items-center"><i
                                            class="fa-solid fa-envelope fs-4 text-warning"></i></span>
                                        <p class="mb-0 ps-3 placeholder">{{($setting = \App\Models\Setting::where('name',"email")->first()) ? $setting->value : 'info@himam.com'}}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center px-3 py-2" data-aos="zoom-out-left"
                                     data-aos-delay="300">
                                <span class="bg-light22 w-50p h-50p rounded-circle d-flex justify-content-center align-items-center"><i
                                        class="fa-solid fa-location-dot fs-4 text-warning"></i></span>
                                    <p class="mb-0 ps-3 placeholder">{{($setting = \App\Models\Setting::where('name',"address")->first()) ? $setting->value : 'فلسطين - أريحا'}}</p>
                                </div>

                            </div>
                            <div class="col-6 order-md-5 order-4 text-end align-self-center">
                                <button class="placeholder btn btn-warning px-5 py-2 rounded-pill hover" type="submit">أرسال
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <div data-aos="fade-up" class="text-center"   data-aos-anchor-placement="top-bottom" wire:ignore>
            <iframe style="border:0; width: 90%; height: 270px;"
                    src="{{($setting = \App\Models\Setting::where('name',"url_map")->first()) ? $setting->value : 'https://www.google.com/maps/embed?pb=!1m20!1m8!1m3!1d2397.619005404331!2d35.32616657361022!3d31.804690325009638!3m2!1i1024!2i768!4f13.1!4m9!3e6!4m3!3m2!1d31.4431157!2d34.3846099!4m3!3m2!1d31.804255899999998!2d35.3255687!5e0!3m2!1sar!2s!4v1688869601770!5m2!1sar!2s'}}"
                    frameborder="0" allowfullscreen></iframe>
        </div>


    </section>
</div>


