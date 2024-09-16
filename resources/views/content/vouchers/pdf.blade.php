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
    margin-header: 0px;
    margin-footer: 15px;
    margin: 110px 35px 50px 35px;
    border: 2px solid black;
  }

  #footer{
    padding-top: 4px
  }

  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  p { margin: 0; margin-bottom: 15px }
  p.fw-bold { margin-top: 20px }

  div { vertical-align: middle }

  body { font-family: 'sans-serif'; line-height: 1.3rem; }
  .page-break-before { page-break-before: always; }

  .fs-1 { font-size: 1.4625rem !important; }
  .fs-2 { font-size: 1.325rem !important; }
  .fs-3 { font-size: 1.2875rem !important; }
  .fs-4 { font-size: 1.2625rem !important; }
  .fs-5 { font-size: 1.125rem !important; }
  .fs-6 { font-size: 1rem !important; }
  .fs-7 { font-size: .9rem !important; }
  .fs-8 { font-size: .8rem !important; }

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
  .bg-orange { background-color: #ff6503 }
  .bg-light { background-color: #f4f5f2 }

  .text-white { color: #ffffff }
  .text-green { color: #00656b }
  .text-gray { color: #545454 }
  .text-success { color: #469b2f }
  .text-warning { color: rgba(255, 171, 0, 1)}
  .text-danger { color: rgba(255, 62, 29, 1)}

  .spacer-10-0 { margin: 10px 0 }
  .spacer-5-0 { margin-bottom: 50px }

  td { vertical-align: bottom; }

  .border { border: 2px solid #00656b!important;}

  .w-100 { width: 100%!important; }
  .w-57 { width: 57%!important; }
  .w-50 { width: 50%!important; }
  .w-75 { width: 75%!important; }
  .w-25 { width: 25%!important; }
  .w-46 { width: 46%!important; }
  .w-47 { width: 47%!important; }
  .w-48 { width: 48%!important; }
  .w-49 { width: 48.60%!important; }
  .w-auto { width: auto!important; }
  .w-35 { width: 35%!important; }

  .left { float: left; }
  .right { float: right; }

  .text-right { text-align: right }
  .text-left { text-align: left }
  .text-center { text-align: center }

  hr { color: #ddd }

</style>
</head>

<body>
  <htmlpageheader name="page-header">
    <table style="width:100%;">
      <tr>
        <td width="30%" style="vertical-align: middle;">
          <img src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/logo-dark.png')))}}" width="140" />
        </td>
        <td width="43%" style="vertical-align: middle">
          <table class="text-green fs-5 mt-2">
            <tr>
              <td><span class="fw-bold">CEP:</span></td>
              <td>62595-000</td>
            </tr>
          </table>
          <table class="text-green fs-5">
            <tr>
              <td><span class="fw-bold">CNPJ:</span></td>
              <td>45.081.253/0001-75</td>
            </tr>
          </table>
          <table class="text-green fs-5">
            <tr>
              <td><span class="fw-bold">CONTATO:</span></td>
              <td>(88) 9 9631-0653</td>
            </tr>
          </table>
        </td>
        <td class="text-green fw-bold" style="vertical-align: middle">

          <table class="text-green fw-bold mt-1">
            <tr>
              <td><img style="margin-right: 2px" width="22" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/ig.png')))}}" align="left" /></td>
              <td class="fs-6" style="vertical-align: middle">upjeri</td>
            </tr>
          </table>

          <table class="text-green fw-bold">
            <tr>
              <td><img style="margin-right: 2px" width="22" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/site.png')))}}" align="left" /></td>
              <td class="fs-6" style="vertical-align: middle">upjeri.com</td>
            </tr>
          </table>

          <table class="text-green fw-bold">
            <tr>
              <td><img style="margin-right: 2px" width="22" src="data:image/png;base64,{{base64_encode(\File::get(public_path('assets/img/pdf/email.png')))}}" align="left" /></td>
              <td class="fs-6" style="vertical-align: middle">contato@upjeri.com</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </htmlpageheader>

  <htmlpagefooter name="page-footer">
    <div id="footer">
      <table style="width:100%;">
        <tr>
          <td style="text-align: left">
            <span style="font-size:10px;">Copyright © {{env('APP_NAME')}} {{date('Y')}}. All rights reserved.</span>
          </td>
          <td style="text-align: right">
            <span style="font-size: 10px;">Página: {PAGENO}/{nbpg}</span>
          </td>
        </tr>
      </table>
    </div>
  </htmlpagefooter>

  <div class="container bg-orange rounded p-2 mb-3">
    <div class="text-white fs-7 text-center fw-bold">
      APRESENTAR ESSE DOCUMENTO NO LOCAL
    </div>
  </div>

  <div class="container mb-2">
    <div class="left" style="width: 58%">
      <div class="left border rounded w-47">
        <div class="left w-57 p-2">
          <span class="text-gray fs-6 fw-bold">
            VOUCHER Nº:
          </span>
        </div>

        <div class="right w-25 p-2 text-right">
          <span class="text-green fs-4 fw-bold">
            {{$voucher->id}}
          </span>
        </div>
      </div>
      <div class="right border rounded w-47">
        <div class="left p-2 w-35">
          <span class="text-gray fs-6 fw-bold">
            EMITIDO:
          </span>
        </div>

        <div class="right w-auto p-2 text-right">
          <span class="text-green fs-6 fw-bold">
            {{$voucher->data_criacao}}
          </span>
        </div>
      </div>

      <div class="left border rounded w-100 p-2 mt-2">
        <div class="mb-2 fs-6 fw-bold">
          <span class="text-gray">SERVIÇO(S) CONTRATADO(S)</span>
        </div>
        @if(!$voucher->servicos)
          <div class="fs-7 text-warning">Nenhum serviço incluso</div>
        @else
          @foreach ($voucher->servicos as $servico)
            <div class="fs-7">{{($loop->index + 1).'. '.mb_convert_case($servico->nome, MB_CASE_UPPER, 'UTF-8');}}</div>
          @endforeach
        @endif
      </div>
    </div>

    <div class="right" style="width: 40%">

      <div class="p-2  bg-light border rounded mb-2">
        <div class="left" style="width: 46%">
          <span class="text-gray fs-6 fw-bold">
            VALOR TOTAL:
          </span>
        </div>

        <div class="right text-right">
          <span class="text-green fs-6 fw-bold">
            R$ {{$voucher->valor_total}}
          </span>
        </div>
      </div>

      <div class="p-2 border rounded mb-2">
        <div class="left" style="width: 60%">
          <span class="text-gray fs-6 fw-bold">
            VALOR RESERVA:
          </span>
        </div>

        <div class="right text-right">
          <span class="text-success fs-6 fw-bold">
            R$ {{$voucher->valor_reserva}}
          </span>
        </div>
      </div>

      <div class="p-2 border rounded">
        <div class="left" style="width: 60%">
          <span class="text-gray fs-6 fw-bold">
            VALOR RESTANTEL:
          </span>
        </div>

        <div class="right text-right">
          <span class="fs-6 fw-bold">
            R$ {{$voucher->valor_restante}}
          </span>
        </div>
      </div>

    </div>
  </div>

  <div class="container mb-3">
    <div class="left border rounded p-2">
      <div class="mb-2 fs-6 fw-bold">
        <span class="text-gray">CLIENTES</span>
      </div>

      <div class="fs-7">{!!$voucher->cliente->id == 0 ? "<span class='text-warning'>Nenum cliente incluso</span>" : "1. ". $voucher->cliente->nome!!}</div>
      @if($voucher->cliente && $voucher->cliente->acompanhantes)
        @foreach ($voucher->cliente->acompanhantes as $acompanhante)
          <div class="fs-7">{{($loop->index + 2).'. '.$acompanhante}}</div>
        @endforeach
      @endif

      @if($voucher->cliente->id != 0)
        <hr>

        <div class="w-100">
          <div class="left py-1" style="width: 22%;">
            <div class="text-gray fw-bold" style="margin-top: 2px">
              <span class="fs-7">Nº DE PASSAGEIROS</span>
            </div>
          </div>

          <div class="left border rounded text-center rounded py-1 fs-5 text-dark fw-bold" style="width: 40px">
            {{$voucher->cliente->qtd_acompanhantes ?? '?'}}
          </div>
        </div>
      @endif

    </div>
  </div>

  <div class="page-break-before"></div>

  @if($voucher->transfers != 0)

    <div class="container bg-green rounded-top mb-2" style="padding: 10px 0 10px 0">
      <div class="text-white fs-5 text-center fw-bold">
        TRANSFERS
      </div>
    </div>

    <div class="container">
      <div class="rounded-top border left" style="width: 35%;">
        <div class="text-center bg-light fw-bold fs-6 p-2 border-bottom">
          <span class="text-gray">DATA DO SERVIÇO</span>
        </div>

        <div>
          @php
          $m = 0;
          $embarque_transfers = '-';
          @endphp
          @foreach($voucher->servicos as $servico)
            @php
            if($servico->tipo != 'transfer') {
              continue;
            }
            $embarque_transfers = $servico->origem;
            $m++;
            @endphp

            <div class="left" style="width: {{(100 / ($voucher->transfers <= 3 ? $voucher->transfers : 3 )) - 0.01}}%">
              <div class="text-center py-2 px-1 {{$m != $voucher->transfers ? 'border-end' : ''}}">
                <div class="text-gray fw-bold mb-2 fs-6">{{$m}}º TRECHO</div>
                <div class="text-dark fs-6 mb-1">
                  {{Carbon::parse($servico->data)->format('d/m/Y')}}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="rounded-top border left" style="width: 35%;  margin-left: 16px">
        <div class="text-center fw-bold fs-6 p-2 border-bottom">
          <span class="text-gray">HORÁRIO DO SERVIÇO</span>
        </div>

        <div>

          @php
          $m = 0;
          $embarque_transfers = '-';
          @endphp
          @foreach($voucher->servicos as $servico)
            @php
            if($servico->tipo != 'transfer') {
              continue;
            }
            $embarque_transfers = $servico->origem;
            $m++;
            @endphp

            <div class="left" style="width: {{(100 / ($voucher->transfers <= 6 ? $voucher->transfers : 6 )) - 0.01}}%">
              <div class="text-center py-2 px-1 {{$m != $voucher->transfers ? 'border-end' : ''}}">
                <div class="text-gray fw-bold mb-2 fs-6">{{$m}}º TRECHO</div>
                <div class="text-dark fs-6 mb-1">
                  {{$servico->horario}}
                </div>
              </div>
            </div>

          @endforeach

        </div>
      </div>

      <div class="right border rounded p-2" style="width: 22%; height: 89px">
        <div class="text-center fw-bold">
          <div class="mb-4 fs-6 text-gray">Nº DO VOO</div>
          <div class="fs-4">{{!empty($voucher->cliente->numero_voo) ? $voucher->cliente->numero_voo : '-'}}</div>
        </div>
      </div>
    </div>

    <div class="container mb-3">
      @php
      $m = 0;
      $embarque_transfers = '-';
      @endphp
      @foreach($voucher->servicos as $servico)
        @php
        if($servico->tipo != 'transfer') {
          continue;
        }
        $embarque_transfers = $servico->origem;
        $m++;
        @endphp
        <div class="mt-2">
          <div class="left bg-light fs-6 p-2 rounded border fw-bold text-gray text-center" style="width: 17%;">
            {{$m}}º TRECHO
          </div>

          <div class="right p-2 border rounded" style="margin-left: 8px">
            <div>
              <div class="left fw-bold text-gray" style="width: 25%">
                EMBARQUE
              </div>
              <div class="right fs-7 border-bottom" style="padding-bottom: 8px; margin-bottom: 8px; border-color: #888; border-width: 1px">
                {{$servico->origem}}
              </div>
            </div>
            <div>
              <div class="left fw-bold text-gray" style="width: 25%">
                DESEMBARQUE
              </div>
              <div class="right fs-7">
                {{$servico->destino}}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <div class="container mb-4"></div>

  @if($voucher->passeios != 0)
    <div class="container bg-orange rounded-top mb-2" style="padding: 10px 0 10px 0">
      <div class="text-white fs-5 text-center fw-bold">
        PASSEIOS
      </div>
    </div>

    <div class="container mb-2">
      <div class="rounded-top border">
        <div class="text-center fw-bold bg-light fs-6 p-2 border-bottom">
          <span class="text-gray">DATA DOS PASSEIOS</span>
        </div>

        <div style="background: #ffffff!important">
          @php
          $m = 0;
          $embarque_passeios = '-';
          @endphp

          @foreach($voucher->servicos as $servico)
            @php
            if($servico->tipo != 'passeio') {
              continue;
            }
            $embarque_passeios = $servico->origem;
            $m++;
            @endphp

            <div class="left" style="width: {{(100 / ($voucher->passeios <= 6 ? $voucher->passeios : 6 )) - 0.01}}%">
              <div class="text-center py-2 px-1 {{$m != $voucher->passeios ? 'border-end' : ''}}">
                <div class="text-gray fw-bold mb-1 fs-6">{{$m}}º DIA</div>
                <div class="fs-7 mb-1 fw-bold">
                  {{Carbon::parse($servico->data)->format('d/m/Y')}}
                </div>
                <div class="fs-7">
                  {{$servico->apelido}}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="container mb-3">
      <div class="border left rounded-bottom p-2" style="width: 40%; background: #ffffff!important">
        <div class="text-center">
          <div class="fs-6 text-gray fw-bold mb-1">EMBARQUE:</div>
          <div class="fs-7 text-gray">{{$embarque_passeios}}</div>
        </div>
      </div>
      <div class="left" style="margin-left: 10px; margin-top: 2px">
        <div class="fs-8 fw-bold mb-1 w-100">INFORMAÇÃO</div>
        <div class="left w-50">
          <div class="fs-8 fw-bold text-gray">PASSEIO PRIVATIVO</div>
          <div class="fs-8" style="line-height: 1rem">HORÁRIO A DEFINIR PELO CLIENTE</div>
        </div>
        <div class="left w-50">
          <div class="fs-8 fw-bold text-gray">PASSEIO COMPARTILHADO</div>
          <div class="fs-8" style="line-height: 1rem">EMBARQUE ENTRE 09:00/10:00</div>
        </div>
      </div>
    </div>
  @endif

  <div class="container bg-orange rounded p-2">
    <div class="text-white fs-7 text-center fw-bold">
      APRESENTAR ESSE DOCUMENTO NO LOCAL
    </div>
  </div>

  <div class="page-break-before"></div>

  <div class="container border rounded p-2" style="background: #ffffff!important">
    <p class="fw-bold" style="margin-top:0">1. CANCELAMENTO DE SERVIÇOS CONTRATADOS</p>
    <p>A UPJERI considera como serviços contratados, toda e qualquer aquisição/compra por nossos clientes, de serviços fornecidos por nossa agência, com pagamento de 20% ou 50% efetuado, ou em dinheiro, crédito ou transferência bancária (pix).</p>

    <p class="fw-bold">1.1 CANCELAMENTOS COM ANTECEDÊNCIA DE 30 DIAS OU MAIS.</p>
    <p>Reembolso de 100% do valor previamente pago;</p>

    <p class="fw-bold">1.2 CANCELAMENTOS COM ANTECEDÊNCIA ENTRE 30 dias a 03 dias antes.</p>
    <p>Reembolso de 50% do valor previamente pago;</p>

    <p class="fw-bold">1.3 CANCELAMENTOS FALTANDO 24 horas.</p>
    <p>NÃO haverá reembolso. Multa de 100% do valor pago.</p>

    <p class="fw-bold">2. DIREITO DE ARREPENDIMENTO</p>
    <p>Até 07 (sete) dias após a confirmação da contratação do serviço, o cliente pode desistir da compra e ser ressarcido integralmente. Conforme consta no Art.49 do Código de Defesa do Consumidor: “Art. 49. O consumidor pode desistir do contrato, no prazo de 7 dias a contar de sua assinatura ou do ato de recebimento do produto ou serviço, sempre que a contratação de fornecimento de produtos e serviços ocorrer fora do estabelecimento comercial, especialmente por telefone ou a domicílio. Se o consumidor exercitar o direito de arrependimento previsto neste artigo, os valores eventualmente pagos, a qualquer título, durante o prazo de reflexão, serão devolvidos...”</p>

    <p class="fw-bold">3. SERVIÇO COMPARTILHADO</p>
    <p>3.1 Na modalidade compartilhada você dividirá o carro com até no máximo 5 passageiros. Sendo possível escolher qualquer horário entre 07:00 e 17:00.</p>
    <p>3.2 Poderá haver uma flexibilidade para horário de embarque no veículo compartilhado.</p>

    <p><span class="fw-bold">Flexibilidade para embarque em Jericoacoara:</span> de 1 hora.</p>
    <p><span class="fw-bold">Flexibilidade para embarque em Fortaleza:</span> de 2 hora.</p>
    <p><span class="fw-bold">Flexibilidade para embarque em Cruz:</span> de 1 hora.</p>

    <p>3.3 Em caso de atraso de voo será feito o reajuste da vaga em outro veículo. A flexibilidade passa a ser contada a partir do horário previsto de desembarque.</p>
    <p>3.4 Troca de data e/ou horário só será possível até 24 horas antes do dia do serviço contratado, e está sujeito a disponibilidade de vaga no dia e no horário desejado.</p>
    <p>3.5 Poderá haver a necessidade de reajuste do horário definido devido a disponibilidade dos carros do horário do compartilhado.</p>
    <p>3.6 A quantidade de bagagens é limitada por passageiro. É muito importante respeitar o limite de bagagem para que todos possam alocar seus pertences com tranquilidade e ser uma viagem confortável. (7. POLÍTICA DE BAGAGEM).</p>

    <p class="fw-bold">4. SERVIÇO PRIVATIVO</p>
    <p>4.1 Na modalidade privativo será reservado um carro exclusivo para você. Sendo possível escolher o melhor horário para o embarque em qualquer horário dentre as 24 horas do dia.</p>

    <p>4.2 O valor do serviço privativo é referente a quantidade de vagas ocupadas. Haverá alteração no valor do serviço contratado caso sejam incluídas pessoas a mais no veículo além das informadas pelo contratante.</p>
    <p>4.3 Em caso de atraso de voo poderá ser feita alteração do veículo programado para outro veículo, visto que os carros têm horários programados para ida e volta. Os horários estão sujeitos a alterações por imprevistos e de acordo com o trânsito.</p>
    <p>4.4 Troca de data e/ou horário e/ou veículo só será possível até 24 horas antes do dia do serviço contratado, e está sujeito a disponibilidade do veículo no dia e no horário desejado.</p>

    <p class="fw-bold">5. SERVIÇO DE PASSEIOS</p>
    <p>5.1 Em caso de troca de data e/ou alteração do veículo do passeio precisará ser verificado até 48 horas antes do serviço contratado. Visto que todos os veículos e guias são programados com antecedência. E ainda estará sujeito a não disponibilidade do veículo e do guia no dia e no horário desejado para a troca.</p>
    <p>5.2 Em passeios o serviço está voltado apenas a realização/execução do passeio, levando os clientes a cada destino fim ofertado e contratado.</p>

    <p class="fw-bold">6. TAXAS DE PASSEIOS</p>
    <p>No valor do pacote não está incluso taxas de entradas/ingressos para diversão de determinados ambientes. O pagamento destas são de exclusividade do cliente que tem por opção entrar/participar ou não no local.</p>

    <p class="fw-bold">7. POLÍTICA DE BAGAGEM</p>
    <p>7.1 Cada passageiro pode embarcar com 01 mala de tamanho MÉDIO a GRANDE.</p>
    <p>7.2 Se o passageiro tiver excesso de bagagem deverá informar com antecedência de 24 horas a nosso atendimento e consultar disponibilidade e tarifa extra.</p>
    <p>7.3 Bagagens especiais como equipamento de kite, carrinhos de bebê, cadeira de rodas e demais devem ser declaradas com antecedência pois poderá ser cobrado taxa extra a ser consultado.</p>
    <p>7.4 A bagagem é de inteira responsabilidade do passageiro, por favor acompanhe o motorista até ele embarcar todas as suas bagagens no veículo. Faremos o possível para restituir pertences esquecidos, mas não nos responsabilizamos por pertences deixados no veículo.</p>
    <p class="m-0">7.5 Caso seja encontrado o bem esquecido, informamos que será cobrado o valor de uma passagem de Transfer pela locomoção do veículo e disponibilização de um motorista para levar o bem encontrado até seu endereço.</p>
  </div>

</body>
</html>
