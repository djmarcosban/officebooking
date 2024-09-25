@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-xl-10 col-12 m-w-1240"])
@section('title', "Lista de Logs")
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.list', ["title" => "Lista de Logs", "count" => count($logFileNames)])
@include('_partials.errors')

<div class="card">
  <div class="card-body">
    <ul class="m-0">
      @foreach ($logFileNames as $fileName)
        <li><a href="/logs/{{$fileName}}">{{ $fileName }}</a></li>
      @endforeach
    </ul>
  </div>
</div>

@endsection
