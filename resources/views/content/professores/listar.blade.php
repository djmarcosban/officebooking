@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-950"])
@section('title', '('.$professores->count().') Professores')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.list', ["title" => "Professores", "count" => count($professores), "url" => "/professor/adicionar"])
@include('_partials.errors')

@if(!count($professores))
<div class="alert alert-dark" role="alert">
  <ul class="list-unstyled m-0">
    <li>Nenhum professor encontrado. <a href="/professor/adicionar">Clique aqui para adicionar</a>.</li>
  </ul>
</div>
@else
  <div class="card">
    <h5 class="card-header mb-0">Todos as Professores</h5>
    <hr class="mt-0 mb-1">
    <div class="card-body">
      <div class="table-responsive text-nowrap table-escala">
        <table class="table table-bordered table-sm table-hover table-striped">
          <thead>
            <tr>
              <th class="text-dark">Nome</th>
              <th class="text-dark">E-mail</th>
              <th class="text-dark">Instituição</th>
              <th class="text-dark">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($professores as $professor)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    {{$professor->nome}}
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$professor->email}}
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    {{$professor->instituicao->nome}}
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <a href="/professor/{{$professor->id}}/editar">
                      <img src="{{ asset('assets/img/edit.png') }}" alt="Editar" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar" style="width: 21px" data-bs-original-title="" title="">
                    </a>

                    <form action="/professor/{{$professor->id}}/deletar" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="lote_id" value="{{$professor->id}}">
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
