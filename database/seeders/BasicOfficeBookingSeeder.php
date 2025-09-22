<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BasicOfficeBookingSeeder extends Seeder
{
  public function run(): void
  {
    $now = now();

    DB::table('instituicaos')->updateOrInsert(
      ['id' => 1],
      [
        'nome' => 'Test',
        'endereco' => 'Test',
        'create_user_id' => 1,
        'update_user_id' => 1,
        'created_at' => $now,
        'updated_at' => $now,
      ]
    );

    DB::table('users')->updateOrInsert(
      ['id' => 1],
      [
        'nome' => 'Marcos',
        'email' => 'djmarcosban@hotmail.com',
        'telefone' => null,
        'instituicao_id' => null,
        'create_user_id' => 1,
        'update_user_id' => 0,
        'funcao' => 'admin',
        'email_verified_at' => null,
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
        'created_at' => $now,
        'updated_at' => $now,
      ]
    );

    DB::table('users')->updateOrInsert(
      ['id' => 2],
      [
        'nome' => 'Professor1',
        'email' => 'professor1@email.com',
        'telefone' => null,
        'instituicao_id' => 1,
        'create_user_id' => 1,
        'update_user_id' => 1,
        'funcao' => 'professor',
        'email_verified_at' => null,
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
        'created_at' => $now,
        'updated_at' => $now,
      ]
    );
  }
}
