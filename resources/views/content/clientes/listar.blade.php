@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$clientes->total().') Clientes')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Clientes ({{$clientes->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/cliente/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($clientes))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu cliente ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos os Clientes</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">Tipo</th>
              <th class="text-dark">Documento</th>
              <th class="text-dark">Nº voo</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clientes as $cliente)
              <tr>
                <td>{{$cliente->nome}} <span class="badge badge-{{$cliente->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($cliente->status)}}</span></td>
                <td>{{ucfirst($cliente->tipo)}}</td>
                <td>{{$cliente->documento}}</td>
                <td>{{$cliente->numero_voo}}</td>
                <td class="d-flex">
                  <a href="cliente/{{$cliente->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar cliente" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar destino" style="width: 21px" />
                  </a>

                  <form action="cliente/{{$cliente->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir cliente">
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

  @if($clientes->hasPages())
    <div class="mt-2 pagination">
      {{$clientes->links()}}
    </div>
  @endif
@endif

@endsection
