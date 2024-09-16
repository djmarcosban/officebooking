@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$veiculos->total().') Veículos')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Veículos ({{$veiculos->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/veiculo/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($veiculos))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu veículos ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos os Veículos</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Modelo</th>
              <th class="text-dark">Marca</th>
              <th class="text-dark">Placa</th>
              <th class="text-dark">Ano</th>
              <th class="text-dark">Status</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($veiculos as $veiculo)
              <tr>
                <td>{{$veiculo->modelo}}</td>
                <td>{{$veiculo->marca}}</td>
                <td>{{$veiculo->placa}}</td>
                <td>{{$veiculo->ano}}</td>
                <td>
                  <span class="badge badge-{{$veiculo->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($veiculo->status)}}</span>
                </td>
                <td class="d-flex">
                  <a href="veiculo/{{$veiculo->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar veiculo" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar destino" style="width: 21px" />
                  </a>

                  <form action="veiculo/{{$veiculo->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="veiculo_id" value="{{$veiculo->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir veiculo">
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

  @if($veiculos->hasPages())
    <div class="mt-2 pagination">
      {{$veiculos->links()}}
    </div>
  @endif
@endif

@endsection
