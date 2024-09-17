<?php

namespace App\Interfaces;

interface InventarioRepositoryInterface
{
  public function findAll();

  public function findById($data);

  public function create($data);

  public function update($data);

  public function delete($data);

}
