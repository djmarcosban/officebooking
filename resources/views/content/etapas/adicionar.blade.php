@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Adicionar Etapa')
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
      Adicionar Etapa
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-10 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="titulo" class="form-label">Título<span class="text-danger">*</span></label>
            <input type="text" name="titulo" id="titulo" value="{{@old('titulo')}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-2 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="posicao" class="form-label">Posição<span class="text-danger">*</span></label>
            <input type="text" name="posicao" id="posicao" value="{{@old('posicao') ? @old('posicao') : ($lastPosition ? $lastPosition->posicao + 1 : @old('posicao'))}}" required class="form-control @error('nome') is-invalid @enderror" />
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
