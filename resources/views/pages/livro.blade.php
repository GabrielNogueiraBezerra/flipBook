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
                            <input id="estoque" value="{{ old('estoque') }}"
                                   placeholder="Digite o estoque do livro" type="number" 
                                   class="form-control" name="estoque" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comprimento" class="col-md-12 control-label">Comprimento (minimo: 16)</label>

                        <div class="col-md-12">
                            <input id="comprimento" value="{{ old('comprimento') }}"
                                   placeholder="Digite o comprimento do livro" type="text" 
                                   class="form-control" name="comprimento" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="altura" class="col-md-12 control-label">Altura (minimo: 2)</label>

                        <div class="col-md-12">
                            <input id="altura" value="{{ old('altura') }}"
                                   placeholder="Digite a altura do livro" type="text" 
                                   class="form-control" name="altura" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="largura" class="col-md-12 control-label">Largura (minimo: 11)</label>

                        <div class="col-md-12">
                            <input id="largura" value="{{ old('largura') }}"
                                   placeholder="Digite a largura do livro" type="text" 
                                   class="form-control" name="largura" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="diametro" class="col-md-12 control-label">Diametro</label>

                        <div class="col-md-12">
                            <input id="diametro" value="{{ old('diametro') }}"
                                   placeholder="Digite o diametro do livro" type="text" 
                                   class="form-control" name="diametro" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="peso" class="col-md-12 control-label">Peso (minimo: 2)</label>

                        <div class="col-md-12">
                            <input id="peso" value="{{ old('peso') }}"
                                   placeholder="Digite o peso do livro" type="text" 
                                   class="form-control" name="peso" required>
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
                <h4 class="text-center">Livros cadastrados</h4>
                <form class="form-inline" method="GET" action="/livros/buscar/livros">
                    <input id="pesquisa" name="pesquisa" class="form-control col-lg-8 col-md-8" 
                           type="search" placeholder="Digite a sua pesquisa">
                    <button class="btn btn-block btn-warning col-lg-4 col-md-4" 
                            type="submit">Pesquisar</button>
                </form>
                <br>
                <div class="list-group">
                    @foreach($livros as $livro)
                    <a href="#" class="list-group-item list-group-item-action" id-livro="{{@$livro->id}}">{{@$livro->nome}}</a>
                    @endforeach
                </div>
                <br>
                <ul class="pagination">
                    @if (isset($pesquisar))
                    {{$livros->appends($pesquisar)->links('vendor.pagination.bootstrap-4')}}
                    @else
                    {{$livros->links('vendor.pagination.bootstrap-4')}}
                    @endif
                </ul>
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