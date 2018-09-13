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
    <div class="container">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="row" id="menu-abas">
                <div class="col col-sm-4 text-center">
                    <button type="button" class="btn btn-default btn-warning btn-circle btn-lg text-light center" data-actives="dados-usuario">
                        <i class="fa fa-user-alt"></i>
                    </button>
                    <h4>Dados de usuário</h4>

                </div>
                <div class="col col-sm-4 text-center">
                    <button type="button" class="btn btn-default btn-warning btn-circle btn-lg text-light center" disabled data-actives="dados-localizacao">
                        <i class="fas fa-map-marker-alt"></i>
                    </button>
                    <h4>Dados de Localização</h4>

                </div>
                <div class="col col-sm-4 text-center">
                    <button type="button" class="btn btn-default btn-warning btn-circle btn-lg text-light center" disabled data-actives="dados-conta">
                        <i class="fa fa-envelope"></i>
                    </button>
                    <h4>Dados de Conta</h4>
                </div>
            </div>
            <div class="row" id="dados-usuario">
                <div class="col col-4">
                    <div class="form-group">
                        <label for="name" class="col-md-12 control-label">Nome</label>

                        <div class="col-md-12">
                            <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" 
                                   required autofocus placeholder="Digite o seu nome">
                        </div>
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="celular" class="col-md-12 control-label">Celular</label>

                        <div class="col-md-12">
                            <input placeholder="Digite seu celular" id="celular" type="text" class="form-control" name="celular" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="col col-4">
                    <div class="form-group">
                        <label for="email" class="col-md-12 control-label">Endereço de e-mail</label>

                        <div class="col-md-12">
                            <input placeholder="Digite seu endereço de e-mail" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>

                <div class="col col-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-warning float-right" disabled data-actives="dados-localizacao" type="button">Próximo</button                    >
                        </div>
                    </div>
                </div>
            </div>
            <div class="desactive" id="dados-localizacao">
                <div class="row">
                    <div class="col col-9">
                        <div class="form-group">
                            <label for="endereco" class="col-md-12 control-label">Endereço</label>

                            <div class="col-md-12">
                                <input placeholder="Digite seu endereço" id="endereco" type="text" class="form-control" name="endereco" required>
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="numero" class="col-md-12 control-label">Número</label>

                            <div class="col-md-12">
                                <input id="numero" placeholder="Digite o número" type="text" class="form-control" name="numero" required>
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="bairro" class="col-md-12 control-label">Bairro</label>

                            <div class="col-md-12">
                                <input id="bairro" placeholder="Digite o bairro" type="text" class="form-control" name="bairro" 
                                       required>

                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="cep" class="col-md-12 control-label">CEP</label>

                            <div class="col-md-12">
                                <input id="cep" type="text" placeholder="Digite o CEP" class="form-control" name="cep" required>
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="Festado" class="col-md-12 control-label">Estado</label>

                            <div class="col-md-12">
                                <select required id="estado" name="estado" class="form-control" onblur="">
                                    <option>Selecionar...</option>
                                    @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{@$estado->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="cidade" class="col-md-12 control-label">Cidade</label>

                            <div class="col-md-12">
                                <select required id="cidade" name="cidade" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col col-12">
                        <div class="form-group">
                            <label for="pontoReferencia" class="col-md-4 control-label">Ponto de Referência</label>

                            <div class="col-md-12">
                                <textarea rows="4" placeholder="Digite o ponto de referência" id="pontoReferencia" type="text" class="form-control" name="pontoReferencia"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="form-group">
                            <label for="complemento" class="col-md-12 control-label">Complemento</label>

                            <div class="col-md-12">
                                <textarea rows="4" id="complemento" placeholder="Digite o complemento" type="text" class="form-control" name="complemento"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col col-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-warning float-left" type="button" data-actives="dados-usuario">Anterior</button>

                                <button class="btn btn-warning float-right" disabled data-actives="dados-conta" type="button">Próximo</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="desactive" id="dados-conta">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="col-md-12 control-label">Senha</label>

                            <div class="col-md-12">
                                <input id="senha" type="password" placeholder="Digite sua senha" class="form-control" name="senha" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="senha_confirmation" class="col-md-12 control-label">Confirmar Senha</label>

                            <div class="col-md-12">
                                <input id="senha_confirmation" type="password" placeholder="Confirme a sua senha" class="form-control" name="senha_confirmation" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col col-12">
                                <button class="btn btn-warning float-left" type="button" data-actives="dados-localizacao">Anterior</button>

                                <button class="btn btn-warning float-right" disabled data-actives="dados-conta" type="submit">Cadastrar</button>                      </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>
@stop