<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AreaVendasController extends Controller {

    private $paginacao = 5;

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.areavendas')->
                        with('vendas', Venda::join('livro', 'livro.id', '=', 'venda.livro')->
                                select('venda.id as codigo', 'venda.comprador', 'venda.livro', 'venda.status', 'venda.valor', 'venda.created_at')->
                                where('livro.dono', '=', Auth::user()->id)->paginate($this->paginacao));
    }

    public function pesquisa(Request $request) {

        $this->validator($request->all())->validate();

        return view('pages.areacompras')->
                        with('vendas', Venda::join('livro', 'livro.id', '=', 'venda.livro')->
                                select('venda.id as codigo', 'venda.comprador', 'venda.livro', 'venda.status', 'venda.valor', 'venda.created_at')->
                                where('livro.dono', '=', Auth::user()->id)->
                                where('venda.created_at', '>=', $request->input('dataInicio') . ' 00:00:00')->
                                where('venda.created_at', '<=', $request->input('dataFim') . ' 00:00:00')
                                ->paginate($this->paginacao))->with('datas', $request->all());
    }

    private function validator(array $data) {
        return Validator::make($data, [
                    'dataInicio' => 'required|date|date_format:Y-m-d',
                    'dataFim' => 'required|date|date_format:Y-m-d'
        ]);
    }

}
