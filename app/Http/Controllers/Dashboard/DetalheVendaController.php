<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\Venda;

class DetalheVendaController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index($codigo = 0) {
        $venda = Venda::FindOrFail($codigo);
        if ($venda->compradorVenda->id != Auth::user()->id) {
            return redirect('/');
        } else {
            return view('pages.informacoesVenda')->with('venda', $venda);
        }
    }

}
