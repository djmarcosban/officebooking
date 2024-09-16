@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$servicos->total().') Serviços')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Serviços ({{$servicos->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/servico/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($servicos))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu servicos ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos os Serviços</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">Apelido</th>
              <th class="text-dark">Tipo</th>
              <th class="text-dark">Valor</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($servicos as $servico)
              <tr>
                <td>{{$servico->nome}} <span class="badge badge-{{$servico->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($servico->status)}}</span></td>
                <td>{{$servico->apelido}}</td>
                <td>{{ucfirst($servico->tipo)}}</td>
                <td>R$ {{$servico->valor}}</td>
                <td class="d-flex">
                  <a href="servico/{{$servico->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar servico" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar destino" style="width: 21px" />
                  </a>

                  <form action="servico/{{$servico->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="servico_id" value="{{$servico->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir servico">
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

  @if($servicos->hasPages())
    <div class="mt-2 pagination">
      {{$servicos->links()}}
    </div>
  @endif
@endif

@endsection
