@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-950"])
@section('title', 'Atualizar Instituição')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "Atualizar Instituição"])
@include('_partials.errors')

<style>
  .form-control::file-selector-button {
    padding: 15px;
  }

  .current-logo {
    width: auto;
    border: 0;
    padding: 0;
    max-height: 35px;
    margin-right: 10px;
  }
</style>

<form action="" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input type="hidden" name="instituicao_id" value="{{$instituicao->id}}" required>

  <h5>Dados externos:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-4 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" value="{{$instituicao->nome}}" id="nome" class="@error('nome') is-invalid @enderror form-control" required>
          </div>
        </div>
        <div class="col-xl-8 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="endereco" class="form-label">Endereço<span class="text-danger">*</span></label>
            <input type="text" name="endereco" value="{{$instituicao->endereco}}" id="endereco" class="@error('nome') is-invalid @enderror form-control" required>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-center">
      <a href="javascript:history.back(-1)" class="btn btn-outline-secondary me-3">Cancelar</a>
    </div>
    <div class="col-auto ps-0 d-flex align-items-center">
      <div id="submit" class="form-group m-0">
        <input class="btn btn-primary" type="submit" value="Atualizar">
      </div>
      <div id="loading" class="spinner-border d-none" role="status"></div>
    </div>
  </div>
</form>

@endsection
