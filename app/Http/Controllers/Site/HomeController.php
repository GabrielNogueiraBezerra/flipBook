<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Livro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function index() {
        return view('pages.home')->with('livros', Livro::all());
    }

    public function teste() {
        echo "a<br>";

        
        
        
        echo md5(date('YYmmddh:i:s'));
        echo "<br>";
        echo $hashed;
    }

}
