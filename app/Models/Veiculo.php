<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
        'marca',
        'placa',
        'ano',
        'status',
        'empresa_id',
        'create_user_id',
        'update_user_id',
    ];
}
