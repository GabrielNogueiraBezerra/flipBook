<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Livro;
use App\Models\Estoque;
use App\Models\Imagem;

trait AlterarLivro {

    private $livro;

    private function carregaLivro(Request $request) {
        $this->livro = Livro::where('id', '=', $request->input('id'))->get()->first();
    }

    private function modificar(Request $request) {
        $this->carregaLivro($request);

        $this->modificaEstoque($request);

        $this->modificaImagem($request);

        $this->modificaLivro($request);
    }

    private function modificaEstoque(Request $request) {
        return Estoque::alterar([
                    "id" => $this->livro->estoque->id,
                    "estoque" => $request->input('estoque')
        ]);
    }

    private function modificaImagem(Request $request) {
        if ($request->capa != null) {
            File::delete($this->livro->capaLivro->local . $this->livro->capaLivro->nome);

            $nomeImagem = md5(date('YYmmddh:i:s')) . '.' . $request->capa->extension();

            $diretorio = 'bibliotecas/img/livros/' . md5(Auth::user()->id);

            if (!file_exists($diretorio)) {
                mkdir("$diretorio", 0700);
            }

            $request->capa->move($diretorio, $nomeImagem);

            return Imagem::alterar([
                        "id" => $this->livro->capaLivro->id,
                        "local" => $diretorio . '/',
                        "nome" => $nomeImagem
            ]);
        }
    }

    private function modificaLivro(Request $request) {
        return Livro::alterar([
                    "id" => $this->livro->id,
                    "nome" => $request->input('nome'),
                    "autor" => $request->input('autor'),
                    "sinopse" => $request->input('sinopse')
        ]);
    }

}
