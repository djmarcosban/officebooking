<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')

<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<div class="modal modal-center fade" id="modalTop" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Fechar</button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  $('.valor_formatado').on('keypress', function(e) {
    let charCode = e.which ? e.which : e.keyCode;

    if (charCode !== 44 && charCode !== 46 && (charCode < 48 || charCode > 57)) {
      e.preventDefault();
    }
  });

  $('.valor_formatado').on('change', function() {
    let value = $(this).val();

    value = value.replace(/[^\d,]/g, '');

    let numericValue = parseFloat(value.replace(',', '.'));

    if (!isNaN(numericValue)) {
      let formattedValue = numericValue.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      $(this).val(formattedValue);
    }
  });
});
</script>

<script tyle="text/javascript">
  $('#modalTop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var title = button.data('title')
    var type = button.data('type')
    var width = button.data('width')
    var instruction = button.data('instruction')

    var modal = $(this)
    modal.find('.modal-title').text(title)
    modal.find('.modal-dialog').addClass(width)

    if(type == 'html'){
      modal.find('.modal-body').html(instruction)
    }else{
      modal.find('.modal-body').text(instruction)
    }
  })
</script>

@stack('pricing-script')
@yield('page-script')
