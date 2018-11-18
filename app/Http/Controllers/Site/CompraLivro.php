<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Livro;
use App\Models\Venda;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;

class CompraLivro extends Controller {

    public function index($codigo = 0) {
        $livro = Livro::findOrFail($codigo);

        if ($livro->estoque->quantidade == 0) {
            return redirect()->back();
        }

        if (Auth::check()) {
            $preco = 'R$ ' . number_format($this->preco($livro), 2, '.', '');
        } else {
            $preco = 'Realize login para ver preço.';
        }

        return view('pages.compraLivro')->with('livro', $livro)->with('preco', $preco);
    }

    public function mostraDetalhesPreVenda($codigo = 0) {
        $livro = Livro::findOrFail($codigo);

        if ($livro->estoque->quantidade == 0) {
            return redirect()->back();
        }

        if (Auth::check()) {
            $preco = 'R$ ' . number_format($this->preco($livro), 2, '.', '');
        } else {
            $preco = 'Realize login para ver preço.';
        }

        return view('pages.compraLivro')->with('livro', $livro)->with('preco', $preco);
    }

    public function comprar($id = 0) {

        if (Auth::check()) {
            $livro = Livro::FindOrFail($id);

            $venda = Venda::create([
                        'valor' => $this->preco($livro),
                        'comprador' => Auth::user()->id,
                        'livro' => $livro->id
            ]);

            Mail::to(Auth::user()->contato->email)->send(new SendMailUser($venda));
        }

        return redirect()->route("areaCompras");
    }

    private function preco(Livro $livro) {
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
        return $preco1;
    }

}
