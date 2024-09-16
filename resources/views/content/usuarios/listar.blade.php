@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$usuarios->total().') Usuários')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Usuários ({{$usuarios->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/usuario/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($usuarios))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu usuarios ainda.</li>
    </ul>
  </div>
@else
 <div class="card">
    <h5 class="card-header mb-0">Todas os Usuários</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">Email</th>
              <th class="text-dark">Empresa</th>
              <th class="text-dark">Função</th>
              <th class="text-dark">Status</th>
              <th class="text-dark">Data criação</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usuarios as $usuario)
              <tr>
                <td>{{$usuario->nome}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$usuario->empresa ? $usuario->empresa->company_name : '-'}}</td>
                <td>
                  <span class="badge badge-primary">{{ucfirst($usuario->funcao)}}</span>
                </td>
                <td>
                  <span class="badge badge-{{$usuario->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($usuario->status)}}</span>
                </td>
                <td>{{$usuario->data_criacao}}</td>
                <td class="d-flex">
                  <a href="usuario/{{$usuario->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar usuário" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar usuário" style="width: 21px" />
                  </a>

                  <form action="usuario/{{$usuario->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="usuario_id" value="{{$usuario->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir usuário">
                      <img src="{{asset('assets/img/delete.png')}}" alt="Tornar doador" class="rounded-circle" style="width: 20px" />
                    </button>
                  </form>
                </td>
              </tr>

            @endforeach

          </tbody>
        </table>
      </div>
    </div>
 </div>
  @if($usuarios->hasPages())
    <div class="mt-2 pagination">
      {{$usuarios->links()}}
    </div>
  @endif
@endif

@endsection
