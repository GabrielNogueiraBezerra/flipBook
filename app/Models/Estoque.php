<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficarão ocultos nas consultas desse modelo
     */

    protected $table = 'estoque';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'quantidade'
    ];
    protected $hidden = [
        'livro'
    ];

    //função que retornará o livro do estoque
    public function livro() {
        return $this->hasOne('App\Models\Livro', 'livro', 'id');
    }

    public static function create($array = null) {
        $estoque = new Estoque();
        $estoque->livro = $array['livro'];
        $estoque->quantidade = $array['estoque'];
        $estoque->save();

        return $estoque;
    }

    public static function alterar($array = null) {
        $estoque = Estoque::where('id', '=', $array['id'])->get()->first();
        $estoque->quantidade = $array['estoque'];
        $estoque->save();

        return $estoque;
    }

}
