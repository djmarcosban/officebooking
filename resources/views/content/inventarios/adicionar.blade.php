@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-950"])
@section('title', 'Adicionar Inventário')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "Adicionar Inventário"])
@include('_partials.errors')

<form action="" method="POST" enctype="multipart/form-data">
  @csrf

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-4 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{@old('nome')}}" class="form-control" required>
          </div>
        </div>
        <div class="col-xl-2 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="cap_max" class="form-label">Capacidade</label>
            <input type="number" name="cap_max" id="cap_max" value="{{@old('cap_max')}}" class="form-control" required>
          </div>
        </div>
        <div class="col-xl-3 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" value="{{@old('marca')}}" class="form-control" required>
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
        <input class="btn btn-primary" type="submit" value="Adicionar">
      </div>
      <div id="loading" class="spinner-border d-none" role="status"></div>
    </div>
  </div>
</form>

@endsection
