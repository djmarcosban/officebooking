@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', 'Atualizar Configuração')
@section('content')

@php
use App\Http\Controllers\Controller;
@endphp

@include('_partials.title', ['title' => 'Atualizar Configuração', 'col' => 'col-xl-12 mx-auto'])
@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf
  <h5>Preencha os campos abaixo:</h5>
  <input type="hidden" name="config_id" value="{{$config->id}}" />

  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="key" class="form-label">Chave<span class="text-danger">*</span></label>
            <input type="text" name="key" id="key" required value="{{$config->key}}" class="form-control @error('key') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-6 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="value" class="form-label">Valor<span class="text-danger">*</span></label>
            <input type="text" name="value" required id="value" value="{{$config->value}}" class="form-control @error('value') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-start">
    <input type="submit" class="btn btn-primary" value="Atualizar" />
  </div>
</form>

@endsection