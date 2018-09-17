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
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.livro')->with('livros', Livro::where('dono', '=', Auth::user()->id)->get());
    }

    public function salvar(Request $request) {
        $this->validator($request->all())->validate();
        $this->cadastrar($request);

        return redirect()->back();
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
