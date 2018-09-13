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

class LivroController extends Controller {

    use CadastrarLivro,
        AlterarLivro;

    public function __construct() {
        //$this->middleware('auth');
    }

    public function index() {
        return view('pages.livro');
    }

    public function salvar(Request $request) {
        $this->validator($request->all())->validate();
        $this->cadastrarEstoque($request->all());
    }

    public function validator(array $data) {
        return Validator::make($data, [
                    'nome' => 'required|string|max:255',
                    'autor' => 'required|string|max:255',
                    'sinopse' => 'required|string|max:255',
                    'capa' => 'image|mimes:jpeg,jpg,png'
        ]);
    }

}
