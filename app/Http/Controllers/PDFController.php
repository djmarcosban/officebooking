<?php

namespace App\Http\Controllers;

use App\Interfaces\ServicoRepositoryInterface;
use App\Interfaces\OrigemRepositoryInterface;
use App\Interfaces\UsuarioRepositoryInterface;
use App\Interfaces\VoucherRepositoryInterface;
use App\Interfaces\EtapaRepositoryInterface;
use App\Interfaces\ClienteRepositoryInterface;
use Illuminate\Http\Request;
use File;
use PDF;

class PDFController extends Controller
{
  private ClienteRepositoryInterface $clienteRepository;
  private OrigemRepositoryInterface $origemRepository;
  private ServicoRepositoryInterface $servicoRepository;
  private VoucherRepositoryInterface $voucherRepository;
  private EtapaRepositoryInterface $etapaRepository;
  private UsuarioRepositoryInterface $usuarioRepository;

  public function __construct(
    ClienteRepositoryInterface $clienteRepository,
    OrigemRepositoryInterface $origemRepository,
    ServicoRepositoryInterface $servicoRepository,
    VoucherRepositoryInterface $voucherRepository,
    EtapaRepositoryInterface $etapaRepository,
    UsuarioRepositoryInterface $usuarioRepository,
  )
  {
    $this->clienteRepository = $clienteRepository;
    $this->origemRepository = $origemRepository;
    $this->servicoRepository = $servicoRepository;
    $this->voucherRepository = $voucherRepository;
    $this->etapaRepository = $etapaRepository;
    $this->usuarioRepository = $usuarioRepository;

    $this->validateSession();
  }

  public function voucher()
  {
    $voucher_id = request('voucher_id');
    $voucher = $this->voucherRepository->findById($voucher_id);


    if($voucher->cliente)
    {
      if($voucher->cliente->acompanhantes){
        $voucher['cliente']['acompanhantes'] = explode(',', $voucher->cliente->acompanhantes);
      }
    }

    $data = [
      "voucher" => $voucher,
    ];

    $servicos = $voucher->servicos;

    usort($servicos, function ($a, $b) {
      return strtotime($a->data) - strtotime($b->data);
    });

    $passeios = 0;
    $transfers = 0;

    foreach ($voucher->servicos as $key => $value) {
      if($value->tipo == 'passeio') {
        $passeios += 1;
      }else{
        $transfers += 1;
      }
    }

    $voucher['passeios'] = $passeios;
    $voucher['transfers'] = $transfers;
    $voucher['servicos'] = $servicos;

    $config = ['instanceConfigurator' => function($mpdf) {
      $mpdf->showWatermarkImage = true;
      $mpdf->watermarkImgBehind = true;
      $mpdf->setWatermarkImage(src: public_path('assets/img/pdf/burro.png'), alpha: 0.2, size: 80, pos: [0, 200]);
    }];

    // return $voucher;

    $nomePdf = 'voucher_'.$voucher_id.'_'.date('d_m_Y_H_i_s').'.pdf';
    $pdf = PDF::loadView('content.vouchers.pdf', $data, [], $config);
    $pdf->stream($nomePdf);
    exit();
  }
}

