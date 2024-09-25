@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1240"])
@section('title', "Conteúdo do Log")
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "<a href='/logs/'>Lista de Logs</a> / Conteúdo do Log"])
@include('_partials.errors')

<style>
    pre{
        margin: 0;
    }
</style>

<h5>Visualizando: {{request()->fileName}}</h5>
<div class="card">
    <div class="card-body">
        <pre class="text-dark">{{ $logContent }}</pre>
    </div>
</div>

@endsection
