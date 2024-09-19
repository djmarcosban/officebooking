@php
$exitScale = true;
$isNavbar = true;
$isMenu = false;
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Dashboard')
@section('content')

<script src="{{ asset('assets/vendor/libs/jquery/jquery-ui.min.js') }}"></script>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Reservas
    </h1>
  </div>
</div>

<style>
  .sortable-placeholder {
    height: 40px;
    background-color: #e0e0e0;
    border: 2px dashed #ccc;
    margin-bottom: 10px;
  }

  #kanban-board {
    display: flex;
    justify-content: space-around;
  }

  .kanban-column {
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
  }

  .kanban-item {
    padding: 10px;
    margin: 10px 0 25px 0;
    border-radius: 6px;
    cursor: grab;
  }

  .etapa_pendente .kanban-item { background-color: #fffeda; border: 1px solid #b39e5f; }
  .etapa_pendente .kanban-item hr { color: #ccc6a3!important }

  .etapa_aprovada .kanban-item { background-color: #daffde; border: 1px solid #5fb367; }
  .etapa_aprovada .kanban-item hr { color: #a3cca7!important }

  .etapa_cancelada .kanban-item { background-color: #ffdada; border: 1px solid #b35f5f; }
  .etapa_cancelada .kanban-item hr { color: #cca3a3!important }

  .etapa_historico .kanban-item { background-color: #efefef; border: 1px solid #ababab; }
  .etapa_historico .kanban-item hr { color: #cbcbcb!important }

  .kanban-item:hover {
	  box-shadow: 0 0.25rem 1rem rgba(161, 172, 184, 0.45) !important;
  }

  .kanban-item:last-child {
    margin-bottom: 0
  }

  .kanban-items {
    min-height: 100px;
  }
</style>

<div id="kanban-board" class="row">
  @foreach ($etapas as $key => $etapa)
    <div class="col etapa_{{$etapa['slug']}}" data-etapa="{{$key}}">
      <div class="card">
        <h5 class="card-header mb-0">{{$etapa['title']}}</h5>
        <hr class="m-0">
        <div class="kanban-column card-body pt-2">
          <div class="kanban-items">
            @foreach ($etapa['reservas'] as $reserva)
              <div class="kanban-item" data-id="{{$reserva->id}}">
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">Reserva #{{$reserva->id}}</span>
                </div>
                <div>
                  Professor(a): {!!$reserva->professor->nome ?? '<span class="text-danger">Excluido</span>'!!}
                </div>
                <hr>
                <div class="row d-flex justify-content-between">
                  <div class="col">
                    <span>{{$reserva->inventario->nome}}</span>
                  </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-between mb-2">
                  <div class="col">
                    <small>Data</small>
                    <br />
                    <span>{{$reserva->data}}</span>
                  </div>
                  <div class="col">
                    <small>Horário</small>
                    <br />
                    <span>{{$reserva->horario}}</span>
                  </div>
                </div>
                <div class="mt-2">
                  <small class="text-muted">{{$reserva->data_criacao}}</small>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<script>
  $(function() {
    $(".kanban-items").sortable({
      connectWith: ".kanban-items",
      placeholder: "sortable-placeholder",
      revert: false,
      scroll: false,
      scrollSpeed: 0,
      delay: 0,
      tolerance: 'pointer',
      forcePlaceholderSize: true,
      stop: function(event, ui) {
        var item = ui.item;
        var etapa = item.closest('.col').data('etapa');
        var itemId = item.data('id');

        // $.ajax({
        //   url: '/kanban/update',
        //   method: 'POST',
        //   data: {
        //     reserva_id: itemId,
        //     etapa_id: etapa,
        //     _token: '{{ csrf_token() }}'
        //   },
        //   success: function(response) {
        //   },
        //   error: function() {
        //     $(".kanban-items").sortable('cancel')
        //     alert('Erro ao atualizar o Voucher. Contate o administrador.');
        //   }
        // });
      }
    }).disableSelection();
  });
</script>

@endsection
