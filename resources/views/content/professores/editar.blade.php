@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', 'Editar Professor')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-5">
  <div class="col-12 p-xl-0 align-items-center d-flex">

    <a href="/professores" class="mt-1 me-4">
      <img src="{{asset('assets/img/back.png')}}" style="width: 30px" alt="Voltar">
    </a>

    <h1 class="fw-light m-0 text-dark">
      Editar Professor
    </h1>
  </div>
</div>

@include('_partials.errors')

<form action="" autocomplete="off" method="POST">
  @csrf
  @method('PUT')

  <input type="hidden" name="id" value="{{$professor->id}}">

  <h5>Dados de acesso:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="name" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="name" value="{{$professor->nome}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-4 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="email" class="form-label">E-mail de acesso<span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" value="{{$professor->email}}" required class="form-control @error('email') is-invalid @enderror" />
          </div>
        </div>
        <div class="col-xl-5 col-12 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="password" class="form-label">Senha de acesso</label>
            <div class="d-flex align-items-center">
              <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror me-3"> <button type="button" onclick="generatePassword()" style="width:200px; padding: 8px 10px;" class="btn btn-outline-primary">Gerar senha</button>
            </div>
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
            <input type="text" name="telefone" id="telefone" value="{{$professor->telefone}}" required class="form-control @error('nome') is-invalid @enderror" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="/professores" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Atualizar" />
    </div>
  </div>

</form>

<script>
  function generatePassword() {
    // var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ";
    // var passwordLength = 12;
    // var password = "";

    // for (var i = 0; i < passwordLength; i++) {
    //   var randomNumber = Math.floor(Math.random() * chars.length);
    //   password += chars.substring(randomNumber, randomNumber + 1);
    // }

    $.ajax({
      url: '/generate-password',
      method: 'GET',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        document.getElementById('password').value = response
      },
      error: function(response) {
        alert('Erro ao atualizar gerar uma nova senha. Contate o administrador.');
        console.log(response)
      }
    });
  }

  $('#telefone').mask('(99) 99999-9999')
</script>

@endsection
