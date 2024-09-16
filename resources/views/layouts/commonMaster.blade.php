<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') | {{env('APP_NAME')}}</title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <meta name="author" content="Marcos Felipe" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Trivia Viagens">
  <meta name="copyright" content="© 2024 M2 Tecnhology" />
  <meta name="robots" content="none">

  <link href="{{ asset('assets/img/gsa_ios_60dp.png') }}" rel="apple-touch-icon" sizes="180x180">
  <link href="{{ asset('assets/img/gsa_ios_60dp_120.png') }}" rel="apple-touch-icon" sizes="120x120">
  <link href="{{ asset('assets/img/gsa_ios_57dp.png') }}" rel="apple-touch-icon" sizes="114x114">
  <link href="{{ asset('assets/img/gsa_ios_57dp_small.png') }}" rel="apple-touch-icon">
  <meta content="{{ asset('assets/img/logo-128dp.png') }}" itemprop="image">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />

  @include('layouts/sections/styles')

  @include('layouts/sections/scriptsIncludes')
</head>

<body>
  @yield('layoutContent')
  @include('layouts/sections/scripts')

</body>

</html>
