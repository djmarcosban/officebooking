@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-1140"])
@section('title', '('.count($inventarios).') Inventário')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.list', ["title" => "Inventário", "count" => count($inventarios), "url" => "/inventario/adicionar"])
@include('_partials.errors')

@if(!empty(request('status')) && request('status') == 'select')
  <div class="alert alert-danger" role="alert">
    <p class="m-0 fw-bold mb-1">Acesse uma instituição para continuar navegando.</p>
    <p class="m-0">Clique em "Acessar" na aba "Gerenciar".</p>
  </div>
@endif

@if(!count($inventarios))
<div class="alert alert-dark" role="alert">
  <ul class="list-unstyled m-0">
    <li>Nenhuma inventario encontrada. <a href="/inventario/adicionar">Clique aqui para adicionar</a>.</li>
  </ul>
</div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos os Inventário</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">Cap. Máx.</th>
              <th class="text-dark">Marca</th>
              <th class="text-dark">Criado em</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inventarios as $inventario)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    {{$inventario->nome}}
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$inventario->cap_max}}
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$inventario->marca}}
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$inventario->data_criacao}}
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <a href="/inventario/{{$inventario->id}}/editar">
                      <img src="{{ asset('assets/img/edit.png') }}" alt="Editar" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar" style="width: 21px" data-bs-original-title="" title="">
                    </a>

                    <form action="/inventario/{{$inventario->id}}/deletar" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="lote_id" value="{{$inventario->id}}">
                      <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir" data-bs-original-title="" title="">
                        <img src="{{ asset('assets/img/delete.png') }}" alt="Excluir" class="rounded-circle" style="width: 20px">
                      </button>
                    </form>
                  </div>
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
