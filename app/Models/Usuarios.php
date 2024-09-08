<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    // Indica que o campo cpf será a chave primária
    protected $primaryKey = 'cpf';

    // Indica que a chave primária não é auto-incrementável
    public $incrementing = false;

    // Indica que não existirão os campos created_at e updated_at
    public $timestamps = false;
    
    protected $fillable = [
        'cpf',
        'nome',
        'data_nascimento'
    ];
}
