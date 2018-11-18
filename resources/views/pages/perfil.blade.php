@extends('layouts.pagina')
@section('content')
<br>
<div class="amado-pro-catagory clearfix">

    @if(!empty($errors->first()))
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div  class="alert alert-danger text-center">
            <span class="">{{ $errors->first() }}</span>
        </div>
    </div>
    @endif
    <form method="POST" action="/perfil/update">
        {{ csrf_field() }}
        <div class="col-12 col">
            <div class="row">
                <div class="col col-4">
                    <div class="form-group">
                        <label for="name" class="col-md-12 control-label">Nome</label>

                        <div class="col-md-12">
                            <input id="nome" type="text" class="form-control" name="nome" 
                                   value="{{ $usuario->nome }}" 
                                   required  placeholder="Digite o seu nome">
                        </div>
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="celular" class="col-md-12 control-label">Celular</label>

                        <div class="col-md-12">
                            <input placeholder="Digite seu celular" id="celular" 
                                   type="text" value="{{ $usuario->contato->celular }}" class="form-control" name="celular" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="email" class="col-md-12 control-label">Endereço de e-mail</label>

                        <div class="col-md-12">
                            <input disabled=""  placeholder="Digite seu endereço de e-mail" id="email" type="email"
                                   class="form-control" name="email" value="{{ $usuario->contato->email }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-9">
                    <div class="form-group">
                        <label for="endereco" class="col-md-12 control-label">Endereço</label>

                        <div class="col-md-12">
                            <input placeholder="Digite seu endereço" value="{{ $usuario->endereco->endereco }}" id="endereco" type="text" class="form-control" name="endereco" required>
                        </div>
                    </div>
                </div>
                <div class="col col-3">
                    <div class="form-group">
                        <label for="numero" class="col-md-12 control-label">Número</label>

                        <div class="col-md-12">
                            <input id="numero" value="{{ $usuario->endereco->numero }}"  placeholder="Digite o número" type="text" class="form-control" name="numero" required>
                        </div>
                    </div>
                </div>
                <div class="col col-3">
                    <div class="form-group">
                        <label for="bairro" class="col-md-12 control-label">Bairro</label>

                        <div class="col-md-12">
                            <input id="bairro" value="{{ $usuario->endereco->bairro }}"
                                   placeholder="Digite o bairro" type="text" 
                                   class="form-control" name="bairro" 
                                   required>

                        </div>
                    </div>
                </div>
                <div class="col col-3">
                    <div class="form-group">
                        <label for="cep" class="col-md-12 control-label">CEP</label>

                        <div class="col-md-12">
                            <input id="cep" type="text"  value="{{ $usuario->endereco->cep }}" 
                                   placeholder="Digite o CEP"
                                   class="form-control" name="cep" required>
                        </div>
                    </div>
                </div>
                <div class="col col-3">
                    <div class="form-group">
                        <label for="Festado" class="col-md-12 control-label">Estado</label>

                        <div class="col-md-12">
                            <select autofocus required id="estado" name="estado" class="form-control" onblur="">
                                <option>Selecionar...</option>
                                @foreach($estados as $estado)
                                @if($estado->id == $usuario->endereco->cidade->estado->id)
                                <option selected="selected" value="{{$estado->id}}">{{@$estado->descricao}}</option>
                                @else
                                <option value="{{$estado->id}}">{{@$estado->descricao}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col col-3">
                    <div class="form-group">
                        <label for="cidade" class="col-md-12 control-label">Cidade</label>

                        <div class="col-md-12">
                            <select autofocus required id="cidade" name="cidade" class="form-control">
                                <option value="{{$usuario->endereco->cidade->id}}">{{$usuario->endereco->cidade->descricao}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col col-12">
                    <div class="form-group">
                        <label for="pontoReferencia" class="col-md-4 control-label">Ponto de Referência</label>

                        <div class="col-md-12">
                            <textarea rows="4" placeholder="Digite o ponto de referência" id="pontoReferencia"
                                      type="text" class="form-control" name="pontoReferencia">{{$usuario->endereco->pontoReferencia}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                        <label for="complemento" class="col-md-12 control-label">Complemento</label>

                        <div class="col-md-12">
                            <textarea rows="4" id="complemento" placeholder="Digite o complemento" type="text" class="form-control" name="complemento">{{$usuario->endereco->complemento}}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="col-md-12 control-label">Senha</label>

                        <div class="col-md-12">
                            <input  id="senha" type="password" placeholder="Digite sua senha" class="form-control" name="senha">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha_confirmation" class="col-md-12 control-label">Confirmar Senha</label>

                        <div class="col-md-12">
                            <input id="senha_confirmation" type="password" placeholder="Confirme a sua senha" class="form-control" name="senha_confirmation" 
                                   >
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col col-12">
                            <button class="btn btn-warning float-right" type="submit">Atualizar</button>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<br>
@stop