<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao_id',
        'create_user_id',
        'update_user_id',
        'cliente_id',
        'etapa_id',
        'data_emissao',
        'servicos',
        'valor_reserva',
        'valor_restante',
        'valor_desconto',
        'valor_total'
    ];
}
