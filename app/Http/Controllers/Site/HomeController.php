<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Livro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    private $paginate = 6;

    public function index() {
        if (Auth::check()) {
            return view('pages.home')->with('livros', Livro::join('estoque', 'estoque.livro', '=', 'livro.id')->
                                    select('livro.*', 'estoque.quantidade')->
                                    where('estoque.quantidade', '>', 0)->
                                    where('livro.dono', '<>', Auth::user()->id)->paginate($this->paginate))->with('pontos', Auth::user()->pontos);
        } else {
            return view('pages.home')->with('livros', Livro::join('estoque', 'estoque.livro', '=', 'livro.id')->
                                    select('livro.*', 'estoque.quantidade')->
                                    where('estoque.quantidade', '>', 0)->
                                    paginate($this->paginate));
        }
    }

    public function pesquisa(Request $request) {
        if (Auth::check()) {
            return view('pages.home')->with('livros', Livro::join('estoque', 'estoque.livro', '=', 'livro.id')->
                                    select('livro.*', 'estoque.quantidade')->
                                    where('estoque.quantidade', '>', 0)->
                                    where('livro.nome', 'like', '%' . $request->input('pesquisa') . '%')->
                                    where('livro.dono', '<>', Auth::user()->id)->
                                    paginate($this->paginate))->with('pesquisas', $request->all())->with('pontos', Auth::user()->pontos);
        } else {
            return view('pages.home')->with('livros', Livro::join('estoque', 'estoque.livro', '=', 'livro.id')->
                                    select('livro.*', 'estoque.quantidade')->
                                    where('estoque.quantidade', '>', 0)->
                                    where('livro.nome', 'like', '%' . $request->input('pesquisa') . '%')->
                                    paginate($this->paginate))->with('pesquisas', $request->all());
        }
    }

}
