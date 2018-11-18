@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <br>
    <div class="container">
        <div class="row">
            <div class="col col-112">
                <div class="pull-right">
                    <a href="/areaCompras" class="btn btn-warning btn-sm">Voltar</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col col-6">
                <p>Numero do pedido: {{$venda->id}}</p>
                <p>Data da Compra: {{ \Carbon\Carbon::parse($venda->created_at)->format('d/m/Y H:m:s')}}</p>
                <p>Valor: R$ {{@number_format($venda->valor, 2)}}</p>

                <p> Status: 
                    @if ($venda->status == 0)
                    Compra Nova
                    @elseif($venda->status == 1)
                    Paga
                    @elseif($venda->status == 2)
                    Encaminhada
                    @elseif ($login_error == 1)
                    Entregue
                    @endif
                </p>

                @if ($venda->status == 0)
                <div class="text-center">
                    <a  target="_blank" href="/boleto/{{$venda->id}}" class="btn btn-danger btn-Lg">Imprimir Boleto</a></p>
                </div>
                @endif
            </div>
            <div class="col col-6">
                <img src="{{asset('')}}{{$venda->livroComprado->capaLivro->local}}{{$venda->livroComprado->capaLivro->nome}}">
            </div>
        </div>
    </div>
    <br>
</div>
@stop