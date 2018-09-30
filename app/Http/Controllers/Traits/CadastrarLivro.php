<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Imagem;
use App\Models\Livro;
use App\Models\Estoque;

trait CadastrarLivro {

    private $request;

    private function cadastrar(Request $request) {
        $this->request = $request;
        return $this->cadastrarEstoque($request->all());
    }

    private function cadastrarEstoque(array $array) {
        return Estoque::create([
                    'livro' => $this->cadastrarLivro($array)['id'],
                    'estoque' => $array['estoque']
        ]);
    }

    private function cadastrarImagem(array $array) {

        $nomeImagem = md5(date('YYmmddh:i:s')) . '.' . $this->request->capa->extension();

        $diretorio = 'bibliotecas/img/livros/' . md5(Auth::user()->id);

        if (!file_exists($diretorio)) {
            mkdir("$diretorio", 0700);
        }

        $this->request->capa->move($diretorio, $nomeImagem);

        return Imagem::create([
                    'local' => $diretorio . '/',
                    'nome' => $nomeImagem
        ]);
    }

    private function cadastrarLivro(array $array) {
        return Livro::create([
                    'autor' => $array['autor'],
                    'nome' => $array['nome'],
                    'sinopse' => $array['sinopse'],
                    'dono' => Auth::user()->id,
                    'comprimento' => $array['comprimento'],
                    'altura' => $array['altura'],
                    'largura' => $array['largura'],
                    'diametro' => $array['diametro'],
                    'peso' => $array['peso'],
                    'capa' => $this->cadastrarImagem($array)['id']
        ]);
    }

}
