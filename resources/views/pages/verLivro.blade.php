@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div  class="pull-right">
                    <br>
                    <a href="/livros" class="btn btn-danger">Voltar</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="single_product_thumb">
                    <img class="d-block w-100"
                         src="{{asset('')}}{{$livro->capaLivro->local}}{{$livro->capaLivro->nome}}" alt="First slide">
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="">
                    <!-- Product Meta Data -->
                    <div class="">
                        <div class="line"></div>
                        <p class="product-price"></p>
                        <h5 class="text-center">{{$livro->nome}}</h5>
                        <p class="text-center">{{$livro->autor}}</p>
                        <p>Estoque: {{$livro->estoque->quantidade}}</p>
                    </div>

                    <p class="text-justify">{{$livro->sinopse}}</p>
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
@stop