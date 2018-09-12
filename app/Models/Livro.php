<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'livro';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'nome', 'autor', 'sinopse'
    ];
    protected $hidden = [
        'dono', 'capa'
    ];

    // função que retornará o dono do livro
    public function dono() {
        return $this->hasOne('app\Models\Usuario', 'dono', 'id');
    }

    // função que retornará a capa do livro
    public function capa() {
        return $this->hasOne('app\Models\Imagem', 'capa', 'id');
    }

    public static function create($array = null) {
        $livro = new Livro();
        $livro->nome = $array['nome'];
        $livro->autor = $array['autor'];
        $livro->sinopse = $array['sinopse'];
        $livro->dono = $array['dono'];
        $livro->capa = $array['capa'];
        $livro->save();

        return $livro;
    }

}
