@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Adicionar Cliente')
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
      Adicionar Cliente
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
        <div class="col-xl-6 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{@old('nome')}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="tipo" class="form-label">Tipo Documento</label>
            <div class="d-flex align-items-center">
              <select name="tipo" id="tipo" class="form-select">
                <option {{@old('tipo') == 'CPF' ? 'selected' : ''}} value="CPF">CPF</option>
                <option {{@old('tipo') == 'CNPJ' ? 'selected' : ''}} value="CNPJ">CNPJ</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" name="documento" id="documento" value="{{@old('documento')}}" class="form-control @error('documento') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Dados adicionais:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4">
          <div class="form-group">
            <label for="numero_voo" class="form-label">Nº do voo:</label>
            <input type="text" name="numero_voo" id="numero_voo" value="{{@old('numero_voo')}}" class="form-control @error('numero_voo') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-12 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="acompanhantes" class="form-label">Acompanhantes: <small>(separado por virgula)</small></label>
            <textarea name="acompanhantes" id="acompanhantes" class="form-control @error('acompanhantes') is-invalid @enderror" rows="4">{{@old('acompanhantes')}}</textarea>
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
