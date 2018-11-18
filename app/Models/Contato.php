<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model {
    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'contato';
    protected $primaryKey = 'id';
    protected $filliable = [
        'celular', 'email'
    ];
    protected $hidden = [
        'id'
    ];

    // função responsavel por cadastrar o contato no banco de dados

    public static function create($array = null) {
        $contato = new Contato();
        $contato->celular = $array['celular'];
        $contato->email = $array['email'];
        $contato->save();
        return $contato;
    }

    public static function updateContato($array = null) {
        $contato = Contato::FindOrFail($array['idContato']);
        $contato->celular = $array['celular'];
        $contato->save();
        return $contato;
    }

}
