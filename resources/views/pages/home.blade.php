@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    @foreach($livros as $livro)
    {{$livro->capa}}
    <div class="single-products-catagory clearfix">
        <a href="#">
            <img src="{{@$livro->capa->local}}{{@$livro->capa->nome}}" alt="">
            <!-- Hover Content -->
            <div class="hover-content">
                <div class="line"></div>
                <p>{{@$livro->nome}}</p>
            </div>
        </a>
    </div>
    @endforeach
    
</div>
@stop