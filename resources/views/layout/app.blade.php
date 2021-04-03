<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800');
        *{
            box-sizing: border-box;
        }
        body{
            background: #1C8EF9 !important;
            min-height: 100vh;
            display: flex;
            font-weight: 400;
            font-family: 'Fira Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6,label, span{
            font-weight: 500;
            font-family: 'Fira Sans', sans-serif;
        }
        body, html, #app, #root, auth-wrapper{
            width:100%;
            height: 100%;
        }
        #app{
            text-align: center;
        }
        .navbar-light{
            background-color: #ffffff;
            box-shadow: 6px 14px 80px rgba(34, 35, 58, 0.2);
        }
        .auth-wrapper{
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: left;
        }
        .auth-inner{
            width: auto;
            margin:auto;
            background: #ffffff;
            box-shadow: 6px 14px 80px rgba(34, 35, 58, 0.2);
            padding: 40px 55px 45px 55px;
            border-radius: 15px;
            transition: all .3s;
            margin-top: 140px;
        }
        .auth-wrapper .form-control:focus{
            border-color: #167bff;
            box-shadow:none;
        }
        .auth-wrapper h3{
            text-align: center;
            margin: 0;
            line-height: 1;
            padding-bottom: 20px;
        }
        .custom-control-label{
            font-weight: 400;
        }
        .forget-password,
        .forget-password a{
            text-align: right;
            font-size: 13px;
            padding-top: 10px;
            color: #7f7d7d;
            margin: 0;
        }
        .forget-password a{
            color: #167bff;
        }
    </style>
@yield('css')
</head>
<body>
<!-- Content Here -->
<div id="app">
    <Nav/>
    <div class="auth-wrapper">
        @if(session()->has('message'))
            <div class="col-sm-4">
                <div class="alert alert-{{session('type')}} breadcrumb float-sm-right">
                    {{session('message')}}
                </div>
            </div>
        @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="auth-inner">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@yield('js')
</body>
</html>
