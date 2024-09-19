<?php

namespace App\Repositories;

use App\Interfaces\InventarioRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class InventarioRepository implements InventarioRepositoryInterface
{
  public function findAll()
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $instituicoes = Inventario::where('instituicao_id', $instituicao_id)->get();

    return $instituicoes;
  }

  public function findById($id)
  {
    $instituicao_id = Controller::getSession('instituicao_id');
    $inventario = Inventario::where('instituicao_id', $instituicao_id)->where('id', $id)->first();

    if(!$inventario)
    {
      return false;
    }

    if(empty($inventario->horarios))
    {
      $inventario["horarios"] = [];
    }else{
      $inventario["horarios"] = unserialize($inventario->horarios);
    }

    return $inventario;
  }

  public function create($request)
  {
   $instituicao_id = Controller::getSession('instituicao_id');

    $query = new Inventario;
    $query->nome = $request->nome;
    $query->cap_max = $request->cap_max;
    $query->descricao = $request->detalhes;
    $query->marca = $request->marca;
    $query->instituicao_id = $instituicao_id;
    $query->create_user_id = Auth::user()->id;
    $query->update_user_id = Auth::user()->id;

    $horarios = [];
    if(!empty($request->dias) && !empty($request->horarios)){
      $horarios = $this->gerarHorariosDisponiveis($request->dias, $request->horarios);
    }

    if(!empty($horarios)){
      $query->horarios = serialize($horarios);
    }

    $query->save();

    return $query->id;
  }

  public function update($request)
  {
    $query = Inventario::find($request->inventario_id);
    $query->nome = $request->nome;
    $query->cap_max = $request->cap_max;
    $query->descricao = $request->detalhes;
    $query->marca = $request->marca;
    $query->update_user_id = Auth::user()->id;
    $query->save();

    $horarios = [];
    if(!empty($request->dias) && !empty($request->horarios)){
      $horarios = $this->gerarHorariosDisponiveis($request->dias, $request->horarios);
    }

    if(!empty($horarios)){
      $query->horarios = serialize($horarios);
    }

    $query->save();

    return true;
  }

  private function integerToWeekName($param)
  {
    switch ($param) {
      case 1:
        return "Segunda-feira";
        break;

      case 2:
        return "Terça-feira";
        break;

      case 3:
        return "Quarta-feira";
        break;

      case 4:
        return "Quinta-feira";
        break;

      case 5:
        return "Sexta-feira";
        break;

      case 6:
        return "Sábado";
        break;

      case 0:
        return "Domingo";
        break;

      default:
        return "Desconhecido";
        break;
    }
  }

  public function gerarHorariosDisponiveis($diasEscolhidos, $horariosPorDia)
  {
    $horariosDisponiveis = [];

    foreach ($diasEscolhidos as $dia) {
      if (isset($horariosPorDia[$dia]) && $horariosPorDia[$dia] != null) {

        $horariosDia = $horariosPorDia[$dia];

        // return($horariosDia);
        foreach ($horariosDia as $key => $horarioDia) {
          $horarioInicio = Carbon::parse($horarioDia['inicio']);
          $horarioFim = Carbon::parse($horarioDia['fim']);

          $horarioAtual = $horarioInicio->copy();
          $intervaloGabinete = 60;
          $intervaloIntervalo = 20;

          // return $horarioAtual;

          while ($horarioAtual < $horarioFim) {
            $horariosDisponiveis[$dia][] = [
              'dia_semana' => $this->integerToWeekName($dia),
              'dia_semana_key' => $dia,
              'horario_inicio' => $horarioAtual->format('H:i'),
              'horario_fim' => $horarioAtual->addMinutes($intervaloGabinete)->format('H:i'),
            ];

            $horarioAtual->addMinutes($intervaloIntervalo);

            // return $horariosDisponiveis;
          }
        }
      }
    }

    return $horariosDisponiveis;
  }

  public function delete($id)
  {
    $instituicao = $this->findById($id);
    if($instituicao){
      $instituicao->delete();
    }

    return true;
  }
}
