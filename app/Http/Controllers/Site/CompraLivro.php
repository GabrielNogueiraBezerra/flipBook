<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Livro;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

class CompraLivro extends Controller {

    public function index($codigo = 0) {
        $livro = Livro::findOrFail($codigo);
        if (Auth::check()) {
            $frete = new PrecoPrazo();
            $frete->setCodigoServico(Data::PAC)
                    ->setCepOrigem(str_replace("-", "", $livro->donoLivro->endereco->cep))   # apenas numeros, sem hifen(-)
                    ->setCepDestino(str_replace("-", "", Auth::user()->endereco->cep)) # apenas numeros, sem hifen(-)
                    ->setComprimento($livro->comprimento)              # obrigatorio
                    ->setAltura($livro->altura)                   # obrigatorio
                    ->setLargura($livro->largura)                  # obrigatorio
                    ->setDiametro($livro->diametro)                 # obrigatorio
                    ->setPeso($livro->peso);                   # obrigatorio

            $result = $frete->calculate();

            $preco1 = str_replace(",", ".", $result['cServico']['Valor']) + 1.00;

            $preco = 'R$ ' . number_format($preco1, 2, '.', '');
        } else {
            $preco = 'Realize login para ver preço.';
        }

        return view('pages.compraLivro')->with('livro', $livro)->with('preco', $preco);
    }

}
