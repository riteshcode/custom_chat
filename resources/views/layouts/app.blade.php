<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


         <!-- Font Awesome -->
          <link rel="stylesheet" href="{{ url('') }}plugins/fontawesome-free/css/all.min.css">
          <!-- Ionicons -->
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Tempusdominus Bbootstrap 4 -->
          <link rel="stylesheet" href="{{ url('/') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
          <!-- iCheck -->
          <link rel="stylesheet" href="{{ url('/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
          <!-- JQVMap -->
          <link rel="stylesheet" href="{{ url('/') }}/plugins/jqvmap/jqvmap.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="{{ url('/') }}/dist/css/adminlte.min.css">
          <!-- overlayScrollbars -->
          <link rel="stylesheet" href="{{ url('/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
          <!-- Daterange picker -->
          <link rel="stylesheet" href="{{ url('/') }}/plugins/daterangepicker/daterangepicker.css">
          <!-- summernote -->
          <link rel="stylesheet" href="{{ url('/') }}/plugins/summernote/summernote-bs4.css">
          <!-- Google Font: Source Sans Pro -->
          <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
