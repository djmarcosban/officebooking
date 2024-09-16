@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Adicionar Serviço')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-5">
  <div class="col-12 p-xl-0 col-xl-5 align-items-center d-flex">

    <a href="{{ url()->previous() }}" class="mt-1 me-4">
      <img src="{{asset('assets/img/back.png')}}" style="width: 30px" alt="Voltar">
    </a>

    <h1 class="fw-light m-0 text-dark">
      Adicionar Serviço
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf

  <input type="hidden" name="return_url" value="{{request('return_url')}}" />

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-5 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{@old('nome')}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="apelido" class="form-label">Apelido<span class="text-danger">*</span></label>
            <input type="text" name="apelido" id="apelido" value="{{@old('apelido')}}" required class="form-control @error('apelido') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor" class="form-label">Valor<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" name="valor" id="valor" value="{{@old('valor')}}" required class="valor_formatado form-control @error('valor') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="tipo" class="form-label">Tipo<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
              <select name="tipo" id="tipo" class="form-select">
                <option {{@old('tipo') == 'passeio' ? 'selected' : ''}} value="passeio">Passeio</option>
                <option {{@old('tipo') == 'transfer' ? 'selected' : ''}} value="transfer">Transfer</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Visibilidade:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
              <select name="status" id="status" class="form-select">
                <option {{@old('status') == 'ativo' ? 'selected' : ''}} value="ativo">Ativo</option>
                <option {{@old('status') == 'inativo' ? 'selected' : ''}} value="inativo">Inativo</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Adicionar" />
    </div>
  </div>

</form>

@endsection
