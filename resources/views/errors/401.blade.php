{{--@extends('errors::minimal')--}}

{{--@section('title', __('Unauthorized'))--}}
{{--@section('code', '401')--}}
{{--@section('message', __('Unauthorized'))--}}


@extends('layouts.error')
@section('title-error')
    لم تقم بتسجيل الدخول
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطاً 401
            </h1>
            <p class="h3">لم تقم بتسجيل الدخول</p>
        </div>
    </div>
@endsection
