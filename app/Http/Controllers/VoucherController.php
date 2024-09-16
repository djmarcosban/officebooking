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

class VoucherController extends Controller
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

  public function findAll()
  {
    $vouchers = $this->voucherRepository->findAll(pagination: 'true', orderBy: 'updated_at');

    return view('content.vouchers.listar')->with([
      "vouchers" => $vouchers
    ]);
  }

  public function create()
  {
    $etapas = $this->etapaRepository->findAll(only_active: true);
    $clientes = $this->clienteRepository->findAll(only_active: true);
    $servicos = $this->servicoRepository->findAll(only_active: true);
    $origensDestinos = $this->origemRepository->findAll(only_active: true);

    return view('content.vouchers.adicionar', compact('etapas', 'servicos', 'origensDestinos', 'clientes'));
  }

  public function handleCreate(Request $request)
  {
    $request['servicos_serialized'] = serialize($request->servicos ? json_decode($request->servicos) : []);
    $request['servicos'] = json_decode($request->servicos);
    $request['cliente_serialized'] = serialize($request->cliente ? json_decode($request->cliente) : []);
    $request['cliente'] = json_decode($request->cliente);

    $voucherId = $this->voucherRepository->create($request);

    if(!empty($request->return_url)){
      return redirect($request->return_url.'?status=success&voucher_id='.$voucherId);
    }

    return redirect('/vouchers?status=success&last_id='.$voucherId);
  }

  public function update()
  {
    $voucherId = request('voucher_id');
    $voucher = $this->voucherRepository->findById($voucherId);

    $etapas = $this->etapaRepository->findAll(only_active: true);
    $clientes = $this->clienteRepository->findAll(only_active: true);
    $servicos = $this->servicoRepository->findAll(only_active: true);
    $origensDestinos = $this->origemRepository->findAll(only_active: true);

    return view('content.vouchers.editar', compact('voucher', 'etapas', 'servicos', 'origensDestinos', 'clientes'));
  }

  public function handleUpdate(Request $request)
  {
    $request['servicos_serialized'] = serialize(json_decode($request->servicos));
    $request['servicos'] = json_decode($request->servicos);
    $request['cliente_serialized'] = serialize(json_decode($request->cliente));
    $request['cliente'] = json_decode($request->cliente);

    $update = $this->voucherRepository->update($request);

    if(!$update)
    {
      return redirect('/vouchers?status=wrong');
    }

    return redirect('/vouchers?status=success&last_id='.$request->voucher_id);
  }

  public function delete()
  {
    $voucherId = request('voucher_id');
    $this->voucherRepository->delete($voucherId);

    return redirect('/vouchers?status=success');
  }
}

