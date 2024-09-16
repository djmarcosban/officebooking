<script>
  $("#cep").mask('99999-999')

  function switchError(value = null, isError = false){
    let btn = $("input[type=submit]")
    let error = $('.error')

    if(isError){
      $(btn).attr('disabled', '')
      $(error).removeClass('d-none').html(value)
    }else{
      $(error).addClass('d-none')
      $(btn).removeAttr('disabled')
    }
  }

  $("#cep").blur((e) => {
    let target = e.target
    let value = target.value
    value = value.replace(/\D/g,'')

    if(!value.length || value.length != 8){
      target.classList.add('is-invalid')
      switchError('CEP inválido', true)
      return false
    }

    let logradouro = $('#address')
    let cep = $('#cep')
    let numero = $('#number')
    let cidade = $('#city')
    let complemento = $('#complement')
    let uf = $('#state')
    let bairro = $('#neighborhood')

    $.ajax({
      url: 'https://brasilapi.com.br/api/cep/v1/' + value,
      type: "GET",
      dataType: 'json',
      data: {},
      success: (res) => {
        console.log(res)
        target.classList.remove('is-invalid')
        target.classList.add('is-valid')

        $(logradouro)
          .val(res.street)
          .addClass('is-valid')
          .removeClass('is-invalid')

        $(cep)
          .val(res.cep)
          .addClass('is-valid')
          .removeClass('is-invalid')

        $(cidade)
          .val(res.city)
          .addClass('is-valid')
          .removeClass('is-invalid')

        $(uf)
          .val(res.state)
          .addClass('is-valid')
          .removeClass('is-invalid')

        $(bairro)
          .val(res.neighborhood)
          .addClass('is-valid')
          .removeClass('is-invalid')


        switchError('', false)

      },
      error: (res) => {
        target.classList.add('is-invalid')

        $(logradouro)
          .val('')
          .addClass('is-invalid')

        $(cep)
          .val('')
          .addClass('is-invalid')

        $(numero)
          .val('')
          .addClass('is-invalid')

        $(cidade)
          .val('')
          .addClass('is-invalid')

        $(complemento)
          .val('')
          .addClass('is-invalid')

        $(uf)
          .val('')
          .addClass('is-invalid')

        $(bairro)
          .val('')
          .addClass('is-invalid')

        switchError(res.responseJSON.message, true)

      }
    })
  })
</script>
