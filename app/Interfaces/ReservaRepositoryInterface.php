<?php

namespace App\Interfaces;

interface ReservaRepositoryInterface
{
  public function findAll();

  public function findAllRaw();

  public function findAllByTeacher();

  public function findAllByTeacherRaw();

  public function findById($data);

  public function create($data);

  public function update($data);

  public function updateStatus($data);

  public function delete($data);

}
