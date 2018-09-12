@extends('layouts.pagina')
@section('content')
<div class="amado-pro-catagory clearfix">
    <!--Cadastro formulario-->
    <div class="container">
        <form action="">
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

                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Digite seu nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu nome" name="nome">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Digite seu sobrenome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu sobrenome" name="sobrenome">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Data de nacimento</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite sua data" name="data">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefone</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu telefone" name="telefone">
                    </div>
                </div>

                <div class="col col-12">
                    <button class="btn btn-warning float-right" disabled data-actives="dados-localizacao" type="button">Próximo</button>

                </div>
            </div>

            <div class="row" id="dados-localizacao">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" aria-describedby="emailHelp" placeholder="Endereco" name="endereco">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" aria-describedby="emailHelp" placeholder="Digite o númeor de endereço" name="numero">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" aria-describedby="emailHelp" placeholder="Digite seu CEP de endereço" name="cep">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="w-100" id="pais" name="estado">
                            <option value="usa">United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="ger">Germany</option>
                            <option value="fra">France</option>
                            <option value="ind">India</option>
                            <option value="aus">Australia</option>
                            <option value="bra">Brazil</option>
                            <option value="cana">Canada</option>
                        </select>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <select class="w-100" id="cidade" name="cidade">
                            <option value="tanto faz">Bica</option>
                        </select>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="referencia">Ponto referencia</label>
                        <input type="text" class="form-control" id="referencia" aria-describedby="emailHelp" placeholder="Digite seu ponto de referencia" name="referencia">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" aria-describedby="emailHelp" placeholder="Digite seu bairro" name="bairro">
                    </div>
                </div>
                <div class="col col-12">
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" aria-describedby="emailHelp" placeholder="Digite o Complemento" name="complemento">
                    </div>
                </div>
                <div class="col col-12">
                    <button class="btn btn-warning float-left" type="button" data-actives="dados-usuario">Anterior</button>

                    <button class="btn btn-warning float-right" disabled data-actives="dados-conta" type="button">Próximo</button>
                </div>

            </div>
            <div class="row" id="dados-conta">
                <div class="col col-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu nome">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Senha</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu nome">
                    </div>
                </div>
                <div class="col col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Repetir Senha</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu nome">
                    </div>
                </div>
                <div class="col col-12">
                    <button class="btn btn-warning float-left" type="button" data-actives="dados-localizacao">Anterior</button>

                    <button class="btn btn-warning float-right" disabled data-actives="dados-conta" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop