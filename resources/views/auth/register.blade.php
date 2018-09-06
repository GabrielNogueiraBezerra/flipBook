@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('tipoUsuario') ? ' has-error' : '' }}">
                            <label for="tipoUsuario" class="col-md-4 control-label">Tipo Usuario</label>

                            <div class="col-md-6">
                                <select required id="tipoUsuario" name="tipoUsuario" class="form-control">
                                    <option value="0">Administrador</option>
                                    <option value="1">Vendedor</option>
                                    <option value="2">Usuario Normal</option>
                                </select>

                                @if ($errors->has('tipoUsuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipoUsuario') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" 
                                       required autofocus>

                                @if ($errors->has('nome'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nome') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Endereço de e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('senha') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="senha" type="password" class="form-control" name="senha" required>

                                @if ($errors->has('senha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('senha') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="senha_confirmation" class="col-md-4 control-label">Confirmar Senha</label>

                            <div class="col-md-6">
                                <input id="senha_confirmation" type="password" class="form-control" name="senha_confirmation" 
                                       required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                            <label for="endereco" class="col-md-4 control-label">Endereço</label>

                            <div class="col-md-6">
                                <input id="endereco" type="text" class="form-control" name="endereco" required>

                                @if ($errors->has('endereco'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('endereco') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                            <label for="numero" class="col-md-4 control-label">Número</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" name="numero" required>

                                @if ($errors->has('numero'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numero') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                            <label for="cep" class="col-md-4 control-label">CEP</label>

                            <div class="col-md-6">
                                <input id="cep" type="text" class="form-control" name="cep" required>

                                @if ($errors->has('cep'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cep') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                            <label for="cep" class="col-md-4 control-label">CEP</label>

                            <div class="col-md-6">
                                <input id="cep" type="text" class="form-control" name="cep" required>

                                @if ($errors->has('cep'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cep') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pontoReferencia') ? ' has-error' : '' }}">
                            <label for="pontoReferencia" class="col-md-4 control-label">Ponto de Referência</label>

                            <div class="col-md-6">
                                <input id="pontoReferencia" type="text" class="form-control" name="pontoReferencia">

                                @if ($errors->has('pontoReferencia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pontoReferencia') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                            <label for="complemento" class="col-md-4 control-label">Complemento</label>

                            <div class="col-md-6">
                                <input id="complemento" type="text" class="form-control" name="complemento">

                                @if ($errors->has('complemento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('complemento') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                            <label for="bairro" class="col-md-4 control-label">Bairro</label>

                            <div class="col-md-6">
                                <input id="bairro" type="text" class="form-control" name="bairro" 
                                       required>

                                @if ($errors->has('bairro'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bairro') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                            <label for="Festado" class="col-md-4 control-label">Estado</label>

                            <div class="col-md-6">
                                <select required id="estado" name="estado" class="form-control" onblur="">
                                    <option>Selecionar...</option>
                                    @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{@$estado->descricao}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('estado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estado') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                            <label for="cidade" class="col-md-4 control-label">Cidade</label>

                            <div class="col-md-6">
                                <select required id="cidade" name="cidade" class="form-control">
                                </select>

                                @if ($errors->has('cidade'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cidade') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                            <label for="celular" class="col-md-4 control-label">Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control" name="celular" 
                                       required>

                                @if ($errors->has('celular'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('celular') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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


