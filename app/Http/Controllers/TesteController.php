<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;

class TesteController extends Controller {

    public function teste() {
        
        dd(Cidade::where('id', '=', 100)->get()->first());
    }

}
