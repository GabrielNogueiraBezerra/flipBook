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
        'id', 'status', 'valor', 'created_at', 'nossoNumero'
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

    // função responsável por cadastrar a venda no banco de dados
    public static function create($array = null) {
        $venda = new Venda();
        $venda->status = 0;
        $venda->valor = $array['valor'];
        $venda->comprador = $array['comprador'];
        $venda->livro = $array['livro'];
        $venda->nossonumero = '';
        $venda->save();
        return $venda;
    }

}
