@extends('layouts/contentNavbarLayout', ['container' => 'container-xxl col-12 m-w-1250'])
@section('title', '(' . count($reservas) . ') Reservas')
@section('content')

  @include('_partials.styles.custom-container')
  @include('_partials.titles.list', [
      'title' => 'Reservas',
      'count' => count($reservas),
      'url' => '/reserva/adicionar',
  ])
  @include('_partials.errors')

  @if (!empty(request('status')) && request('status') == 'select')
    <div class="alert alert-danger" role="alert">
      <p class="m-0 fw-bold mb-1">Acesse uma instituição para continuar navegando.</p>
      <p class="m-0">Clique em "Acessar" na aba "Gerenciar".</p>
    </div>
  @endif

  @if (!count($reservas))
    <div class="alert alert-dark" role="alert">
      <ul class="list-unstyled m-0">
        <li>Nenhuma reserva encontrada. <a href="/reserva/adicionar">Clique aqui para adicionar</a>.</li>
      </ul>
    </div>
  @else
    <div class="card">
      <h5 class="card-header mb-0">Todos as Reservas</h5>
      <hr class="mt-0 mb-1">
      <div class="card-body">
        <div class="table-responsive text-nowrap table-escala">
          <table class="table table-bordered table-sm table-hover table-striped">
            <thead>
              <tr>
                <th class="text-dark">Instituição</th>
                <th class="text-dark">Inventário</th>
                <th class="text-dark">Status</th>
                <th class="text-dark">Data</th>
                <th class="text-dark">Descrição</th>
                <th class="text-dark">Criado em</th>
                <th class="text-dark">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reservas as $reserva)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      {{ $reserva['instituicao']['nome'] }}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      {{ $reserva['inventario']['nome'] }}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      {!! $reserva['status'] !!}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      {{ $reserva['data'] }}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      {{ !empty($reserva['descricao']) ? $reserva['descricao'] : '-' }}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      {{ $reserva['data_criacao'] }}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex">
                      <a href="/reserva/{{ $reserva->id }}/editar">
                        <img src="{{ asset('assets/img/edit.png') }}" alt="Editar" data-bs-toggle="tooltip"
                          data-bs-placement="left" data-bs-title="Editar" style="width: 21px" data-bs-original-title=""
                          title="">
                      </a>

                      <form action="/reserva/{{ $reserva['id'] }}/deletar" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="reserva_id" value="{{ $reserva['id'] }}">
                        <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }"
                          class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left"
                          data-bs-title="Excluir" data-bs-original-title="" title="">
                          <img src="{{ asset('assets/img/delete.png') }}" alt="Excluir" class="rounded-circle"
                            style="width: 20px">
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
