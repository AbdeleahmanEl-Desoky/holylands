{{--@extends('errors::minimal')--}}

{{--@section('title', __('Service Unavailable'))--}}
{{--@section('code', '503')--}}
{{--@section('message', __('Service Unavailable'))--}}


@extends('layouts.error')
@section('title-error')
    الخدمة متوقفة حالياً
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطأ 503
            </h1>
            <p class="h3">الخدمة متوقفة حالياً</p>
        </div>
    </div>
@endsection
