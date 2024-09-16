<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css?v=').time() }}" />
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />
  <meta name="author" content="Marcos Felipe" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Trivia Viagens">
  <meta name="copyright" content="© 2024 M2 Tecnhology" />
  <meta name="robots" content="none">

  <link href="{{ asset('assets/img/gsa_ios_60dp.png') }}" rel="apple-touch-icon" sizes="180x180">
  <link href="{{ asset('assets/img/gsa_ios_60dp_120.png') }}" rel="apple-touch-icon" sizes="120x120">
  <link href="{{ asset('assets/img/gsa_ios_57dp.png') }}" rel="apple-touch-icon" sizes="114x114">
  <link href="{{ asset('assets/img/gsa_ios_57dp_small.png') }}" rel="apple-touch-icon">
  <meta content="{{ asset('assets/img/logo-128dp.png') }}" itemprop="image">
  <title>Trivia Viagens</title>
</head>
<body>
  <div class="top-bar fw-semibold d-flex align-items-center justify-content-center">
    Trivia Viagens
  </div>
  @if($bairro != null)
    <div style="max-width: fit-content;" class="mx-auto shadow-lg fw-semibold bg-white px-5 py-2 text-uppercase text-center rounded-bottom">{{$bairro->nome}}</div>
  @endif

  <div class="container mt-4">
    <div class="row align-items-center">
      <div class="col-12 col-xl-5 mx-auto mb-5">
        @if($bairro->enquete == null || $bairro->enquete->status == 0)
          <p class="text-center bg-white p-4 rounded mt-4 shadow-lg">Não há uma enquete vinculada a esse bairro ainda. Por favor, tente novamente mais tarde.</p>
        @else
          <p class="text-center fw-semibold">Responda a enquete abaixo:</p>
          <div class="card p-2 border-0 shadow-lg">
            <div class="card-body">
              <form action="" method="POST" id="form_votar">
                @csrf

                <input type="hidden" name="bairro_id" value="{{$bairro->id}}">
                <input type="hidden" name="enquete_id" value="{{$bairro->enquete->id}}">
                <input type="hidden" name="fingerprint" value="" id="fingerprint">

                @foreach ($bairro->enquete->questoes as $questao)
                  <div class="form-group mb-4">
                    <label class="form-label fw-bold mb-1" for="question_{{$questao->id}}">
                      {{$questao->pergunta}}
                    </label>
                    @if($questao->tipo == 'text')
                      <input type="text" required name="respostas[{{$questao->id}}]" class="form-control" />
                    @elseif($questao->tipo == 'multiple_choice')
                      <div class="checkbox-group required">
                        @foreach($questao->alternativas as $key => $alternativa)
                          <div class="my-1">
                            <label for="input_question_{{$questao->id}}_{{$key}}" class="text-black">
                              <input type="checkbox" name="respostas[{{$questao->id}}][]" value="{{$alternativa}}" id="input_question_{{$questao->id}}_{{$key}}" />
                              {{$alternativa}}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    @else
                      @foreach($questao->alternativas as $key => $alternativa)
                        <div class="my-1">
                          <label for="input_question_{{$questao->id}}_{{$key}}" class="text-black">
                            <input type="radio" required name="respostas[{{$questao->id}}]" value="{{$alternativa}}" id="input_question_{{$questao->id}}_{{$key}}" />
                            {{$alternativa}}
                          </label>
                        </div>
                      @endforeach
                    @endif
                  </div>
                @endforeach

                <input type="submit" class="btn btn-primary bg-primary py-2 w-100 fw-semibold" value="Responder Enquente">
              </form>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    $('form').submit(function( event ) {
      let checkbox = $('div.checkbox-group.required')
      let checkboxChecked = $('div.checkbox-group.required :checkbox:checked')

      console.log(checkbox)

      if(checkbox.length > 0 && checkboxChecked.length == 0){
        alert('Escolha pela menos 1 opção.')
        event.preventDefault();
      }
    })
  </script>
  <script>
    (async () => {
      const fp = await FingerprintJS.load();
      const result = await fp.get();
      document.getElementById('fingerprint').value = result.visitorId;
    })();
</script>
</body>
</html>