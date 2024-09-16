@extends('layouts/contentNavbarLayout', ["container" => "container-xxl m-w-1140"])
@section('title', '('.$vouchers->total().') Vouchers')
@section('content')

<style>
.container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
  max-width: 1400px;
}
</style>

<div class="row py-3 mb-4">
  <div class="col-auto">
    <h1 class="fw-light m-0 text-dark">
      Vouchers ({{$vouchers->total()}})
    </h1>
  </div>
  <div class="col d-flex align-items-center">
    <a href="/voucher/adicionar" class="btn btn-primary"> <i class="bx bx-plus"></i> Adicionar novo</a>
  </div>
</div>

@if(request('last_id'))
<script>
  window.open('/voucher/{{request("last_id")}}/pdf', '_blank');
</script>
@endif

@include('_partials.errors')

@if(!count($vouchers))
  <div class="alert alert-dark" role="alert">
    <ul class="list-unstyled m-0">
      <li>Nenhum voucher criado ainda.</li>
    </ul>
  </div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos os Vouchers</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Voucher</th>
              <th class="text-dark">Cliente</th>
              <th class="text-dark">Serviços</th>
              <th class="text-dark">Valor Total</th>
              <th class="text-dark">Valor Reserva</th>
              <th class="text-dark">Valor Restante</th>
              <th class="text-dark">Etapa Kanban</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($vouchers as $voucher)
              <tr>
                <td>#{{$voucher->id}}</td>
                <td>{!!$voucher->cliente->nome!!}</td>
                <td>{{count($voucher->servicos)}}</td>
                <td>{{$voucher->valor_total}}</td>
                <td>{{$voucher->valor_reserva}}</td>
                <td>{{$voucher->valor_restante}}</td>
                <td>{{$voucher->etapa->titulo}}</td>
                <td class="d-flex">

                  <a href="voucher/{{$voucher->id}}/pdf" target="_blank">
                    <i class='bx bxs-file-pdf fs-3 me-2'  data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Gerar PDF"  style="color: rgb(217, 69, 6)"></i>
                  </a>

                  <a href="voucher/{{$voucher->id}}/edit">
                    <img src="{{asset('assets/img/edit.png')}}" alt="Editar voucher" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar Voucher" style="width: 21px" />
                  </a>

                  <form action="voucher/{{$voucher->id}}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="voucher_id" value="{{$voucher->id}}">
                    <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir voucher">
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

  @if($vouchers->hasPages())
    <div class="mt-2 pagination">
      {{$vouchers->links()}}
    </div>
  @endif
@endif

@endsection
