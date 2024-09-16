@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', 'Editar Voucher')
@section('content')

<div class="row py-3 mb-5">
  <div class="col-12 p-xl-0 col-xl-5 align-items-center d-flex">

    <a href="{{ url()->previous() }}" class="mt-1 me-4">
      <img src="{{asset('assets/img/back.png')}}" style="width: 30px" alt="Voltar">
    </a>

    <h1 class="fw-light m-0 text-dark">
      Editar Voucher
    </h1>
  </div>
</div>

@include('_partials.errors')

<script>
let servicos = JSON.parse('{!! json_encode($voucher->servicos) !!}')

let clientes = []
@if($voucher->cliente->id != 0)
clientes.push(JSON.parse('{!! json_encode($voucher->cliente) !!}'))
@endif


var clientes_js = '{!! json_encode($clientes) !!}';
var services_js = '{!! json_encode($servicos) !!}';
var origens_destinos_js = '{!! json_encode($origensDestinos) !!}';

origens_destinos_js = JSON.parse(origens_destinos_js)
services_js = JSON.parse(services_js)
clientes_js = JSON.parse(clientes_js)
</script>

<form action="" autocomplete="off" id="voucherForm" method="POST">
  @csrf
  @method('PUT')

  <input type="hidden" id="servicos" name="servicos" value='{!! json_encode($voucher->servicos) !!}' />
  <input type="hidden" id="cliente" name="cliente" value='{!! json_encode($voucher->cliente_id !== 0 ? [$voucher->cliente] : []) !!}' />
  <input type="hidden" name="voucher_id" value='{{$voucher->id}}' />

  <h5>Kanban:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="etapa" class="form-label">Etapa<span class="text-danger">*</span></label>
            <select name="etapa_id" required id="etapa" class="form-select">
              @foreach ($etapas as $etapa)
                <option {{$voucher->etapa_id == $etapa->id ? 'selected' : ''}} value="{{$etapa->id}}">{{$etapa->titulo}}</option>
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
      <div class="row div-clientes">
        <div class="col-12">
          <ul class="list-group list-clientes">
            @if($voucher->cliente_id != 0)
              <li class="list-group-item rounded border-top" id="cliente_{{$voucher->cliente->uniqueId ?? '9999'}}">
                <div class="fw-bold d-flex align-itens-center">
                  <button onclick="removeCliente({{$voucher->cliente->uniqueId ?? '9999'}})" class="btn btn-transparent p-0 me-2">
                    <i class="bx bx-trash"></i>
                  </button>
                  {!!$voucher->cliente->nome ?? '<span class="text-danger">Cliente excluido da base de dados</span>'!!}
                </div>
                <hr>

                <div class="row">
                  <div class="col-6 col-xl-2">
                    <label class="form-label">Nº do voo:</label>
                    <input type="text" value="{{$voucher->cliente->numero_voo ?? ''}}" onchange="atualizaItemCliente({{$voucher->cliente->uniqueId ?? '9999'}}, 'numero_voo', this.value)" name="numero_voo" id="numero_voo_{{$voucher->cliente->uniqueId ?? '9999'}}" class="form-control" />
                  </div>
                  <div class="col-6 col-xl-10">
                    <label class="form-label">Acompanhantes: <small>(separados por vírgula)</small></label>
                    <textarea
                      rows="4"
                      onchange="atualizaItemCliente({{$voucher->cliente->uniqueId ?? '9999'}}, 'acompanhantes', this.value)"
                      name="acompanhantes" id="acompanhantes_{{$voucher->cliente->uniqueId ?? '9999'}}"
                      class="form-control"
                    >{{$voucher->cliente->acompanhantes ?? ''}}</textarea>
                  </div>
                </div>
              </li>
            @endif
          </ul>
        </div>
      </div>

      <button
        type="button"
        id="btn-add-customer"
        class="btn btn-outline-primary btn-sm rounded-1 {{$voucher->cliente_id != 0 ? 'd-none' : ''}}"
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

      <div class="row mb-4 div-servicos {{!$voucher->servicos ? 'd-none' : ''}}">
        <div class="col-12">
          <ul class="list-group list-servicos">
            @if($voucher->servicos)
              @foreach ($voucher->servicos as $servico)
                @php
                $randomIdOrigem = $servico->id.mt_rand(0, 9999);
                $randomIdDestino = $servico->id.mt_rand(0, 9999);
                @endphp
                <li class="list-group-item rounded border-top" id="servico_{{$servico->uniqueId}}">
                  <div class="fw-bold d-flex align-itens-center">
                    <button onclick="removeServico({{$servico->uniqueId}})" class="btn btn-transparent p-0 me-2">
                      <i class="bx bx-trash"></i>
                    </button>
                    {{$servico->nome}} <span class="badge badge-success">R$ {{$servico->valor}}</span>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-6 col-xl-2">
                      <label class="form-label">Quando:</label>
                      <input type="date" value={{$servico->data}} required onchange="atualizaItemServico({{$servico->uniqueId}}, 'data', this.value)" name="data" id="data_{{$servico->uniqueId}}" class="form-control" />
                    </div>
                    <div class="col-6 col-xl-2">
                      <label class="form-label">Horário:</label>
                      <input type="time" value={{$servico->horario}} required onchange="atualizaItemServico({{$servico->uniqueId}}, 'horario', this.value)" name="horario" id="horario_{{$servico->uniqueId}}" class="form-control" />
                    </div>

                    <div class="col-6 col-xl-2">
                      <div class="form-group">
                        <label for="subtipo" class="form-label">Tipo:</label>
                        <select name="subtipo" id="subtipo" class="form-select">
                          <option {{$servico->subtipo == 'ida' ? 'selected' : ''}} value="ida">Ida</option>
                          <option {{$servico->subtipo == 'volta' ? 'selected' : ''}} value="volta">Volta</option>
                          <option {{$servico->subtipo == 'nenhum' ? 'selected' : ''}} value="nenhum">Nenhum</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-6 col-xl-3">
                      <div class="form-group">
                        <label for="filter_origens-destinos-{{$randomIdOrigem}}" class="form-label">Embarque:</label>
                        <input type="text" value="{{$servico->origem}}" required onclick="openDropDown('origens-destinos-{{$randomIdOrigem}}')" class="form-control" name="filter_origens-destinos-{{$randomIdOrigem}}" id="filter_origens-destinos-{{$randomIdOrigem}}" onkeyup="filterDropDown('origens-destinos-{{$randomIdOrigem}}')" />
                      </div>
                      <div id="select-dropdown-content" class="select-dropdown-content origens-destinos-{{$randomIdOrigem}}-dropdown">
                        <div id="select-dropdown-query" class="origens-destinos-{{$randomIdOrigem}}-dropdown-query"></div>
                      </div>

                    </div>
                    <div class="col-6 col-xl-3 {{$servico->tipo == 'passeio' ? 'd-none' : ''}}">

                      <div class="form-group">
                        <label for="filter_origens-destinos-{{$randomIdDestino}}" class="form-label">Desembarque:</label>
                        <input type="text" value="{{$servico->destino}}" {{$servico->tipo == 'passeio' ? '' : 'required'}} onclick="openDropDown('origens-destinos-{{$randomIdDestino}}')" class="form-control" name="filter_origens-destinos-{{$randomIdDestino}}" id="filter_origens-destinos-{{$randomIdDestino}}" onkeyup="filterDropDown('origens-destinos-{{$randomIdDestino}}')" />
                      </div>
                      <div id="select-dropdown-content" class="select-dropdown-content origens-destinos-{{$randomIdDestino}}-dropdown">
                        <div id="select-dropdown-query" class="origens-destinos-{{$randomIdDestino}}-dropdown-query"></div>
                      </div>

                    </div>
                  </div>
                </li>
              @endforeach
            @endif

          </ul>
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

  @php
  $valor_total = $voucher->valor_total;
  $valor_total = str_replace('.', '', $valor_total);
  $valor_total = str_replace(',', '.', $valor_total);
  $valor_total_float = floatval($valor_total);

  $valor_desconto = $voucher->valor_desconto;
  $valor_desconto = str_replace('.', '', $valor_desconto);
  $valor_desconto = str_replace(',', '.', $valor_desconto);
  $valor_desconto_float = floatval($valor_desconto);
  @endphp

  <input type="hidden" name="subtotal" id="subtotal" value="{{number_format($valor_total + $valor_desconto, 2, ',', '.')}}" />

  <h5>Valores:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_reserva" class="form-label">Valor Reserva<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" name="valor_reserva" id="valor_reserva" value="{{$voucher->valor_reserva}}" required class="valor_formatado form-control @error('valor_reserva') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_desconto" class="form-label">Desconto<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" name="valor_desconto" id="valor_desconto" value="{{$voucher->valor_desconto}}" required class="valor_formatado form-control @error('valor_desconto') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_restante" class="form-label">Valor Restante<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" readonly name="valor_restante" id="valor_restante" value="{{$voucher->valor_restante}}" required class="valor_formatado form-control @error('valor_restante') is-invalid @enderror" />
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-6 mb-4 mb-xl-0">
          <div class="form-group">
            <label for="valor_total" class="form-label">Valor Total<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <span class="input-group-text">R$</span>
              <input type="text" placeholder="0,00" readonly name="valor_total" id="valor_total" value="{{$voucher->valor_total}}" required class="valor_formatado form-control @error('valor_total') is-invalid @enderror" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-start">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-4">Cancelar</a>
      <input type="submit" class="btn btn-primary" value="Salvar Alterações" />
    </div>
  </div>
</form>

@include('content.vouchers.styles')
@include('content.vouchers.modals')
@include('content.vouchers.scripts')

@endsection
