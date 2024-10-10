<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ 'تقرير'.'-'.date('d-m-Y-g-i-s')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

    <style>
        body{
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
        }
        table, th, td {
            border: 1px solid #845830;
            border-collapse: collapse;
        }
        .table-title{
            color: #fff;
            padding-top: 3px;
            padding-bottom: 3px
        }
        .bg-primary{
            background-color:#845830 !important;
        }
        .bg-light{
            background-color: #D4EAF5
        }
        .text-white{
            color: #fff;
        }
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            right: 0;
        }

        @page {
            margin: 0mm
        }
        @media print {

        }
    </style>

    @livewireStyles

</head>

<body>
<header style="text-align: center;padding-bottom: 20px;padding-top: 20px">
    <img width="200" src="{{asset('dashboard/images/logo-holy.png')}}" alt="">
</header>

<!-- Page content -->
<div class="page-content">


<!-- Main content -->
    <div class="content-wrapper">

        @yield('content')

        {{ isset($slot) ? $slot : null }}

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->
@livewireScripts
@yield('js_code')
</body>
</html>
