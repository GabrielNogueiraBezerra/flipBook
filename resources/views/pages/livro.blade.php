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
    <!--Cadastro Livros-->
    <div class="container" id="cadastro-livro">
        <div class="row">
            <!--formulario cadastro livros-->
            <div class="col col-6">
                <h4 class="text-warning text-center">Cadastro de livro</h4>
                <form class="form-horizontal" method="POST" action="/livros" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nome" class="col-md-12 control-label">Nome</label>

                        <div class="col-md-12 ">
                            <input id="nome" type="text" class="form-control" placeholder="Digite o nome do livro" name="nome" 
                                   value="{{ old('nome') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="autor" class="col-md-12 control-label">Autor</label>

                        <div class="col-md-12">
                            <input id="autor" value="{{ old('autor') }}" type="text" class="form-control" placeholder="Digite o autor do livro" name="autor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sinopse" class="col-md-4 control-label">Sinopse</label>

                        <div class="col-md-12">
                            <textarea id="sinopse" name="sinopse" placeholder="Digite a sinopse do lviro" class="form-control" rows="4" required="">{{ old('sinopse') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="capa" class="col-md-12 control-label">Capa</label>

                        <div class="col-md-12">
                            <input id="capa" type="file" class="form-control" name="capa" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estoque" class="col-md-12 control-label">Estoque Inicial</label>

                        <div class="col-md-12">
                            <input id="estoque" value="{{ old('estoque') }}" placeholder="Digite o estoqeu do livro" type="text" class="form-control" name="estoque" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-4">
                            <button type="submit" class="btn btn-warning pull-right">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--lista de livros-->
            <div class="col col-6" id="lista-livros">
                <h4>Livros cadastrados</h4>
                <div class="list-group">
                    @foreach($livros as $livro)
                    <a href="#" class="list-group-item list-group-item-action" id-livro="{{@$livro->id}}">{{@$livro->nome}}</a>
                    @endforeach
                </div>
                <br>
                <div id="lista-opcoes">
                    <a href="" class="btn btn-large btn-block btn-primary disabled" name="ver-livro">Ver livro</a>
                    <a href="" class="btn btn-large btn-block btn-warning disabled" name="alterar-livro">Alterar livro</a>
                    <a href="" class="btn btn-large btn-block btn-danger disabled" name="excluir-livro">Excluir livro</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop