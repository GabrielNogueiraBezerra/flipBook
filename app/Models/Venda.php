<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'venda';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'status', 'valor'
    ];
    protected $hidden = [
        'comprador', 'livro'
    ];

    // função que retornará o objeto quem comprpou
    public function compradorVenda() {
        return $this->hasOne('App\Models\Usuario', 'id', 'comprador');
    }

    // função que retornará o objeto do livro comprado
    public function livroComprado() {
        return $this->hasOne('App\Models\Livro', 'id', 'livro');
    }

}
