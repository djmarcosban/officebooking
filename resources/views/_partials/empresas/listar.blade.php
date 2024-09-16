@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-1220"])
@section('title', '('.count($empresas).') Empresas')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.list', ["title" => "Empresas", "count" => count($empresas), "url" => "/instituicao/adicionar"])
@include('_partials.errors')

@if(!empty(request('status')) && request('status') == 'select')
  <div class="alert alert-danger" role="alert">
    <p class="m-0 fw-bold mb-1">Acesse uma instituicao para continuar navegando.</p>
    <p class="m-0">Clique em "Acessar" na aba "Gerenciar".</p>
  </div>
@endif

@if(!count($empresas))
<div class="alert alert-dark" role="alert">
  <ul class="list-unstyled m-0">
    <li>Nenhuma instituicao encontrada. <a href="/instituicao/adicionar">Clique aqui para adicionar</a>.</li>
  </ul>
</div>
@else
  <div class="table-responsive text-nowrap table-escala">
    <table class="table table-bordered table-sm table-hover table-striped">
      <thead>
        <tr>
          <th class="text-dark">Empresa</th>
          <th class="text-dark">Cidade</th>
          <th class="text-dark">Agente de tratamento</th>
          <th class="text-dark">Encarregado</th>
          {{-- <th class="text-dark">Tipo de Agente de Tratamento</th> --}}
          <th class="text-dark">Gerenciar</th>
          <th class="text-dark">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($empresas as $instituicao)
          <tr>
            <td>
              <div class="d-flex align-items-center">
                {{$instituicao->company_name}}
                @if($instituicao->status == 'active')
                  <div class="badge bg-success text-white">Ativo</div>
                @else
                  <div class="badge bg-danger text-white">Inativo</div>
                @endif
              </div>
            </td>
            <td>
              {{$instituicao->city}}/{{$instituicao->state}}
            </td>
            <td>
              {{$instituicao->agente_tratamento}}
            </td>
            <td>
              {{$instituicao->encarregado}}
            </td>
            {{-- <td>
              {{$instituicao->tipo_agente}}
            </td> --}}
            <td>
              <a class="btn btn-primary btn-sm" href="/configurar/instituicao/{{$instituicao->id}}{{ (request('redirectTo')) ? "?redirectTo=".request('redirectTo') : "" }}">Acessar &#10142;</a>
            </td>
            <td class="d-flex">
              <a href="/instituicao/{{$instituicao->id}}/editar">
                <img src="{{ asset('assets/img/edit.png') }}" alt="Editar" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar" style="width: 21px" data-bs-original-title="" title="">
              </a>
              
              @if(Auth::user()->funcao != 'operador')
                <form action="/instituicao/{{$instituicao->id}}/deletar" method="POST">
                  @csrf
                  <input type="hidden" name="lote_id" value="{{$instituicao->id}}">
                  <button type="submit" onclick="if(!confirm('Deseja realmente fazer isso?')){ return false }" class="border-0 p-0 ms-2 bg-transparent" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Excluir" data-bs-original-title="" title="">
                    <img src="{{ asset('assets/img/delete.png') }}" alt="Excluir" class="rounded-circle" style="width: 20px">
                  </button>
                </form>
              @endif
            </td>
          </tr>

        @endforeach
        
      </tbody>
    </table>
  </div>
@endif

@endsection