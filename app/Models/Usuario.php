<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable {

    use Notifiable;

    /*
     * $table -> Nome da Tabela
     * $primaryKey -> Nome da Chave Primaria
     * $filliable -> Campos do mapeamento do banco de dados para consultas e inserções
     * $hidden -> Campos que ficaraõ ocultos nas consultas desse modelo
     */

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $filliable = [
        'id', 'tipo_usuario', 'email', 'senha', 'nome', 'pontos'
    ];
    protected $hidden = [
        'id', 'id_endereco', 'id_contato'
    ];

    // função que retornará o objeto endereco
    public function endereco() {
        return $this->hasOne('App\Models\Endereco', 'id', 'id_endereco');
    }

    // função que retornará o objeto contato
    public function contato() {
        return $this->hasOne('App\Models\Contato', 'id', 'id_contato');
    }

    //função que cadastrará o usuário no banco de dados
    public static function create($array = null) {
        $usuario = new Usuario();
        $usuario->email = $array['email'];
        $usuario->tipo_usuario = $array['tipoUsuario'];
        $usuario->senha = $array['senha'];
        $usuario->nome = $array['nome'];
        $usuario->id_endereco = $array['id_endereco'];
        $usuario->id_contato = $array['id_contato'];
        $usuario->save();
        return $usuario;
    }

    public static function udpateUsuario($array = null) {
        $usuario = Usuario::FindOrFail($array['idUsuario']);
        $usuario->tipo_usuario = $array['tipoUsuario'];
        if ($array['senha'] != '') {
            $usuario->senha = $array['senha'];
        }
        $usuario->nome = $array['nome'];
        $usuario->save();
        return $usuario;
    }

}
