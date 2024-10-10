{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}


@extends('layouts.error')
@section('title-error')
    الصفحة غير موجودة
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-secondary">
                خطأ 404
            </h1>
            <p class="h3">الصفحة غير موجودة</p>
        </div>
    </div>
@endsection
