@extends('layouts/blankLayout')
@section('title', 'Configurar Primeiro Acesso')
@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

<style>
.is-text-invalid{
  color: #ff3e1d !important;
}

.is-text-valid {
  color: #228b22 !important;
}
</style>

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <div class="app-brand-logo">
              <div class="app-brand-logo mb-2 demo">@include('_partials.macros',["size"=>"h3","color"=>"dark","text_align"=>"center", "show_city"=>true])</div>
            </div>
          </div>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger" role="alert">
              <p class="m-0 fw-bold mb-1">Ops. Algo deu errado!</p>
              <ul class="list-unstyled m-0">
                  @foreach($errors->all() as $error)
                  <li> {{ $error }} </li>
                  @endforeach
              </ul>
            </div>
          @endif

          <!-- /Logo -->
          <h5 class="mb-4 fw-normal text-dark text-center">Configurar primeiro acesso</h5>
          <p class="mb-4 text-center">Altere sua senha para continuar navegando</p>

          @if(isset($erro))
            <p class="text-danger text-center">{{$content}}</p>
          @endif

          <form id="formAuthentication" class="mb-3" action="" autocomplete="off" method="POST">
            {{ csrf_field() }}

            @csrf

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-3">
              <label for="password" class="form-label">Digite uma senha</label>
              <div class="col">
                <input id="password" type="password" class="form-control" name="password" required >
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} mb-3">
              <label for="password-confirm" class="form-label">Confirme a senha</label>
              <div class="col">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                <span class="password-confirm-invalid d-none is-text-invalid">As senhas não conferem</span>
                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="my-4 fs-6 bg-footer-theme rounded p-3">
              <p class="mb-2 fw-semibold">A sua senha deve conter pelo menos:</p>
              <ul class="ps-3 mb-0">
                <li id="regex_maiuscula">1 caractere em maiúscula</li>
                <li id="regex_minuscula">1 caracteres em minúscula</li>
                <li id="regex_especial">1 caractere especial</li>
                <li id="regex_numero">1 número</li>
              </ul>
            </div>

            <div class="col text-center" id="col_btn_submit">
              <input type="submit" value="Alterar senha" disabled class="btn btn-submit btn-primary d-grid mx-auto" />
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@include('content.authentications.scripts')

@endsection
