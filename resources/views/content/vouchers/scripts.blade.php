<script>
let valor_reserva = $('#valor_reserva')
let valor_restante = $('#valor_restante')
let valor_desconto = $('#valor_desconto')
let valor_total = $('#valor_total')
let valor_subtotal = $('#subtotal')
let list_servicos = $('.list-servicos')
let div_servicos = $('.div-servicos')
let list_clientes = $('.list-clientes')
let div_clientes = $('.div-clientes')

function openDropDown(local) {
  document.querySelector("." + local + "-dropdown").classList.add("d-block");
}

function closeDropDown(){
  let dropDowns = $('body').find(".select-dropdown-content")

  dropDowns.each((item, value) => {
    $(value).removeClass('d-block')
  })
}

function filterDropDown(local) {
  if(!$("." + local + "-dropdown").hasClass('d-block')){
    openDropDown(local)
  }

  var input, filter, ul, li, a, i;
  input = document.getElementById("filter_" + local);
  filter = input.value.toUpperCase();

  if(input.value.length === 0){
    closeDropDown()
  }

  div = document.querySelector("." + local + "-dropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function atualizaItemServico(uniqueId, posicao, value) {
  index = servicos.findIndex(item => item.uniqueId == uniqueId);
  servicos[index][posicao] = value

  atualizaInputEArray(servicos, null, "#servicos")
  closeDropDown()
}

function atualizaItemCliente(uniqueId, posicao, value) {
  index = clientes.findIndex(item => item.uniqueId == uniqueId);
  clientes[index][posicao] = value

  atualizaInputEArray(clientes, null, "#cliente")
  closeDropDown()
}

function atualizaValoresInput(input, value) {
  $(input).val(value)
}

function atualizaValoresTotais() {
  let subtotal = parseFloat($(valor_subtotal).val().replace(/\./g, '').replace(/,/g, '.'));
  let desconto = parseFloat($(valor_desconto).val().replace(/\./g, '').replace(/,/g, '.'));
  let restante = parseFloat($(valor_restante).val().replace(/\./g, '').replace(/,/g, '.'));
  let reserva = parseFloat($(valor_reserva).val().replace(/\./g, '').replace(/,/g, '.'));

  if(!reserva){
    reserva = 0
  }

  if(!desconto){
    desconto = 0
  }

  resultado = ((subtotal - reserva) - desconto).toLocaleString('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  resultado_total = (subtotal - desconto).toLocaleString('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  // console.log('subtotal', subtotal)
  // console.log('restante', restante)
  // console.log('reserva', reserva)
  // console.log('desconto', desconto)
  // console.log('resultado', resultado)
  // console.log('resultado_total', resultado_total)

  $(valor_total).val(resultado_total)
  $(valor_restante).val(resultado)
}

function atualizaInputEArray(array, value = null, inputId) {
  if(value) {
    array.push(value)
  }

  atualizaValoresInput(inputId, JSON.stringify(array))
}

function adicionaServico(value) {
  let servico = {
    id: value.id,
    uniqueId: Math.floor(Math.random() * 999),
    nome: value.nome,
    apelido: value.apelido,
    valor: value.valor,
    tipo: value.tipo,
    subtipo: 'nenhum',
    data: '',
    horario: '',
    origem: '',
    destino: '',
  }

  let exists = servicos.filter(item => {
    return item.id == value.id
  })

  // if(exists.length == 0){
    atualizaInputEArray(servicos, servico, '#servicos')
    adicionaServicoDOM(servico)
    incrementaSubtotal()
  // }else{
  //   alert('Esse serviço já foi inserido no Voucher')
  // }
}

function adicionaCliente(value) {
  let cliente = {
    id: value.id,
    uniqueId: Math.floor(Math.random() * 999),
    nome: value.nome,
    numero_voo: value.numero_voo,
    acompanhantes: value.acompanhantes,
  }

  let exists = clientes.filter(item => {
    return item.id == value.id
  })

  if(exists.length == 0){
    atualizaInputEArray(clientes, cliente, '#cliente')
    adicionaClienteDOM(cliente)

    if($('#modalClientes').hasClass('show'))
    {
      closeModal("modalClientes")
    }

    $('#btn-add-customer').addClass('d-none')
  }else{
    alert('Esse cliente já foi inserido no Voucher')
  }
}

function closeModal(modal) {
  $('#' + modal).modal('toggle');
}

document
  .getElementById('modalServicos')
  .addEventListener('hidden.bs.modal', function (event) {
  closeDropDown()
})

document
  .getElementById('modalClientes')
  .addEventListener('hidden.bs.modal', function (event) {
  closeDropDown()
})

function incrementaSubtotal() {
  let soma = 0

  servicos.map((servico) => {
    soma += parseFloat(servico.valor.replace(',', '.'));
  })

  let resultado = soma.toLocaleString('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  $(valor_subtotal).val(resultado);
  $(valor_restante).val(resultado)
  $(valor_total).val(resultado)

  atualizaValoresTotais()
}

function removeServico(uniqueId) {
  servicosFiltrados = servicos.filter((servico) => {
    return servico.uniqueId != uniqueId
  })

  servicos = servicosFiltrados

  $('#servicos').val(JSON.stringify(servicos))
  $('#servico_' + uniqueId).remove()
  incrementaSubtotal()

  if(servicos.length == 0){
    $(div_servicos).addClass('d-none')
  }
}

function removeCliente(uniqueId) {
  clientesFiltrados = clientes.filter((cliente) => {
    return cliente.uniqueId != uniqueId
  })

  clientes = clientesFiltrados

  $('#cliente_' + uniqueId).remove()
  $('#cliente').val(JSON.stringify(clientes))

  if(clientes.length == 0) {
    $('#btn-add-customer').removeClass('d-none')
    $(div_clientes).addClass('d-none')
  }
}

function adicionaClienteDOM(cliente) {
  if($(div_clientes).hasClass('d-none')){
    $(div_clientes).removeClass('d-none')
  }

  let randomIdOrigem = Math.floor(Math.random() * 999)
  let randomIdDestino = Math.floor(Math.random() * 999)

  $(list_clientes).append(`
    <li class="list-group-item rounded border-top" id="cliente_${cliente.uniqueId}">
      <div class="fw-bold d-flex align-itens-center">

        <button onclick="removeCliente(${cliente.uniqueId})" class="btn btn-transparent p-0 me-2">
          <i class="bx bx-trash"></i>
        </button>

        ${cliente.nome}
      </div>
      <hr>

      <div class="row">
        <div class="col-6 col-xl-2">
          <label class="form-label">Nº do voo:</label>
          <input type="text" value="${cliente.numero_voo != null ? cliente.numero_voo : ''}" onchange="atualizaItemCliente(${cliente.uniqueId}, 'numero_voo', this.value)" name="numero_voo" id="numero_voo_${cliente.uniqueId}" class="form-control" />
        </div>
        <div class="col-6 col-xl-10">
          <label class="form-label">Acompanhantes: <small>(separados por vírgula)</small></label>
          <textarea rows="4" onchange="atualizaItemCliente(${cliente.uniqueId}, 'acompanhantes', this.value)" name="acompanhantes" id="acompanhantes_${cliente.uniqueId}" class="form-control">${cliente.acompanhantes}</textarea>
        </div>
      </div>
    </li>
  `)
}

function adicionaServicoDOM(servico) {
  if($(div_servicos).hasClass('d-none')){
    $(div_servicos).removeClass('d-none')
  }

  let randomIdOrigem = Math.floor(Math.random() * 999)
  let randomIdDestino = Math.floor(Math.random() * 999)

  $(list_servicos).append(`
    <li class="list-group-item rounded border-top" id="servico_${servico.uniqueId}">
      <div class="fw-bold d-flex align-itens-center">
        <button onclick="removeServico(${servico.uniqueId})" class="btn btn-transparent p-0 me-2">
          <i class="bx bx-trash"></i>
        </button>
        ${servico.nome} <span class="badge badge-success">R$ ${servico.valor}</span>
      </div>
      <hr>

      <div class="row">
        <div class="col-6 col-xl-2">
          <label class="form-label">Quando:</label>
          <input type="date" required onchange="atualizaItemServico(${servico.uniqueId}, 'data', this.value)" name="data" id="data_${servico.uniqueId}" class="form-control" />
        </div>
        <div class="col-6 col-xl-2">
          <label class="form-label">Horário:</label>
          <input type="time" ${servico.tipo == 'passeio' ? '' : 'required'} onchange="atualizaItemServico(${servico.uniqueId}, 'horario', this.value)" name="horario" id="horario_${servico.uniqueId}" class="form-control" />
        </div>

        <div class="col-6 col-xl-2">
          <div class="form-group">
            <label for="subtipo" class="form-label">Tipo:</label>
            <select name="subtipo" onchange="atualizaItemServico(${servico.uniqueId}, 'subtipo', this.value)" id="subtipo" class="form-select">
              <option ${servico.subtipo == 'nenhum' ? 'selected' : ''} value="nenhum">Nenhum</option>
              <option ${servico.subtipo == 'ida' ? 'selected' : ''} value="ida">Ida</option>
              <option ${servico.subtipo == 'volta' ? 'selected' : ''} value="volta">Volta</option>
            </select>
          </div>
        </div>

        <div class="col-6 col-xl-3">
          <div class="form-group">
            <label for="filter_origens-destinos-${randomIdOrigem}" class="form-label">Embarque:</label>
            <input type="text" required onclick="openDropDown('origens-destinos-${randomIdOrigem}')" class="form-control" name="filter_origens-destinos-${randomIdOrigem}" id="filter_origens-destinos-${randomIdOrigem}" onkeyup="filterDropDown('origens-destinos-${randomIdOrigem}')" />
          </div>
          <div id="select-dropdown-content" class="select-dropdown-content origens-destinos-${randomIdOrigem}-dropdown">
            <div id="select-dropdown-query" class="origens-destinos-${randomIdOrigem}-dropdown-query"></div>
          </div>
        </div>

        <div class="col-6 col-xl-3 ${servico.tipo == 'passeio' ? 'd-none' : ''}">
          <div class="form-group">
            <label for="filter_origens-destinos-${randomIdDestino}" class="form-label">Desembarque:</label>
            <input type="text" ${servico.tipo == 'passeio' ? '' : 'required'} onclick="openDropDown('origens-destinos-${randomIdDestino}')" class="form-control" name="filter_origens-destinos-${randomIdDestino}" id="filter_origens-destinos-${randomIdDestino}" onkeyup="filterDropDown('origens-destinos-${randomIdDestino}')" />
          </div>
          <div id="select-dropdown-content" class="select-dropdown-content origens-destinos-${randomIdDestino}-dropdown">
            <div id="select-dropdown-query" class="origens-destinos-${randomIdDestino}-dropdown-query"></div>
          </div>
        </div>

      </div>
    </li>
  `)

  $(".origens-destinos-" + randomIdOrigem + "-dropdown-query").append(`<a href='javascript:criarNovo("origem", ${randomIdOrigem}, ${servico.uniqueId})'>+ Criar novo</a>`)
  $(".origens-destinos-" + randomIdDestino + "-dropdown-query").append(`<a href='javascript:criarNovo("destino", ${randomIdDestino}, ${servico.uniqueId})'>+ Criar novo</a>`)

  for(const origem_destino_js in origens_destinos_js){
    let origem_destino = origens_destinos_js[origem_destino_js]

    $(".origens-destinos-" + randomIdOrigem + "-dropdown-query").append(`<a href="javascript:closeDropDown();atualizaValoresInput('#filter_origens-destinos-${randomIdOrigem}', '${origem_destino.nome}'); atualizaItemServico(${servico.uniqueId}, 'origem', '${origem_destino.nome}')">${origem_destino.nome}</a>`)
    $(".origens-destinos-" + randomIdDestino + "-dropdown-query").append(`<a href="javascript:closeDropDown();atualizaValoresInput('#filter_origens-destinos-${randomIdDestino}', '${origem_destino.nome}'); atualizaItemServico(${servico.uniqueId}, 'destino', '${origem_destino.nome}')">${origem_destino.nome}</a>`)
  }
}

function criarNovo(tipo, randomId, servicoId) {
  // tipo: servico, cliente, origem, destino
  closeDropDown()

  let modal = $('#modalLocais')
  $(modal).modal('show');
  $(modal).find("#local-tipo").val(tipo)
  $(modal).find("#local-randomId").val(randomId)
  $(modal).find("#local-servicoId").val(servicoId)
}

function handleCriarNovo(modal) {
  $(modal).modal('hide');

  let tipo = $(modal).find("#local-tipo").val()
  let randomId = $(modal).find("#local-randomId").val()
  let servicoId = $(modal).find("#local-servicoId").val()
  let nome = $(modal).find("#local-nome").val()

  $(modal).find("#local-tipo").val("")
  $(modal).find("#local-randomId").val("")
  $(modal).find("#local-servicoId").val("")
  $(modal).find("#local-nome").val("")

  atualizaValoresInput('#filter_origens-destinos-' + randomId, nome)
  atualizaItemServico(servicoId, tipo, nome)
  adicionaLocalDB({nome: nome})
  buscaLocalDB();

}

function adicionaLocalDB(data) {
  $.ajax({
    url: '/origem/adicionar',
    method: 'POST',
    data: {
      nome: data.nome,
      origemReq: 'ajax',
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      if(response.status == 'success') {
        return false;
      }

      alert('Não foi possivel criar um novo Local. Salve o voucher e adicione um Local manualmente.')
    },
    error: function(error) {
      console.error(error)
    }
  });
}

function buscaLocalDB() {
  $.ajax({
    url: '/origens',
    method: 'GET',
    data: {
      origemReq: 'ajax',
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      services_js = response.data.data

      for(const service_js in services_js){
        let servico = services_js[service_js]

        $(".services-dropdown-query").append(`<a href='javascript:adicionaServico(${JSON.stringify(servico)})'>${servico.nome}</a>`)
      }
    },
    error: function(error) {
      console.error(error)
    }
  });
}

$(document).ready(function() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const cliente_id = urlParams.get('cliente_id')
  const servico_id = urlParams.get('servico_id')

  if(cliente_id && cliente_id.length > 0)
  {
    let currentCliente = clientes_js.filter(cliente => {
      return cliente.id == cliente_id
    })

    if(clientes[0] && clientes[0].id != currentCliente[0].id){
      removeCliente(clientes[0].uniqueId)
    }

    adicionaCliente((currentCliente[0]))
  }

  if(servico_id && servico_id.length > 0)
  {
    let currentServico = services_js.filter(servico => {
      return servico.id == servico_id
    })

    adicionaServico((currentServico[0]))
  }

  $(valor_reserva).change(function() {
    atualizaValoresTotais()
  })

  $(valor_desconto).change(function() {
    atualizaValoresTotais()
  })

  for(const service_js in services_js){
    let servico = services_js[service_js]

    $(".services-dropdown-query").append(`<a href='javascript:adicionaServico(${JSON.stringify(servico)})'>${servico.nome}</a>`)
  }

  for(const cliente_js in clientes_js){
    let cliente = clientes_js[cliente_js]

    $(".clientes-dropdown-query").append(`<a href='javascript:adicionaCliente(${JSON.stringify(cliente)})'>${cliente.nome}</a>`)
  }

  // $('#voucherForm').submit(function(e) {
  //   if(servicos.length == 0 || clientes.length == 0) {
  //     alert('É necessário inserir clientes e serviços para criar um Voucher')
  //     e.preventDefault()
  //     return false
  //   }
  // })
})
</script>
