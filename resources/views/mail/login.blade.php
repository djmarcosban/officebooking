<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
  <style>
    @media only screen and (max-width: 600px) {
      .inner-body {
        width: 100% !important;
      }

      .footer {
        width: 100% !important;
      }
    }

    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>
  @include('mail.styles')
</head>

<body>

  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center">
        <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <tr>
            <td class="header">
              <a href="{{ url('/') }}" class="logo">
                @include('_partials.macros', ['color' => 'white'])
              </a>
            </td>
          </tr>

          <!-- Email Body -->
          <tr>
            <td class="body" width="100%" cellpadding="0" cellspacing="0">
              <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    <h1>{{ $data['subject'] }}</h1>

                    <p>Detectamos que sua conta foi acessada recentemente.
                    </p>
                    <p>Caso não tenha sido você que realizou este login, sugerimos efetuar a troca de sua senha o mais
                      breve possível em sua conta Office Booking.</p>
                    <p>Este email é um aviso automático e não respondemos mensagens por aqui.</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td class="footer" style="text-align:center;">
              <br>
              <br>
              <p>Este e-mail foi enviado para <a href="mailto:{{ $data['to'] }}" target="_blank">{{ $data['to'] }}</a>
                porque foi feito o login de um novo dispositivo na sua conta Office Booking.</p>
            </td>
          </tr>

          <tr>
            <td>
              <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td class="content-cell" align="center">
                    © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>