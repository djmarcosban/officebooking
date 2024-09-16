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
  <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
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

  <div class="container mt-5">
    <div class="row align-items-center">
      <div class="col-12 col-xl-5 mx-auto mb-5">
        <div class="card p-2 border-0 shadow-lg">
          <div class="card-body">
            <form action="" id="seleciona_bairro" method="POST">
                <div class="form-group mb-4">
                  <label class="form-label fw-semibold mb-2" for="bairro">
                    Qual o seu bairro?
                  </label>
                  <select name="bairro" id="bairro" required class="form-select">
                    <option value="">Escolha uma opção</option>
                    @foreach ($bairros as $bairro)
                      <option value="{{$bairro->id}}">{{$bairro->nome}}</option>
                    @endforeach
                  </select>
                </div>
              <input type="submit" class="btn btn-primary bg-primary py-2 w-100 fw-semibold" value="Continuar">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  $('#seleciona_bairro').submit(function(e){
    e.preventDefault();

    let bairro = $('#bairro').val()
    location.href = "{{url('/bairro')}}/" + bairro + "/votar"
  })
  </script>
</body>
</html>