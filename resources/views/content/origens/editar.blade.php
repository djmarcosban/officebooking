@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Editar Local')
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
      Editar Local
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf
  @method('PUT')

  <input type="hidden" name="id" value="{{$origem->id}}">

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" value="{{$origem->nome}}" id="nome" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Dados de localização:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-2 col-6 mb-4">
          <div class="form-group">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" value="{{$origem->cep}}" id="cep" class="form-control">
          </div>
        </div>
        <div class="col-xl-4 col-12 mb-4">
          <div class="form-group">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" name="address" required value="{{$origem->address}}" id="address" class="form-control">
          </div>
        </div>
        <div class="col-xl-1 col-3 mb-4">
          <div class="form-group">
            <label for="number" class="form-label">Número</label>
            <input type="text" name="number" value="{{$origem->number}}" id="number" class="form-control">
          </div>
        </div>
        <div class="col-xl-4 col-9 mb-4">
          <div class="form-group">
            <label for="complement" class="form-label">Complemento</label>
            <input type="text" name="complement" value="{{$origem->complement}}" id="complement" class="form-control">
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4">
          <div class="form-group">
            <label for="neighborhood" class="form-label">Bairro</label>
            <input type="text" name="neighborhood" value="{{$origem->neighborhood}}" id="neighborhood" class="form-control">
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4">
          <div class="form-group">
            <label for="city" class="form-label">Cidade</label>
            <input type="text" name="city" required value="{{$origem->city}}" id="city" class="form-control">
          </div>
        </div>
        <div class="col-xl-1 col-4 mb-4">
          <div class="form-group">
            <label for="state" class="form-label">Estado</label>
            <input type="text" name="state" value="{{$origem->state}}" id="state" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Visibilidade:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-2 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-select" required>
              <option value="ativo" {{$origem->status == 'ativo' ? 'selected' : ''}}>Ativo</option>
              <option value="inativo" {{$origem->status == 'inativo' ? 'selected' : ''}}>Inativo</option>
            </select>
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

@include('content.origens.scripts')

@endsection
