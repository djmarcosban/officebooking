@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-950"])
@section('title', '('.$etapas->count().') Etapas')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Etapas ({{$etapas->count()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/etapa/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($etapas))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu etapas ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos as Etapas</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Título</th>
              <th class="text-dark">Posição</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($etapas as $etapa)
              <tr>
                <td>{{$etapa->titulo}} <span class="badge badge-{{$etapa->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($etapa->status)}}</span></td>
                <td>{{$etapa->posicao}}</td>
                <td class="d-flex">
                  <a href="etapa/{{$etapa->id}}/editar">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar etapa" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar destino" style="width: 21px" />
                  </a>

                  <form action="etapa/{{$etapa->id}}/deletar" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="etapa_id" value="{{$etapa->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir etapa">
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
@endif

@endsection
