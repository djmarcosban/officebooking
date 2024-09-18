<script>
  var colSubmit = $('#col_btn_submit');
  $('#submit').submit(function(e){
    e.preventDefault()
    enviarParaServidor()
    $(colSubmit).html('<div class="spinner-border mt-1 text-light" role="status"></div>')
  })

  var horariosAdicionados = {};
  var diasAdicionados = [];

  function adicionarDiaSemana() {
    let lista = $('.lista')
    const listaHorarios = document.getElementById('listaHorarios');

    let diaSemana = $('#diaSemana').val();
    let horarioInicio = $('#horarioInicio').val();
    let horarioFim = $('#horarioFim').val();

    if(horarioInicio == horarioFim){
      alert('Os horários não podem ser iguais');
      return false
    }

    diasAdicionados.push(diaSemana)

    if (!horariosAdicionados[diaSemana]) {
      horariosAdicionados[diaSemana] = [];
    }

    horariosAdicionados[diaSemana].push({
      dia: diaSemana,
      inicio: horarioInicio,
      fim: horarioFim
    });

    const novoItem = document.createElement('li');
    $(novoItem).html(`<b>${getNomeDiaSemana(diaSemana)}</b>: das ${horarioInicio} às ${horarioFim}`);

    listaHorarios.append(novoItem);
    lista.removeClass('d-none')
  }

  function getNomeDiaSemana(dia) {
      const diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
      return diasSemana[dia];
  }

  function enviarParaServidor() {
    let nome = $('#nome').val()
    let cap_max = $('#cap_max').val()
    let marca = $('#marca').val()
    let inventario_id = $('#inventario_id').val()
    let acao = $('#acao').val()
    let descricao = $('#descricao').val()

    let uri = '/inventario/adicionar'
    let type = 'POST'

    if(acao == 'editar')
    {
      type = 'PUT'
      uri = '/inventario/' + inventario_id + '/editar'
    }

    let diasAdicionadosUnificados = diasAdicionados.filter((value, index, self) => {
      return self.indexOf(value) === index;
    });

    $.ajax({
      type: type,
      url: uri,
      data: {
        _token: $('input[name="_token"]').val(),
        nome: nome,
        inventario_id: inventario_id,
        cap_max: cap_max,
        marca: marca,
        descricao: descricao,
        horarios: horariosAdicionados,
        dias: diasAdicionadosUnificados
      },
      success: function(response) {
        if(response == 'hours_empty'){
          alert('Erro na hora de atualizar a agenda. Adicione os horários corretamente.');
          return false;
        }

        if(response == 'success')
        {
          location.href = '/inventarios?status=success'
          return false
        }else{
          alert('Houve um erro ao tentar realizar essa ação. Comunique o administrador.');
          return false;
        }
      },
      error: function(error) {
        alert(error.responseJSON.message)
      }
    });
  }
</script>
