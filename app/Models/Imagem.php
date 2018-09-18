<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'imagem';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'local', 'nome'
    ];
    protected $hidden = [
        'id'
    ];

    public static function create($array = null) {
        $imagem = new Imagem();
        $imagem->local = $array['local'];
        $imagem->nome = $array['nome'];
        $imagem->save();

        return $imagem;
    }

    public static function alterar($array = null) {
        $imagem = Imagem::where('id', '=', $array['id'])->get()->first();
        $imagem->local = $array['local'];
        $imagem->nome = $array['nome'];
        $imagem->save();

        return $imagem;
    }

}
