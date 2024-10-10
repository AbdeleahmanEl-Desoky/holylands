{{--@extends('errors::minimal')--}}

{{--@section('title', __('Server Error'))--}}
{{--@section('code', '200')--}}
{{--@section('message', __('Server Error'))--}}


@extends('layouts.error')
@section('title-error')
    الموقع تحت الصيانة
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطأ 500
            </h1>
            <p class="h3">الموقع تحت الصيانة</p>
        </div>
    </div>
@endsection
