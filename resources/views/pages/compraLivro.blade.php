@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <br>
    <div class="container">
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
                        <p class="text-justify">{{$preco}}</p>
                    </div>

                    <p class="text-justify">{!! substr($livro->sinopse, 0, 255) !!}...</p>
                    <a href="/realizarCompraLivro/{{$livro->id}}" class="btn amado-btn w-100">Comprar</a>
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
@stop