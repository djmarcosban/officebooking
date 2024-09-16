@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', 'Configurações ('.count($configs).')')
@section('content')

@php
use Carbon\Carbon;
@endphp

<div class="row py-3 mb-5">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Configurações ({{count($configs)}})
    </h1>
  </div>
</div>
@include('_partials.errors')

<form action="/configs/adicionar" autocomplete="off" class="mb-5" method="POST">
  @csrf
  <h5>Adicione uma configuração:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="key" class="form-label">Chave<span class="text-danger">*</span></label>
            <input type="text" name="key" id="key" value="{{@old('key')}}" required class="form-control @error('key') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-6 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="value" class="form-label">Valor<span class="text-danger">*</span></label>
            <input type="text" name="value" required id="value" value="{{@old('value')}}" class="form-control @error('value') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-start">
    <input type="submit" class="btn btn-primary" value="Adicionar" />
  </div>
</form>

@if(!count($configs))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu configs ainda.</li>
    </ul>
  </div>
@else
  <div class="table-responsive text-nowrap table-escala">
    <table class="table table-bordered table-sm table-hover table-striped">
      <thead>
        <tr>
          <th class="text-dark">Chave</th>
          <th class="text-dark">Valor</th>
          <th class="text-dark">Data criação</th>
          <th class="text-dark">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($configs as $config)
          <tr>
            <td>{{$config->key}}</td>
            <td>{{$config->value}}</td>
            <td>{{Carbon::parse($config->created_at)->format('d/m/Y H:i:s')}}</td>
            <td>
              <a href="config/{{$config->id}}/editar" class="me-1"><img src="{{asset('assets/img/edit.png')}}" alt="Editar dados" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar dados" style="width: 21px" /></a>
              <a href="config/{{$config->id}}/deletar" class="me-1" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }"><img src="{{asset('assets/img/delete.png')}}" alt="Deletar cadastro" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Deletar config" style="width: 21px" /></a>
            </td>
          </tr>

        @endforeach
        
      </tbody>
    </table>
  </div>
@endif

@endsection