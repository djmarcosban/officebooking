{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"> --}}

<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css?v=').time() }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css?v=').time() }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css?v=').time() }}" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css?v=').time() }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css?v=').time() }}" />

@yield('vendor-style')


@yield('page-style')
