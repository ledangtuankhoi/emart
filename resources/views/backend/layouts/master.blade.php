<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layouts.header')
</head>

<body class="">
  <div class="wrapper ">

    {{-- sidebar --}}
    @include('backend.layouts.sidebar')
    {{-- endsidebar --}}

    <div class="main-panel">
      <!-- Navbar -->
      @include('backend.layouts.nav')
      <!-- End Navbar -->

      {{-- content --}}
      @yield('content')
      {{-- end content --}}

      {{-- footer --}}
      @include('backend.layouts.footer')
      {{-- end footer --}}
    </div>
  </div>

  {{-- plugin --}}
  {{-- @include('backend.layouts.plugin') --}}
  {{-- end plugin --}}

</body>

</html>