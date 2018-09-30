<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AreaCompraController extends Controller {

    private $paginacao = 5;

    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        return view("pages.areacompras")->
                        with('vendas', Venda::where(
                                        'comprador', '=', Auth::user()->id)->paginate($this->paginacao)
        );
    }

    public function pesquisa(Request $request) {

        $this->validator($request->all())->validate();

        return view("pages.areacompras")->with('vendas', Venda::
                                where('comprador', '=', Auth::user()->id)->
                                where('created_at', '>=', $request->input('dataInicio') . ' 00:00:00')->
                                where('created_at', '<=', $request->input('dataFim') . ' 00:00:00')
                                ->paginate($this->paginacao)
                )->with('datas', $request->all());
    }

    private function validator(array $data) {
        return Validator::make($data, [
                    'dataInicio' => 'required|date|date_format:Y-m-d',
                    'dataFim' => 'required|date|date_format:Y-m-d'
        ]);
    }

}
