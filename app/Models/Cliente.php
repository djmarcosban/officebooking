<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'create_user_id',
        'update_user_id',
        'nome',
        'tipo',
        'acompanhantes',
        'qtd_acompanhantes',
        'status',
        'documento',
        'numero_voo',
    ];
}
