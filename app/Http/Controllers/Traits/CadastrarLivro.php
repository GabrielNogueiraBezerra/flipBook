<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CadastrarLivro {

    private function cadastrarEstoque(array $array) {
        return Estoque::create([
                    'livro' => $this->cadastrarLivro($array)['id'],
                    'estoque' => $array['estoque']
        ]);
    }

    private function cadastrarImagem(array $array) {
        return Imagem::create([
                    'local' => '',
                    'nome' => ''
        ]);
    }

    private function cadastrarLivro(array $array) {
        return Livro::create([
                    'autor' => $array['autor'],
                    'nome' => $array['nome'],
                    'sinopse' => $array['sinopse'],
                    'dono' => Auth::user()->id,
                    'capa' => $this->cadastrarImagem($array)['id']
        ]);
    }

}
