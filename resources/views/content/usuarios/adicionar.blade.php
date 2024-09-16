@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Adicionar Usuário')
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
      Adicionar Usuário
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf
  <h5>Preencha os campos abaixo:</h5>

  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4">
          <div class="form-group">
            <label for="name" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="name" value="{{@old('nome')}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-4 col-6 mb-4">
          <div class="form-group">
            <label for="email" class="form-label">E-mail de acesso<span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" value="{{@old('email')}}" required class="form-control @error('email') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-5 col-12 mb-4">
          <div class="form-group">
            <label for="password" class="form-label">Senha de acesso<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
              <input type="text" name="password" id="password" value="{{@old('password')}}" required class="form-control @error('password') is-invalid @enderror me-3"> <button type="button" onclick="generatePassword()" style="width:200px; padding: 8px 10px;" class="btn btn-outline-primary">Gerar senha</button>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-12 mb-4 mb-xl-0">
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
        <div class="col-xl-4 col-12">
          <div class="form-group">
            <label class="form-label">Permissões<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
              <select name="funcao" id="funcao" class="form-select">
                <option {{old('funcao') == 'admin' ? 'selected' : ''}} value="admin">Administrador</option>
                <option {{old('funcao') == 'operador' ? 'selected' : ''}} value="operador">Operador</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(Auth::user()->funcao == 'master')
    <div class="card mb-4 col-12">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-6 col-12 mb-4 mb-xl-0">
            <div class="form-group">
              <label for="empresa_id" class="form-label">Empresa<span class="text-danger">*</span></label>
              <div class="d-flex align-items-center">
                <select name="empresa_id" id="empresa_id" class="form-select">
                  <option value="">Escolha uma opção</option>
                  @foreach ($empresas as $empresa)
                    <option {{@old('empresa_id') == $empresa->id ? 'selected' : ''}} value="{{$empresa->id}}">{{$empresa->company_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif


  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Adicionar" />
    </div>
  </div>

</form>

<script>
  function generatePassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ";
    var passwordLength = 12;
    var password = "";

    for (var i = 0; i < passwordLength; i++) {
      var randomNumber = Math.floor(Math.random() * chars.length);
      password += chars.substring(randomNumber, randomNumber + 1);
    }
    document.getElementById('password').value = password
  }
</script>

@endsection
