@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', 'Adicionar Voucher')
@section('content')

<div class="row py-3 mb-5">
  <div class="col-12 p-xl-0 col-xl-5 align-items-center d-flex">

    <a href="{{ url()->previous() }}" class="mt-1 me-4">
      <img src="{{asset('assets/img/back.png')}}" style="width: 30px" alt="Voltar">
    </a>

    <h1 class="fw-light m-0 text-dark">
      Adicionar Voucher
    </h1>
  </div>
</div>

@include('_partials.errors')

<script>
var clientes_js = '{!! json_encode($clientes) !!}';
var services_js = '{!! json_encode($servicos) !!}';
var origens_destinos_js = '{!! json_encode($origensDestinos) !!}';

origens_destinos_js = JSON.parse(origens_destinos_js)
services_js = JSON.parse(services_js)
clientes_js = JSON.parse(clientes_js)

let servicos = []
let clientes = []
</script>

<form action="" autocomplete="off" id="voucherForm" method="POST">
  @csrf

  <input type="hidden" id="servicos" name="servicos" value="" />
  <input type="hidden" id="cliente" name="cliente" value="" />

  <h5>Kanban:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="etapa" class="form-label">Etapa<span class="text-danger">*</span></label>
            <select name="etapa_id" required id="etapa" class="form-select">
              @foreach ($etapas as $etapa)
                <option value="{{$etapa->id}}">{{$etapa->titulo}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Cliente:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row div-clientes d-none">
        <div class="col-12">
          <ul class="list-group list-clientes"></ul>
        </div>
      </div>

      <button
        type="button"
        id="btn-add-customer"
        class="btn btn-outline-primary btn-sm rounded-1"
        data-type="html"
        data-width="modal-lg"
        data-bs-toggle="modal"
        data-bs-target="#modalClientes"
      >
        Adicionar
      </button>

    </div>
  </div>

  <h5>Serviços:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">

      <div class="row mb-4 div-servicos d-none">
        <div class="col-12">
          <ul class="list-group list-servicos"></ul>
        </div>
      </div>

      <button
        type="button"
        class="btn btn-outline-primary btn-sm rounded-1"
        data-type="html"
        data-width="modal-lg"
        data-bs-toggle="modal"
        data-bs-target="#modalServicos"
      >
        Adicionar
      </button>
    </div>
  </div>

  <input type="hidden" name="subtotal" id="subtotal" value="0,00" />

  <h5>Valores:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_reserva" class="form-label">Valor Reserva<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" name="valor_reserva" id="valor_reserva" value="{{@old('valor_reserva') ?? '0,00'}}" required class="valor_formatado form-control @error('valor_reserva') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_desconto" class="form-label">Desconto<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" name="valor_desconto" id="valor_desconto" value="{{@old('valor_desconto') ?? '0,00'}}" required class="valor_formatado form-control @error('valor_desconto') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_restante" class="form-label">Valor Restante<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" readonly name="valor_restante" id="valor_restante" value="{{@old('valor_restante') ?? '0,00'}}" required class="valor_formatado form-control @error('valor_restante') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_total" class="form-label">Valor Total<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" readonly name="valor_total" id="valor_total" value="{{@old('valor_total') ?? '0,00'}}" required class="valor_formatado form-control @error('valor_total') is-invalid @enderror" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Adicionar" />
    </div>
  </div>
</form>

@include('content.vouchers.styles')
@include('content.vouchers.modals')
@include('content.vouchers.scripts')

@endsection
