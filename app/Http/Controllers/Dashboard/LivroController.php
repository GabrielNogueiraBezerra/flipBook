<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Imagem;
use App\Models\Livro;
use App\Models\Estoque;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CadastrarLivro;
use App\Http\Controllers\Traits\AlterarLivro;
use App\Http\Controllers\Traits\DeletarLivro;

class LivroController extends Controller {

    private $paginacao = 5;

    use CadastrarLivro,
        AlterarLivro,
        DeletarLivro;

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.livro')->with('livros', Livro::where('dono', '=', Auth::user()->id)->paginate($this->paginacao));
    }

    public function pesquisa(Request $request) {
        return view('pages.livro')->with('livros', Livro::
                                where('dono', '=', Auth::user()->id)->
                                where('nome', 'like', '%' . $request->input('pesquisa') . '%')->
                                paginate($this->paginacao))->with('pesquisar', $request->all());
    }

    public function mostrarFormAlterarLivro($codigo = 0) {
        return view('pages.alteraLivro')->with("livro", Livro::where("id", "=", $codigo)->get()->first());
    }

    public function mostrarFormVerLivro($codigo = 0) {
        $livro = Livro::where("id", "=", $codigo)->get()->first();
        if ($livro) {
            return view('pages.verLivro')->with("livro", $livro);
        } else {
            return redirect()->back();
        }
    }

    public function excluir($codigo = 0) {
        $this->deleta($codigo);

        return redirect()->back();
    }

    public function salvar(Request $request) {
        $this->validator($request->all())->validate();
        $this->cadastrar($request);

        return redirect()->back();
    }

    public function alterar(Request $request) {
        $this->validator($request->all())->validate();
        $this->modificar($request);

        return redirect()->back();
    }

    public function deletaCapa($codigo = 0) {
        $capa = Imagem::where('id', '=', $codigo);
        $capa->delete();

        return redirect()->back();
    }

    public function validator(array $data) {

        $regex = "/^[0-9]+(\.[0-9][0-9]?)?$/";

        return Validator::make($data, [
                    'nome' => 'required|string|max:255',
                    'autor' => 'required|string|max:255',
                    'sinopse' => 'required|string',
                    'capa' => 'image|mimes:jpeg,jpg,png',
                    'estoque' => 'required|numeric|min:0',
                    'comprimento' => 'required|regex:' . $regex . '|min:16',
                    'altura' => 'required|regex:' . $regex . '|min:2',
                    'largura' => 'required|regex:' . $regex . '|min:11',
                    'diametro' => 'required|regex:' . $regex,
                    'peso' => 'required|regex:' . $regex . '|min:2'
        ]);
    }

}
