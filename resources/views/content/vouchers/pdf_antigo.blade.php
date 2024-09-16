@php
  use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>UP JERI</title>
<style>
  @page {
    size: auto;
    header: page-header;
    footer: page-footer;
    margin-header: 15px;
    margin-footer: 15px;
    margin: 135px 35px 0px 35px;
  }

  #footer{
    border-top: 2px solid #00696e;
  }

  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  body { font-family: 'sans-serif'; line-height: 1.4rem; }
  .page-break-before { page-break-before: always; }

  .fs-1 { font-size: 1.4625rem !important; }
  .fs-2 { font-size: 1.325rem !important; }
  .fs-3 { font-size: 1.2875rem !important; }
  .fs-4 { font-size: 1.2625rem !important; }
  .fs-5 { font-size: 1.125rem !important; }
  .fs-6 { font-size: 1rem !important; }

  .p-1 { padding: 0.25rem !important; }
  .p-2 { padding: 0.5rem !important; }
  .p-3 { padding: 1rem !important; }
  .p-4 { padding: 1.5rem !important; }
  .p-5 { padding: 3rem !important; }

  .px-0 { padding-right: 0 !important; padding-left: 0 !important; }
  .px-1 { padding-right: 0.25rem !important; padding-left: 0.25rem !important; }
  .px-2 { padding-right: 0.5rem !important; padding-left: 0.5rem !important; }
  .px-3 { padding-right: 1rem !important; padding-left: 1rem !important; }
  .px-4 { padding-right: 1.5rem !important; padding-left: 1.5rem !important; }
  .px-5 { padding-right: 3rem !important; padding-left: 3rem !important; }
  .py-0 { padding-top: 0 !important; padding-bottom: 0 !important; }
  .py-1 { padding-top: 0.25rem !important; padding-bottom: 0.25rem !important; }
  .py-2 { padding-top: 0.5rem !important; padding-bottom: 0.5rem !important; }
  .py-3 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
  .py-4 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
  .py-5 { padding-top: 3rem !important; padding-bottom: 3rem !important; }

  .m-0 { margin: 0 !important; }
  .m-1 { margin: 0.25rem !important; }
  .m-2 { margin: 0.5rem !important; }
  .m-3 { margin: 1rem !important; }
  .m-4 { margin: 1.5rem !important; }
  .m-5 { margin: 3rem !important; }
  .m-auto { margin: auto !important; }
  .mx-0 { margin-right: 0 !important; margin-left: 0 !important; }
  .mx-1 { margin-right: 0.25rem !important; margin-left: 0.25rem !important; }
  .mx-2 { margin-right: 0.5rem !important; margin-left: 0.5rem !important; }
  .mx-3 { margin-right: 1rem !important; margin-left: 1rem !important; }
  .mx-4 { margin-right: 1.5rem !important; margin-left: 1.5rem !important; }
  .mx-5 { margin-right: 3rem !important; margin-left: 3rem !important; }
  .mx-auto { margin-right: auto !important; margin-left: auto !important; }
  .my-0 { margin-top: 0 !important; margin-bottom: 0 !important; }
  .my-1 { margin-top: 0.25rem !important; margin-bottom: 0.25rem !important; }
  .my-2 { margin-top: 0.5rem !important; margin-bottom: 0.5rem !important; }
  .my-3 { margin-top: 1rem !important; margin-bottom: 1rem !important; }
  .my-4 { margin-top: 1.5rem !important; margin-bottom: 1.5rem !important; }
  .my-5 { margin-top: 3rem !important; margin-bottom: 3rem !important; }
  .my-auto { margin-top: auto !important; margin-bottom: auto !important; }
  .mt-0 { margin-top: 0 !important; }
  .mt-1 { margin-top: 0.25rem !important; }
  .mt-2 { margin-top: 0.5rem !important; }
  .mt-3 { margin-top: 1rem !important; }
  .mt-4 { margin-top: 1.5rem !important; }
  .mt-5 { margin-top: 3rem !important; }
  .mt-auto { margin-top: auto !important; }
  .mb-0 { margin-bottom: 0 !important; }
  .mb-1 { margin-bottom: 0.25rem !important; }
  .mb-2 { margin-bottom: 0.5rem !important; }
  .mb-3 { margin-bottom: 1rem !important; }
  .mb-4 { margin-bottom: 1.5rem !important; }
  .mb-5 { margin-bottom: 3rem !important; }
  .mb-auto { margin-bottom: auto !important; }
  .m-n1 { margin: -0.25rem !important; }
  .m-n2 { margin: -0.5rem !important; }
  .m-n3 { margin: -1rem !important; }
  .m-n4 { margin: -1.5rem !important; }
  .m-n5 { margin: -3rem !important; }
  .mx-n1 { margin-right: -0.25rem !important; margin-left: -0.25rem !important; }
  .mx-n2 { margin-right: -0.5rem !important; margin-left: -0.5rem !important; }
  .mx-n3 { margin-right: -1rem !important; margin-left: -1rem !important; }
  .mx-n4 { margin-right: -1.5rem !important; margin-left: -1.5rem !important; }
  .mx-n5 { margin-right: -3rem !important; margin-left: -3rem !important; }
  .my-n1 { margin-top: -0.25rem !important; margin-bottom: -0.25rem !important;}
  .my-n2 { margin-top: -0.5rem !important; margin-bottom: -0.5rem !important;}
  .my-n3 { margin-top: -1rem !important; margin-bottom: -1rem !important;}
  .my-n4 { margin-top: -1.5rem !important; margin-bottom: -1.5rem !important;}
  .my-n5 { margin-top: -3rem !important; margin-bottom: -3rem !important;}
  .mt-n1 { margin-top: -0.25rem !important; }
  .mt-n2 { margin-top: -0.5rem !important; }
  .mt-n3 { margin-top: -1rem !important; }
  .mt-n4 { margin-top: -1.5rem !important; }
  .mt-n5 { margin-top: -3rem !important; }
  .mb-n1 { margin-bottom: -0.25rem !important; }
  .mb-n2 { margin-bottom: -0.5rem !important; }
  .mb-n3 { margin-bottom: -1rem !important; }
  .mb-n4 { margin-bottom: -1.5rem !important; }
  .mb-n5 { margin-bottom: -3rem !important; }

  .rounded { border-radius: 0.375rem !important; }
  .rounded-0 { border-radius: 0 !important; }
  .rounded-1 { border-radius: 0.25rem !important; }
  .rounded-2 { border-radius: 0.375rem !important; }
  .rounded-3 { border-radius: 0.5rem !important; }
  .rounded-circle { border-radius: 50% !important; }
  .rounded-pill { border-radius: 50rem !important; }
  .rounded-top { border-top-left-radius: 0.375rem !important; border-top-right-radius: 0.375rem !important; }
  .rounded-bottom { border-bottom-right-radius: 0.375rem !important; border-bottom-left-radius: 0.375rem !important; }

  .border-end { border-right: 1px solid #00656b !important; }
  .border-end-0 { border-right: 0 !important; }
  .border-start { border-left: 1px solid #00656b !important; }
  .border-start-0 { border-left: 0 !important; }
  .rounded-end { border-top-right-radius: 0.375rem !important; border-bottom-right-radius: 0.375rem !important; }
  .rounded-start { border-bottom-left-radius: 0.375rem !important; border-top-left-radius: 0.375rem !important; }
  .rounded-start-top { border-top-left-radius: 0.375rem !important; }
  .rounded-start-bottom { border-bottom-left-radius: 0.375rem !important; }
  .rounded-end-top { border-top-right-radius: 0.375rem !important; }
  .rounded-end-bottom { border-bottom-right-radius: 0.375rem !important; }
  .border-top { border-top: 2px solid #00656b !important; }
  .border-bottom { border-bottom: 2px solid #00656b !important; }

  .fw-bold { font-weight: bold }

  .bg-green { background-color: #00656b }
  .bg-orange { background-color: #ff7639 }

  .text-white { color: #ffffff }
  .text-green { color: #00656b }
  .text-gray { color: #545454 }
  .text-success { color: #469b2f }

  .spacer-10-0 { margin: 10px 0 }
  .spacer-5-0 { margin-bottom: 50px }

  td { vertical-align: bottom; }

  .border { border: 2px solid #00656b!important;}

  .w-100 { width: 100%!important; }
  .w-50 { width: 50%!important; }
  .w-75 { width: 75%!important; }
  .w-46 { width: 46%!important; }
  .w-48 { width: 48%!important; }
  .w-49 { width: 48.60%!important; }

  .left { float: left; }
  .right { float: right; }

  .text-right { text-align: right }
  .text-left { text-align: left }
  .text-center { text-align: center }

</style>
</head>

<body>
  <htmlpageheader name="page-header">
    <table style="width:100%;">
      <tr>
        <td width="30%" style="vertical-align: middle;">
          <img src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/logo-dark.png')))}}" width="160" />
        </td>
        <td width="43%" style="vertical-align: middle">
          <table class="text-green fs-2">
            <tr>
              <td><span class="fw-bold">CEP:</span></td>
              <td>62595-000</td>
            </tr>
          </table>
          <table class="text-green fs-2">
            <tr>
              <td><span class="fw-bold">CNPJ:</span></td>
              <td>45.081.253/0001-75</td>
            </tr>
          </table>
          <table class="text-green fs-2">
            <tr>
              <td><span class="fw-bold">CONTATO:</span></td>
              <td>(88) 9 9631-0653</td>
            </tr>
          </table>
        </td>
        <td class="text-green fw-bold" style="vertical-align: middle">

          <table class="text-green fw-bold fs-2">
            <tr>
              <td><img style="margin-right: 3px" width="30" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/ig.png')))}}" align="left" /></td>
              <td style="vertical-align: middle">upjeri</td>
            </tr>
          </table>

          <table class="text-green fw-bold fs-2">
            <tr>
              <td><img style="margin-right: 3px" width="30" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/site.png')))}}" align="left" /></td>
              <td style="vertical-align: middle">upjeri.com</td>
            </tr>
          </table>

          <table class="text-green fw-bold fs-2">
            <tr>
              <td><img style="margin-right: 3px" width="30" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/email.png')))}}" align="left" /></td>
              <td style="vertical-align: middle">contato@upjeri.com</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </htmlpageheader>


  <htmlpagefooter name="page-footer">
    <div style="text-align: center; font-size: 12px; color:#333;">Página: {PAGENO}/{nbpg}</div>
    <div id="footer">
      <table style="width:100%;">
        <tr>
          <td>
            <span style="font-size:10px;">Document created at {{date('d/m/Y H:i:s')}}.</span>
          </td>
          <td style="text-align: right">
            <span style="font-size:10px;">Copyright © {{env('APP_NAME')}} {{date('Y')}}. All rights reserved..</span>
          </td>
        </tr>
      </table>
    </div>
  </htmlpagefooter>

  <div class="container bg-orange rounded p-2 mb-3">
    <div class="text-white fs-6 text-center fw-bold">
      APRESENTAR ESSE DOCUMENTO NO LOCAL
    </div>
  </div>

  <div class="container mb-3">
    <div class="left border rounded w-46 p-2">
      <div class="left w-46">
        <span class="text-gray fs-4 fw-bold">
          VOUCHER Nº:
        </span>
      </div>

      <div class="right w-46 text-right">
        <span class="text-green fs-4 fw-bold">
          #{{$voucher->id}}&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
      </div>
    </div>
    <div class="right border rounded w-46 p-2">
      <div class="left w-46">
        <span class="text-gray fs-4 fw-bold">
          EMITIDO:
        </span>
      </div>

      <div class="right w-46 text-right">
        <span class="text-green fs-4 fw-bold">
          {{$voucher->data_criacao}}
        </span>
      </div>
    </div>
  </div>

  <div class="container mb-3">
    <div class="left border rounded w-46 p-2">
      <div class="text-center fw-bold">
        <div class="mb-3 fs-5">
          <span class="text-gray">CLIENTES</span>
        </div>
        <div style="height: 255px">
          <div class="fs-5">{{$voucher->cliente->nome}}</div>
          @foreach ($voucher->cliente->acompanhantes as $acompanhante)
            <div class="fs-5">{{$acompanhante}}</div>
          @endforeach
        </div>
      </div>

      <div class="w-75 m-auto">
        <div class="left w-50">
          <div class="text-gray text-center fs-5 fw-bold">
            NÚMERO DE<br/>
            PASSAGEIROS
          </div>
        </div>

        <div class="right border rounded text-center rounded px-3 py-2 fs-1 text-dark fw-bold" style="width: 50px">
          {{$voucher->cliente->qtd_acompanhantes}}
        </div>
      </div>

    </div>

    <div class="rounded-top border right w-48 mb-3">
      <div class="text-center fw-bold fs-5 p-2 border-bottom">
        <span class="text-gray">DATA DO SERVIÇO</span>
      </div>

      <div>
        <div class="left w-50">
          <div class="text-center fw-bold p-3 border-end">
            <div class="text-gray mb-2 fs-5">IDA</div>
            <div class="text-dark fs-4">
              @php
              $data_ida = '-'
              @endphp
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'ida') {
                  $data_ida = Carbon::parse($servico->data)->format('d/m/Y');
                }
                @endphp
              @endforeach
              {{$data_ida}}
            </div>
          </div>
        </div>

        <div class="right w-50">
          <div class="text-center fw-bold p-3 border-start">
            <div class="text-gray mb-2 fs-5">VOLTA</div>
            <div class="text-dark fs-4">
              @php
              $data_volta = '-'
              @endphp
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'volta') {
                  $data_volta = Carbon::parse($servico->data)->format('d/m/Y');
                }
                @endphp
              @endforeach
              {{$data_volta}}
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="rounded-top border right w-48 mb-3">
      <div class="text-center fw-bold fs-5 p-2 border-bottom">
        <span class="text-gray">HORÁRIO DO SERVIÇO</span>
      </div>

      <div>
        <div class="left w-50">
          <div class="text-center fw-bold p-3 border-end">
            <div class="text-gray mb-2 fs-5">IDA</div>
            <div class="text-dark fs-4">
              @php
              $horario_ida = '-'
              @endphp
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'ida') {
                  $horario_ida = $servico->horario;
                }
                @endphp
              @endforeach
              {{$horario_ida}}
            </div>
          </div>
        </div>

        <div class="right w-50">
          <div class="text-center fw-bold p-3 border-start">
            <div class="text-gray mb-2 fs-5">VOLTA</div>
            <div class="text-dark fs-4">
              @php
              $horario_volta = '-'
              @endphp
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'volta') {
                  $horario_volta = $servico->horario;
                }
                @endphp
              @endforeach
              {{$horario_volta}}
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="right border rounded w-46 px-2 py-3">
      <div class="text-center fw-bold">
        <div class="mb-2 fs-5 text-gray">Nº DO VOO</div>
        <div class="fs-4">{{!empty($voucher->cliente->numero_voo) ? $voucher->cliente->numero_voo : '-'}}</div>
      </div>
    </div>
  </div>

  <div class="container mb-3">
    <div class="rounded border left w-48">
      <div class="text-center fw-bold p-3 border-bottom">
        <span class="text-gray fs-1">IDA</span>
      </div>

        <div class="w-100">
          <div class="text-center fw-bold p-3">
            <div class="text-gray mb-2 fs-5">EMBARQUE</div>
            <div class="text-dark fs-5 mb-4">
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'ida') {
                  echo mb_convert_case($servico->origem, MB_CASE_UPPER, 'UTF-8');
                }
                @endphp
              @endforeach
            </div>
            <div class="text-gray mb-2 fs-5">DESEMBARQUE</div>
            <div class="text-dark fs-5">
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'ida') {
                  echo mb_convert_case($servico->destino, MB_CASE_UPPER, 'UTF-8');
                }
                @endphp
              @endforeach
            </div>
          </div>

      </div>
    </div>

    <div class="rounded border right w-48">
      <div class="text-center fw-bold p-3 border-bottom">
        <span class="text-gray fs-1">VOLTA</span>
      </div>

        <div class="w-100">
          <div class="text-center fw-bold p-3">
            <div class="text-gray mb-2 fs-5">EMBARQUE</div>
            <div class="text-dark fs-5 mb-4">
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'volta') {
                  echo mb_convert_case($servico->origem, MB_CASE_UPPER, 'UTF-8');
                }
                @endphp
              @endforeach
            </div>
            <div class="text-gray mb-2 fs-5">DESEMBARQUE</div>
            <div class="text-dark fs-5">
              @foreach($voucher->servicos as $servico)
                @php
                if($servico->subtipo == 'volta') {
                  echo mb_convert_case($servico->destino, MB_CASE_UPPER, 'UTF-8');
                }
                @endphp
              @endforeach
            </div>
          </div>

      </div>
    </div>
  </div>

  <div class="container mb-3">
    <div class="left border rounded w-46 p-2">
      <div class="text-center fw-bold">
        <div class="mb-3 fs-5">
          <span class="text-gray">SERVIÇOS CONTRATADOS</span>
        </div>
        @foreach ($voucher->servicos as $servico)
          <div class="fs-6">{{mb_convert_case($servico->nome, MB_CASE_UPPER, 'UTF-8');}}</div>
        @endforeach
      </div>
    </div>

    <div class="right w-49">
      <div class="p-2 border rounded mb-2">
        <div class="left w-50">
          <span class="text-gray fs-4 fw-bold">
            VALOR TOTAL:
          </span>
        </div>

        <div class="right text-right">
          <span class="text-green fs-4 fw-bold">
            R$ {{$voucher->valor_total}}
          </span>
        </div>
      </div>

      <div class="p-2 border rounded">
        <div class="left w-50">
          <span class="text-gray fs-4 fw-bold">
            VALOR RESERVA:
          </span>
        </div>

        <div class="right text-right">
          <span class="text-success fs-4 fw-bold">
            R$ {{$voucher->valor_reserva}}
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

      <div class="p-2 border rounded">
        <div class="left w-50">
          <span class="text-gray fs-4 fw-bold">
            VALOR RESTANTE A PAGAR:
          </span>
        </div>

        <div class="right text-right">
          <span class="fs-4 fw-bold">
            R$ {{$voucher->valor_restante}}
          </span>
        </div>
      </div>
  </div>

  <div class="container bg-orange rounded p-2 mt-4">
    <div class="text-white fs-6 text-center fw-bold">
      APRESENTAR ESSE DOCUMENTO NO LOCAL
    </div>
  </div>


</body>
</html>
