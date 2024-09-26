@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-950"])
@section('title', 'Atualizar Inventário')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "Atualizar Inventário"])
@include('_partials.errors')

<form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="submit">
  @csrf
  @method('PUT')

  <input type="hidden" name="inventario_id" id="inventario_id" value="{{$inventario->id}}">
  <input type="hidden" name="acao" id="acao" value="editar">

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{$inventario->nome}}" class="form-control" required>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Detalhes:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-3 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="cap_max" class="form-label">Capacidade <small class="text-muted">(Opcional)</small></label>
            <input type="number" name="cap_max" id="cap_max" value="{{$inventario->cap_max}}" class="form-control">
          </div>
        </div>
        <div class="col-xl-4 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="marca" class="form-label">Marca <small class="text-muted">(Opcional)</small></label>
            <input type="text" name="marca" id="marca" value="{{$inventario->marca}}" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>

  <h5>Horários:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <label for="diaSemana" class="form-label">Escolha o dia da semana:<span class="text-danger">*</span></label>
            <select name="diaSemana" id="diaSemana" class="form-select">
              <option value="1">Segunda-feira</option>
              <option value="2">Terça-feira</option>
              <option value="3">Quarta-feira</option>
              <option value="4">Quinta-feira</option>
              <option value="5">Sexta-feira</option>
              <option value="6">Sábado</option>
              <option value="0">Domingo</option>
            </select>
          </div>
        </div>

        <div class="col-3">
          <label for="horarioInicio" class="form-label">Horário de início:<span class="text-danger">*</span></label>
          <select name="horarioInicio" id="horarioInicio" required class="form-select">
            <?php
            $horario = new DateTime('06:00');
            $intervalo = new DateInterval('PT60M');

            while ($horario <= new DateTime('23:00')) {
              echo '<option value="' . $horario->format('H:i') . '">' . $horario->format('H:i') . '</option>';
              $horario->add($intervalo);
            }
            ?>
          </select>
        </div>

        <div class="col-3">
          <label for="horarioFim" class="form-label">Horário final:<span class="text-danger">*</span></label>
          <select name="horarioFim" id="horarioFim" required class="form-select">
            <?php
            $horario = new DateTime('07:00');
            $intervalo = new DateInterval('PT60M');

            while ($horario <= new DateTime('22:00')) {
              echo '<option value="' . $horario->format('H:i') . '">' . $horario->format('H:i') . '</option>';
              $horario->add($intervalo);
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <label for="" class="form-label">&nbsp;</label>
          <a href="javascript:void(0)" onclick="adicionarDiaSemana()" class="btn btn-sm btn-primary">+</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4 col-12 lista d-none">
    <div class="card-body">
      <div class="row">
        <div class="col-4">
          <h5>Horários Adicionados:</h5>
          <ul class="m-0" id="listaHorarios"></ul>
        </div>
      </div>
    </div>
  </div>

  <h5>Outros:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="detalhes" class="form-label">Detalhes Adicionais <small class="text-muted">(Opcional)</small></label>
            <input type="text" name="detalhes" id="detalhes" value="{{$inventario->detalhes}}" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-auto d-flex justify-content-center">
      <a href="javascript:history.back(-1)" class="btn btn-outline-secondary me-3">Cancelar</a>
    </div>
    <div class="col-auto ps-0 d-flex align-items-center justify-content-start text-center" id="col_btn_submit">
      <input type="submit" class="btn btn-primary" value="Atualizar" />
    </div>
  </div>
</form>

@include('content.inventarios.scripts')

@if(!empty($inventario->horarios))
  <h5 class="mt-5">Horários Configurados:</h5>
  <div class="row">
    @foreach($inventario->horarios as $horarios)
      <div class="col-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5>{{reset($horarios)["dia_semana"]}}</h5>
            <div class="table-responsive text-nowrap table-escala">
              <table class="table table-bordered table-sm table-hover table-striped">
                <thead class="table-dark">
                  <tr>
                    <th class="text-white">Horário Início</th>
                    <th class="text-white">Horário Fim</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($horarios as $horario)
                    @php
                    $horario = json_decode(json_encode($horario, true))
                    @endphp
                    <tr>
                      <td>{{$horario->horario_inicio}}</td>
                      <td>{{$horario->horario_fim}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif

@endsection
