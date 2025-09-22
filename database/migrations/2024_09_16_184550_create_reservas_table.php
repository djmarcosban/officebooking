<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('reservas', function (Blueprint $table) {
      $table->id();
      $table->integer('professor_id');
      $table->integer('inventario_id');
      $table->integer('instituicao_id');
      $table->enum('status', ['pendente', 'aprovada', 'cancelada', 'historico'])->default('pendente');
      $table->string('data')->nullable();
      $table->string('horario');
      $table->string('descricao')->nullable();
      $table->integer('create_user_id');
      $table->integer('update_user_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reservas');
  }
};
