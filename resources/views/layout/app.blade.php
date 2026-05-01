<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/auth.css')}}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
</head>
<body>
    @yield('content')
</body>
<script src="{{asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('template/dist/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/dist/assets/js/main.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
</html>