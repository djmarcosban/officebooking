<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\UsuarioRepositoryInterface;
use App\Interfaces\VoucherRepositoryInterface;
use App\Interfaces\EtapaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
  private VoucherRepositoryInterface $voucherRepository;
  private EtapaRepositoryInterface $etapaRepository;
  private UsuarioRepositoryInterface $usuarioRepository;

  public function __construct(
    VoucherRepositoryInterface $voucherRepository,
    EtapaRepositoryInterface $etapaRepository,
    UsuarioRepositoryInterface $usuarioRepository,
  ){
    $this->validateSession();
    $this->voucherRepository = $voucherRepository;
    $this->etapaRepository = $etapaRepository;
    $this->usuarioRepository = $usuarioRepository;
  }

  public function index()
  {
    $etapas = $this->etapaRepository->findAll(only_active: true);

    foreach ($etapas as $key => $etapa) {
      $vouchers = $this->voucherRepository->findAllByEtapaId(etapa_id: $etapa->id);
      $etapas[$key]['vouchers'] = $vouchers;
    }

    // return $etapas;

    return view('content.kanban.index', compact('etapas'));
  }

  public function update(Request $request)
  {
    $request->validate([
      'etapa_id' => 'required',
      'voucher_id' => 'required',
    ]);

    $this->voucherRepository->updateEtapa(etapa_id: $request->etapa_id, voucher_id: $request->voucher_id);

    return true;
  }
}
