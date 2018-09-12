@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Livros</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/livros" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" required autofocus>

                                @if ($errors->has('nome'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('autor') ? ' has-error' : '' }}">
                            <label for="autor" class="col-md-4 control-label">Autor</label>

                            <div class="col-md-6">
                                <input id="autor" type="text" class="form-control" name="autor" required>

                                @if ($errors->has('autor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('autor') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sinopse') ? ' has-error' : '' }}">
                            <label for="sinopse" class="col-md-4 control-label">Sinopse</label>

                            <div class="col-md-6">
                                <input id="sinopse" type="text" class="form-control" name="sinopse" required>

                                @if ($errors->has('sinopse'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sinopse') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('capa') ? ' has-error' : '' }}">
                            <label for="capa" class="col-md-4 control-label">Capa</label>

                            <div class="col-md-6">
                                <input id="capa" type="file" class="form-control" name="capa" required>

                                @if ($errors->has('capa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('capa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('estoque') ? ' has-error' : '' }}">
                            <label for="estoque" class="col-md-4 control-label">Estoque Inicial</label>

                            <div class="col-md-6">
                                <input id="estoque" type="text" class="form-control" name="estoque" required>

                                @if ($errors->has('estoque'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estoque') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
