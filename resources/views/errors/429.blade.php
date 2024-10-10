{{--@extends('errors::minimal')--}}

{{--@section('title', __('Too Many Requests'))--}}
{{--@section('code', '429')--}}
{{--@section('message', __('Too Many Requests'))--}}


@extends('layouts.error')
@section('title-error')
    طلبات كثيرة جداً
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطأ 429
            </h1>
            <p class="h3">طلبات كثيرة جداً</p>
        </div>
    </div>
@endsection
