{{--@extends('errors::minimal')--}}

{{--@section('title', __('Page Expired'))--}}
{{--@section('code', '419')--}}
{{--@section('message', __('Page Expired'))--}}


@extends('layouts.error')
@section('title-error')
    الصفحة منتهية الصلاحية
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطأ 419
            </h1>
            <p class="h3">الصفحة منتهية الصلاحية</p>
        </div>
    </div>
@endsection
