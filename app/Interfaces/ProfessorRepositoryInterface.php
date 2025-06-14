<?php

namespace App\Interfaces;

interface ProfessorRepositoryInterface
{
  public function findAll();

  public function findById($data);

  public function create($data);

  public function update($data);

  public function delete($data);

}
