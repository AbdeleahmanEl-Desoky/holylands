{{--@extends('errors::minimal')--}}

{{--@section('title', __('Forbidden'))--}}
{{--@section('code', '403')--}}
{{--@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}


@extends('layouts.error')
@section('title-error')
    ليس لديك صلاحية
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>عذراً ..</h2>
            <h1 class="text-success">
                خطأ 403
            </h1>
            <p class="h3">ليس لديك صلاحية</p>
        </div>
    </div>
@endsection
