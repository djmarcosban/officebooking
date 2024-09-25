@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Meus Dados')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "Meus Dados"])
@include('_partials.errors')

<form action="/meus-dados" autocomplete="off" method="POST" class="mb-5">
  @csrf
  <input type="hidden" name="turma_id" value="0" />
  <input type="hidden" name="password_confirm" value="0" />

  <h5>Preencha os dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 col-md-4 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{$user->nome}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Dados de acesso:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="email" class="form-label">E-mail de acesso<span class="text-danger">*</span></label>
            <input type="text" readonly name="email" id="email" value="{{$user->email}}" required class="form-control @error('email') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="password" class="form-label">Senha de acesso<span class="text-danger">*</span></label>
            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror me-3">
            <small class="form-text text-muted">Deixe em branco caso não queira alterar</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Dados de contato:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="telefone" class="form-label">Telefone <small class="text-muted">(Opcional)</small></label>
            <input type="text" name="telefone" id="telefone" value="{{$user->telefone}}" required class="form-control @error('email') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <input type="submit" class="btn rounded-1 btn-primary" value="Salvar Alterações" />
    </div>
  </div>

</form>

<script>
  $('#telefone').mask('(99) 99999-9999')
</script>

@endsection
