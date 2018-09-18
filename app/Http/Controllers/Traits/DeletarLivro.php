<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Imagem;
use App\Models\Estoque;
use App\Models\Livro;

trait DeletarLivro {

    private function deleta($codigo = 0) {
        $livro = Livro::where('id', '=', $codigo)->get()->first();
        if (Auth::user()->id == $livro->donoLivro->id) {
            $imagem = Imagem::where('id', '=', $livro->capaLivro->id)->get()->first();

            $this->deletaEstoque(Estoque::where('id', '=', $livro->estoque->id)->get()->first());

            $this->deletaLivro($livro);

            $this->deletaImagem($imagem);
        }
    }

    private function deletaEstoque(Estoque $estoque) {
        $estoque->delete();
    }

    private function deletaImagem(Imagem $imagem) {
        File::delete($imagem->local . $imagem->nome);
        $imagem->delete();
    }

    private function deletaLivro(Livro $livro) {
        $livro->delete();
    }

}
