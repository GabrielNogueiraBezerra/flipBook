@extends('layouts.pagina')
@section('content')
<br>

<div class="amado-pro-catagory clearfix text-center">
    <br>
    <h2>Pontuação: {{@$pontos}}</h2>
    <small style="font-size: 12px">A pontuação é acrescida em relação a quantidade de vendas que foram pagas na sua conta.</small>
    <br>
    <br>
</div>
@if (count($livros) > 0)
<div class="amado-pro-catagory clearfix">
    <div class="container">
        <ul class="pagination justify-content-end">
            @if (isset($pesquisas))
            {{$livros->appends($pesquisas)->links('vendor.pagination.bootstrap-4')}}
            @else
            {{$livros->links('vendor.pagination.bootstrap-4')}}
            @endif
        </ul>
    </div>
</div>
<div class="amado-pro-catagory clearfix">
    <br>
    @foreach($livros as $livro)
    <div class="single-products-catagory clearfix">
        <a href="/compraLivro/{{@$livro->id}}">
            <img src="{{@$livro->capaLivro->local}}{{@$livro->capaLivro->nome}}" alt="">
            <!-- Hover Content -->
            <div class="hover-content">
                <div class="line"></div>
                <p>{{@$livro->nome}}</p>
            </div>
        </a>
    </div>
    @endforeach
    <br>
</div>
@else
<div class="container">
    <div class="text-center">
        <div class="alert alert-warning">
            <strong>Atenção!</strong> Não existem livros com essa nome, tente utilizar outro nome para a pesquisa.
        </div>
        <div class="row">
            <div class="container">
                <form class="form-inline" method="GET" action="/pesquisa">
                    <input id="pesquisa" name="pesquisa" class="form-control col-lg-8 col-md-8" 
                           type="search" placeholder="Digite a sua pesquisa">
                    <button class="btn btn-block btn-warning col-lg-4 col-md-4" 
                            type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<br>
@stop