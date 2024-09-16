<div class="modal modal-center fade" id="modalClientes" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body py-2">

        <div>
          <div class="form-group">
            <label for="filter_clientes" class="form-label">Digite para filtrar:</label>
            <input type="text" onclick="openDropDown('clientes')" class="form-control" name="filter_clientes" id="filter_clientes" onkeyup="filterDropDown('clientes')">
          </div>
          <div id="select-dropdown-content" class="select-dropdown-content clientes-dropdown">
            <div id="select-dropdown-query" class="clientes-dropdown-query"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button onclick="location.href='/cliente/adicionar?return_url={{base64_encode(url()->full())}}'" type="button" class="btn btn-outline-primary btn-sm">+ Criar novo</button>
      </div>
    </form>
  </div>
</div>

<div class="modal modal-center fade" id="modalServicos" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body py-2">

        <div>
          <div class="form-group">
            <label for="filter_services" class="form-label">Digite para filtrar:</label>
            <input type="text" onclick="openDropDown('services')" class="form-control" name="filter_services" id="filter_services" onkeyup="filterDropDown('services')">
          </div>
          <div id="select-dropdown-content" class="select-dropdown-content services-dropdown">
            <div id="select-dropdown-query" class="services-dropdown-query"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button onclick="location.href='/servico/adicionar?return_url={{base64_encode(url()->full())}}'" type="button" class="btn btn-outline-primary btn-sm">+ Criar novo</button>
      </div>
    </form>
  </div>
</div>

<div class="modal modal-center fade" id="modalLocais" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar novo Local</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body py-2">

        <input type="hidden" name="local-tipo" id="local-tipo" />
        <input type="hidden" name="local-randomId" id="local-randomId" />
        <input type="hidden" name="local-servicoId" id="local-servicoId" />

        <div class="form-group">
          <label for="local-nome" class="form-label">Nome<span class="text-danger">*</span></label>
          <input type="text" name="local-nome" id="local-nome" class="form-control" required />
        </div>

      </div>
      <div class="modal-footer">
        <button onclick="$('#modalLocais').modal('hide')" type="button" class="btn btn-outline-secondary btn-sm me-4">Cancelar</button>
        <button onclick="handleCriarNovo('#modalLocais')" type="button" class="btn btn-primary btn-sm">Adicionar</button>
      </div>
    </form>
  </div>
</div>


<script>

</script>
