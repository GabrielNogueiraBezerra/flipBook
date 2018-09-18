@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <br>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Livro</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data/Hora Compra</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendas as $venda)
                    <tr>
                        <th scope="row">{{@$venda->id}}</th>
                        <td>{{@$venda->livroComprado->nome}}</td>
                        <td>R$ {{@number_format($venda->valor, 2)}}</td>
                        <td>
                            @if ($venda->status == 0)
                            Compra Nova
                            @elseif($venda->status == 1)
                            Encaminhada
                            @elseif ($login_error == 2)
                            Entregue
                            @endif
                        </td>
                        <td>{{@$venda->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop