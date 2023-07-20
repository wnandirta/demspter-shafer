<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed layout-fixed">
    <div class="wrapper">
        @include('layouts.nav')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.alert')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
</body>

</html>
