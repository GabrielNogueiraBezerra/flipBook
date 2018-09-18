<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Support\Facades\Auth;

class AreaCompraController extends Controller {
   
    
    
    public function __construct() {
        $this->middleware("auth");
    }
    
    public function index(){
        return view("pages.areacompras")->
                with('vendas', 
                        Venda::where('comprador','=', Auth::user()->id)->get());
    }
}
