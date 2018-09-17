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
        <form method="POST" action="{{ route('login') }}">
            {{csrf_field()}}
            <div class="form-group">
                <div class="form-group">
                    <label for="email" class="col-md-12 control-label">Endereço de E-mail</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha" class="col-md-12 control-label">Senha</label>

                    <div class="col-md-12">
                        <input id="senha" type="password" class="form-control" name="senha" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-warning">
                            Entrar
                        </button>

                        <a class="btn btn-link" href="/register">
                            Não possui cadastro?
                        </a>
                    </div>
                </div>

        </form>
    </div>

    <br>
</div>
@stop