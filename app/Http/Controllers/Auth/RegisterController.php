<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use App\Models\Endereco;
use App\Models\Contato;
use App\Models\Cidade;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'nome' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'senha' => 'required|string|min:6|confirmed',
                    'endereco' => 'required|string|max:255',
                    'numero' => 'required|numeric',
                    'cep' => 'required|string|min:9|max:9',
                    'pontoReferencia' => 'max:255',
                    'complemento' => 'max:255',
                    'bairro' => 'required|string|max:255',
                    'estado' => 'required',
                    'cidade' => 'required',
                    'celular' => 'required|string|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function create(array $data) {
        return Usuario::create([
                    'email' => $data['email'],
                    'tipoUsuario' => 1,
                    'senha' => bcrypt($data['senha']),
                    'nome' => $data['nome'],
                    'id_endereco' => $this->endereco($data)['id'],
                    'id_contato' => $this->contato($data)['id'],
        ]);
    }

    /**
     * Retorna a instancia da cidade escolhida pelo usuario
     *
     * @param  array  $data
     * @return \App\Models\Cidade
     */
    private function cidade(array $data) {
        return Cidade::where('id', '=', $data['cidade'])->get()->first();
    }

    /**
     * Retorna a instancia do endereço informado pelo usuario
     *
     * @param  array  $data
     * @return \App\Models\Endereco
     */
    private function endereco(array $data) {

        if ($data['pontoReferencia'] == null || $data['pontoReferencia'] == '') {
            $referencia = '';
        } else {
            $referencia = $data['pontoReferencia'];
        }

        if ($data['complemento'] == null || $data['complemento'] == '') {
            $complemento = '';
        } else {
            $complemento = $data['complemento'];
        }

        return (Endereco::create([
                    'endereco' => $data['endereco'],
                    'numero' => $data['numero'],
                    'cep' => $data['cep'],
                    'pontoReferencia' => $referencia,
                    'complemento' => $complemento,
                    'bairro' => $data['bairro'],
                    'id_cidade' => $this->cidade($data)['id']
        ]));
    }

    /**
     * Retorna a instancia do contato informado pelo usuario
     *
     * @param  array  $data
     * @return \App\Models\Contato
     */
    private function contato(array $data) {
        return Contato::create([
                    'celular' => $data['celular'],
                    'email' => $data['email']
        ]);
    }

}
