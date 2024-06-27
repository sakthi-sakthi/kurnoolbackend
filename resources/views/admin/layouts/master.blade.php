<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{asset('admin')}}/img/kurnoollogo.png" type="image/x-icon" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> Welcome To The Diocese Of Kurnool |  @yield('title')</title>
    @include('admin.layouts.header')
    @yield('header')
</head>
<body class="hold-transition sidebar-mini" style="color: #525558 !important">
<div class="wrapper">

  <!-- Navbar -->
    @include('admin.layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('admin.layouts.menu')

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
    @include('admin.layouts.sidebar')
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    @include('admin.layouts.footer')

    @yield('script')
</body>
</html>
