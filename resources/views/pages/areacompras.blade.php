@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <br>
    <div class="container">
        @if(!empty($errors->first()))
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div  class="alert alert-danger text-center">
                <span class="">{{ $errors->first() }}</span>
            </div>
        </div>
        @endif
        <div>
            <form class="form-group" method="GET" action="/areaCompras/pesquisa">
                <div class="row">
                    <div class="col col-6">
                        <div class="form-group">
                            <label>Inicio</label>
                            <input value="{{ old('dataInicio') }}" type="date" class="form-control" id="dataInicio" 
                                   placeholder="Digite sua data" name="dataInicio">
                        </div>
                    </div>
                    <div class="col col-6">
                        <div class="form-group">
                            <label>Final</label>
                            <input value="{{ old('dataFim') }}" type="date" class="form-control" id="dataFim" 
                                   placeholder="Digite sua data" name="dataFim">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" value="Pesquisar">
                        </div>
                    </div>
                </div>
            </form>

        </div>
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
                        <td>
                            {{ \Carbon\Carbon::parse($venda->created_at)->format('d/m/Y H:m:s')}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <ul class="pagination justify-content-end">
            @if (isset($datas))
            {{$vendas->appends($datas)->links('vendor.pagination.bootstrap-4')}}
            @else
            {{$vendas->links('vendor.pagination.bootstrap-4')}}
            @endif
        </ul>
    </div>
</div>
<br>
@stop