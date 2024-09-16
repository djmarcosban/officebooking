@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Editar Veículo')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-5">
  <div class="col-12 p-xl-0 align-items-center d-flex">

    <a href="/origens" class="mt-1 me-4">
      <img src="{{asset('assets/img/back.png')}}" style="width: 30px" alt="Voltar">
    </a>

    <h1 class="fw-light m-0 text-dark">
      Editar Veículo
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf
  @method('PUT')
  <h5>Preencha os campos abaixo:</h5>
  
  <input type="hidden" name="id" value="{{$veiculo->id}}">

  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
            <input type="text" name="modelo" id="modelo" value="{{$veiculo->modelo}}" required class="form-control @error('modelo') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
            <input type="text" name="marca" id="marca" value="{{$veiculo->marca}}" required class="form-control @error('marca') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="placa" class="form-label">Placa<span class="text-danger">*</span></label>
            <input type="text" name="placa" id="placa" value="{{$veiculo->placa}}" required class="form-control @error('placa') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="ano" class="form-label">Ano<span class="text-danger">*</span></label>
            <input type="text" name="ano" id="ano" value="{{$veiculo->ano}}" required class="form-control @error('ano') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
              <select name="status" id="status" class="form-select">
                <option {{$veiculo->status == 'ativo' ? 'selected' : ''}} value="ativo">Ativo</option>
                <option {{$veiculo->status == 'inativo' ? 'selected' : ''}} value="inativo">Inativo</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="/origens" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Atualizar" />
    </div>
  </div>

</form>

@endsection