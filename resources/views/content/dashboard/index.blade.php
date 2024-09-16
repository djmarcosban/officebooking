@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-xl-10 col-12 m-w-1220"])

@section('title', 'Dashboard')

@section('content')

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Bem-vindo, {{$nome}}.
    </h1>
  </div>
</div>

@endsection