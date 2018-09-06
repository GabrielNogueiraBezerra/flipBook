<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'cidade';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'descricao'
    ];
    protected $hidden = [
        'id_estado'
    ];

    // função que retornará o objeto estado
    public function estado() {
        return $this->hasOne('App\Models\Estado', 'id', 'id_estado');
    }

}
