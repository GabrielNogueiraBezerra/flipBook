<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Livro;

class HomeController extends Controller {

    public function index() {
        return view('pages.home')->with('livros', Livro::all());
    }
}
