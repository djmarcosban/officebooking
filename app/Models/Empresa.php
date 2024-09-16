<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'create_user_id',
        'update_user_id',
        'status',
        'cnpj',
        'company_name',
        'contact',
        'address',
        'cep',
        'number',
        'complement',
        'city',
        'state',
        'neighborhood',
        'country',
    ];
}
