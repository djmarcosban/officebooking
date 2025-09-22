<?php

namespace App\Interfaces;

interface UsuarioRepositoryInterface
{
  public function findAll($pagination, $order, $per_page);

  public function findById($data);

  public function create($data);

  public function update($data);

  public function updateMeusDados($data);

  public function updatePassword($data);

  public function delete($data);

}
