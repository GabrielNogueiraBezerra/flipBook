<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'estado';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'descricao', 'uf'
    ];
    protected $hidden = [
        'id_pais'
    ];

    // função que retornará o objeto pais
    public function pais() {
        return $this->hasOne('App\Models\Pais', 'id', 'id_pais');
    }

}
