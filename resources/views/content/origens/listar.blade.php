@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$origens->total().') Locais')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Locais ({{$origens->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/origem/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@include('_partials.errors')

@if(!count($origens))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Você não inseriu locais ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todas os Locais</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">Endereço</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($origens as $origem)
              <tr>
                <td>{{$origem->nome}} <span class="badge badge-{{$origem->status == 'ativo' ? 'success' : 'danger'}}">{{ucfirst($origem->status)}}</span></td>
                <td>{{$origem->address}}, nº {{$origem->number}}, {{$origem->neighborhood}}, {{$origem->city}}/{{$origem->state}}</td>
                <td class="d-flex">
                  <a href="origem/{{$origem->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar origem" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar destino" style="width: 21px" />
                  </a>

                  <form action="origem/{{$origem->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="origem_id" value="{{$origem->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir origem">
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

  @if($origens->hasPages())
    <div class="mt-2 pagination">
      {{$origens->links()}}
    </div>
  @endif
@endif

@endsection
