@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <br>

    @if(!empty($errors->first()))
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  class="alert alert-danger text-center">
            <span class="">{{ $errors->first() }}</span>
        </div>
    </div>
    @endif
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  class="pull-right">
            <a href="/livros" class="btn btn-danger">Voltar</a>
        </div>
    </div>
    <!--Cadastro Livros-->
    <div class="container" id="cadastro-livro">
        <div class="row">
            <!--formulario cadastro livros-->
            <div class="col col-12">
                <h4 class="text-warning text-center">Alterar livro - {{$livro->nome}}</h4>
                <form class="form-horizontal" method="POST" action="/alterar" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" value="{{$livro->id}}">
                    <div class="form-group">
                        <label for="nome" class="col-md-12 control-label">Nome</label>

                        <div class="col-md-12 ">
                            <input id="nome" type="text" class="form-control" placeholder="Digite o nome do livro" name="nome" 
                                   value="{{ $livro->nome }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="autor" class="col-md-12 control-label">Autor</label>

                        <div class="col-md-12">
                            <input id="autor" value="{{ $livro->autor }}" type="text" class="form-control" placeholder="Digite o autor do livro" name="autor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sinopse" class="col-md-4 control-label">Sinopse</label>

                        <div class="col-md-12">
                            <textarea id="sinopse" name="sinopse" placeholder="Digite a sinopse do lviro"
                                      class="form-control" rows="10" required="">{{ $livro->sinopse }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img height="250px" width="250px" 
                                 src="{{ asset('')}}{{$livro->capaLivro->local}}{{$livro->capaLivro->nome}}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="capa" class="col-md-12 control-label">Escolher outra capa</label>

                        <div class="col-md-12">
                            <input id="capa" type="file" class="form-control" name="capa">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estoque" class="col-md-12 control-label">Estoque</label>

                        <div class="col-md-12">
                            <input id="estoque" value="{{ $livro->estoque->quantidade}}"
                                   placeholder="Digite o estoqeu do livro" type="number" 
                                   class="form-control" name="estoque" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-4">
                            <button type="submit" class="btn btn-warning pull-right">
                                Alterar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop