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
      Kanban
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
    background-color: #daffde;
    border: 1px solid #5fb367;
    border-radius: 6px;
    cursor: grab;
  }

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
  @foreach ($etapas as $etapa)
    <div class="col" data-etapa="{{$etapa->id}}">
      <div class="card">
        <h5 class="card-header mb-0">{{$etapa->titulo}}</h5>
        <hr class="m-0">
        <div class="kanban-column card-body pt-2">
          <div class="kanban-items">
            @foreach ($etapa['vouchers'] as $voucher)
              <div class="kanban-item" data-id="{{$voucher->id}}">
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">Voucher #{{$voucher->id}}</span>
                  <span class="badge badge-primary">{{$voucher->operador->nome ?? 'Operador Deconhecido'}}</span>
                </div>
                <div>
                  Cliente: {!!$voucher->cliente->nome ?? '<span class="text-danger">Excluido</span>'!!}
                </div>
                <hr>
                <ul style="list-style:none" class="p-0">
                  @foreach($voucher->servicos as $servico)
                    <li>{{$loop->index + 1 .'. '.$servico->nome}}</li>
                  @endforeach
                </ul>
                <hr>
                <div class="row d-flex justify-content-between mb-2">
                  <div class="col">
                    <small>Reserva</small>
                    <br />
                    <span>R${{$voucher->valor_reserva}}</span>
                  </div>
                  <div class="col">
                    <small>Desconto</small>
                    <br />
                    <span>R${{$voucher->valor_desconto}}</span>
                  </div>
                </div>
                <div class="row d-flex justify-content-between">
                  <div class="col">
                    <small>Restante</small>
                    <br />
                    <span>R${{$voucher->valor_restante}}</span>
                  </div>
                  <div class="col">
                    <small>Total</small>
                    <br />
                    <span>R${{$voucher->valor_total}}</span>
                  </div>
                </div>
                <div class="mt-2">
                  <small class="text-muted">{{$voucher->data_criacao}}</small>
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

        $.ajax({
          url: '/kanban/update',
          method: 'POST',
          data: {
            voucher_id: itemId,
            etapa_id: etapa,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
          },
          error: function() {
            $(".kanban-items").sortable('cancel')
            alert('Erro ao atualizar o Voucher. Contate o administrador.');
          }
        });
      }
    }).disableSelection();
  });
</script>

@endsection
