<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Support\Facades\Auth;

class AreaVendasController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.areavendas')->
                        with('vendas', Venda::join('livro', 'livro.id', '=', 'venda.livro')->
                                select('venda.id as codigo', 'venda.comprador', 'venda.livro', 'venda.status', 'venda.valor', 'venda.created_at')->
                                where('livro.dono', '=', Auth::user()->id)->get());
    }
    

}
