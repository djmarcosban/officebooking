@extends('layouts/contentNavbarLayout', ['container' => 'container-xxl col-12 m-w-950'])
@section('title', 'Adicionar Reserva')
@section('content')

  @include('_partials.styles.custom-container')
  @include('_partials.titles.add-edit', ['title' => 'Adicionar Reserva'])
  @include('_partials.errors')

  <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="submit">
    @csrf

    <input type="hidden" name="inventarios" value="{{ $inventarios }}">

    <h5>O que você deseja reservar?:</h5>
    <div class="card mb-4 col-12">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-6 col-12 mb-xl-0 mb-4">
            <div class="form-group">
              <label for="inventario" class="form-label">Escolha uma opção<span class="text-danger">*</span></label>
              <select name="inventario" id="inventario" class="form-select">
                <option value="">Escolha uma opção</option>
                @foreach ($inventarios as $inventario)
                  <option value="{{ $inventario->id }}">{{ $inventario->nome }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-xl-6">
            <div class="form-group">
              <label for="horario" class="form-label">Horário<span class="text-danger">*</span></label>
              <input type="hidden" name="horario_key" id="horario_key">
              <select name="horario" required id="horario" class="form-select">
                <option value="">Escolha um inventário</option>
              </select>
            </div>
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
              <label for="descricao" class="form-label">Detalhes Adicionais <small
                  class="text-muted">(Opcional)</small></label>
              <input type="text" name="descricao" id="descricao" value="{{ @old('descricao') }}" class="form-control">
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

  <script>
    $(document).ready(function() {
      let today = new Date();
      let weekday = today.getDay();
      let inventarios = $("input[name='inventarios']").val()
      let inventario = $('#inventario')
      let formato = $('#formato')
      let horario = $('#horario')
      let horario_key = $('#horario_key')
      inventarios = JSON.parse(inventarios)

      console.log(inventarios)

      $(horario).change(function() {
        let horarioEscolhido = $(this).find('option:selected');

        let semana = $(horarioEscolhido).data('semana')
        let inicio = $(horarioEscolhido).data('inicio')
        let fim = $(horarioEscolhido).data('fim')

        let result = [{
          dia_semana_key: semana,
          horario_inicio: inicio,
          horario_fim: fim
        }]

        $(horario_key).val(JSON.stringify(result))
      })

      $(inventario).change(function() {
        let inventario_id = $(this).val()

        let newInventarios = inventarios.filter((i) => {
          return i.id == inventario_id
        })

        $(formato).html('')
        $(horario).html(`<option value="">Escolha um horário</option>`)

        newInventarios.forEach((i) => {
          let fOption = `<option value="${i.formato}">${i.formato}</option>`;
          $(formato).append(fOption)

          let horarios = Object.values(i.horarios)

          horarios.forEach((e) => {
            let firstElement = Object.values(e)[0];
            if (firstElement.dia_semana_key == weekday) {
              return false
            }

            $(horario).append(`<optgroup label="${firstElement.dia_semana}">`)

            let newE = Object.values(e)
            newE.forEach((j) => {
              if (j.dia_semana_key == weekday) {
                return false
              }

              let h = `${j.dia_semana}, das ${j.horario_inicio} às ${j.horario_fim}`
              let jOption =
                `<option data-semana="${j.dia_semana_key}" data-inicio="${j.horario_inicio}" data-fim="${j.horario_fim}" value="${h}">${h}</option>`;
              $(horario).append(jOption)
            })

            $(horario).append(`</optgroup>`)
          })
        })
      })
    })
  </script>

@endsection
