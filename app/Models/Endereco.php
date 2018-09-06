<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'endereco';
    protected $primaryKey = 'id';
    protected $filliable = [
        'endereco', 'numero', 'cep', 'pontoReferencia', 'complemento', 'bairro'
    ];
    protected $hidden = [
        'id', 'id_cidade'
    ];

    // função que retornará o objeto cidade
    public function cidade() {
        return $this->hasOne('App\Models\Cidade', 'id', 'id_cidade');
    }

    // função responsável por cadastrar o endereço no banco de dados
    public static function create($array = null) {
        $endereco = new Endereco();
        $endereco->endereco = $array['endereco'];
        $endereco->numero = $array['numero'];
        $endereco->cep = $array['cep'];
        $endereco->pontoReferencia = $array['pontoReferencia'];
        $endereco->complemento = $array['complemento'];
        $endereco->bairro = $array['bairro'];
        $endereco->id_cidade = $array['id_cidade'];
        $endereco->save();
        return $endereco;
    }

}
