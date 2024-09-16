<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'create_user_id',
        'update_user_id',
        'titulo',
        'posicao',
        'status',
    ];
}
