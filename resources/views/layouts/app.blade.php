<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Acme Widget Co- @yield('title')</title>

    <!-- Scripts -->
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- Ionicons -->


    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('style')
        <style>
            /*.ui-menu { width: 150px; }*/
            .c-nav {
                margin: 30px auto;
                /*text-align: center;*/
            }

            .c-nav ul ul {
                display: none;
            }

            .c-nav ul li:hover > ul {
                display: block;
            }


            .c-nav ul {
                    /*background: #efefef;
                    background: linear-gradient(top, #efefef 0%, #bbbbbb 100%);
                    background: -moz-linear-gradient(top, #efefef 0%, #bbbbbb 100%);
                    background: -webkit-linear-gradient(top, #efefef 0%,#bbbbbb 100%);*/
                padding: 0 20px;
                /*border-radius: 10px;
                box-shadow: 0px 0px 9px rgba(0,0,0,0.15);*/
                list-style: none;
                position: relative;
                display: inline-table;

            }
            .c-nav ul:after {
                content: ""; clear: both; display: block;
            }

            .c-nav ul li {
                float: left;
                border: 1px solid #F3F1EF;
            }
            .c-nav ul li:hover {
                background: #4b545f;
                background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
                background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
                background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 40%);
            }
            .c-nav ul li:hover a {
                color: #fff;
            }

            .c-nav ul li a {
                display: block; padding: 25px 40px;
                color: #757575; text-decoration: none;
            }


            .c-nav ul ul {
                background: #5f6975; border-radius: 0px; padding: 0;
                position: absolute; top: 100%;
            }
            .c-nav ul ul li {
                float: none;
                border-top: 1px solid #6b727c;
                border-bottom: 1px solid #575f6a; position: relative;
            }
            .c-nav ul ul li a {
                padding: 15px 40px;
                color: #fff;
            }
            .c-nav ul ul li a:hover {
                background: #4b545f;
            }

            .c-nav ul ul ul {
                position: absolute; left: 100%; top:0;
            }
        </style>
</head>
<body>
<div class="wrapper">
    @include('layouts.section.header')
    @include('layouts.section.aside')
    <div class="content-wrapper" style="min-height: 173px;">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.section.footer')
</div>
@yield('js')
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.js')}}"></script>


<script>
    function selectId(id){
            $('#categ_id').val(id);
            var text = $('#ch_'+id).text();
            $('.select_cat').empty();
            $('.select_cat').append('Selected: '+'<b>'+text+'</b>');
            //alert('Category Selected');
    }
</script>

</body>
</html>
