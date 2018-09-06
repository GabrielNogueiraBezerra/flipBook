<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'pais';
    protected $primaryKey = 'id';
    protected $filliable = [
        'descricao'
    ];
    protected $hidden = [
        'id'
    ];

}
