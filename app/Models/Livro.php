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
        'id', 'nome', 'autor', 'sinopse', 'comprimento', 'altura', 'largura', 'diametro', 'peso'
    ];
    protected $hidden = [
        'dono', 'capa'
    ];

    // função que retornará o dono do livro
    public function donoLivro() {
        return $this->hasOne('app\Models\Usuario', 'id', 'dono');
    }

    // função que retornará a capa do livro
    public function capaLivro() {
        return $this->hasOne('App\Models\Imagem', 'id', 'capa');
    }

    //função que retornará o estoque do livro
    public function estoque() {
        return $this->hasOne('App\Models\Estoque', 'livro', 'id');
    }

    public static function create($array = null) {
        $livro = new Livro();
        $livro->nome = $array['nome'];
        $livro->autor = $array['autor'];
        $livro->sinopse = $array['sinopse'];
        $livro->dono = $array['dono'];
        $livro->capa = $array['capa'];
        $livro->comprimento = $array['comprimento'];
        $livro->altura = $array['altura'];
        $livro->largura = $array['largura'];
        $livro->diametro = $array['diametro'];
        $livro->peso = $array['peso'];
        $livro->save();

        return $livro;
    }

    public static function alterar($array = null) {
        $livro = Livro::where('id', '=', $array['id'])->get()->first();
        $livro->nome = $array['nome'];
        $livro->autor = $array['autor'];
        $livro->sinopse = $array['sinopse'];
        $livro->comprimento = $array['comprimento'];
        $livro->altura = $array['altura'];
        $livro->largura = $array['largura'];
        $livro->diametro = $array['diametro'];
        $livro->peso = $array['peso'];
        $livro->save();

        return $livro;
    }

}
