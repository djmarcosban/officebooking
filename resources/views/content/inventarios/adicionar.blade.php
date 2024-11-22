@extends('layouts/contentNavbarLayout', ["container" => "container-xxl col-12 m-w-950"])
@section('title', 'Adicionar Inventário')
@section('content')

@include('_partials.styles.custom-container')
@include('_partials.titles.add-edit', ["title" => "Adicionar Inventário"])
@include('_partials.errors')

<form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="submit">
  @csrf

  <input type="hidden" name="inventario_id" id="inventario_id" value="">
  <input type="hidden" name="acao" id="acao" value="adicionar">

  <h5>Dados de identificação:</h5>
  <div class="card mb-4 col-12">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-12 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="nome" class="form-label">Nome<span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" value="{{@old('nome')}}" class="form-control" required>
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
            <input type="number" name="cap_max" id="cap_max" value="{{@old('cap_max')}}" class="form-control">
          </div>
        </div>
        <div class="col-xl-4 col-12 mb-xl-0 mb-4">
          <div class="form-group">
            <label for="marca" class="form-label">Marca <small class="text-muted">(Opcional)</small></label>
            <input type="text" name="marca" id="marca" value="{{@old('marca')}}" class="form-control">
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
          <label for="horarioInicio" class="form-label">Horário inicial:<span class="text-danger">*</span></label>
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
            <input type="text" name="detalhes" id="detalhes" value="{{@old('detalhes')}}" class="form-control">
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
      <input type="submit" class="btn btn-primary" value="Adicionar" />
    </div>
  </div>
</form>

@include('content.inventarios.scripts')

@endsection
