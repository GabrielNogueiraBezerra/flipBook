<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Usuario;

class PerfilController extends Controller {
    

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.perfil')->with('usuario', Auth::user())->with('estados', Estado::all());
    }

    public function getCidades($idEstado = 0) {
        echo json_encode(Cidade::where('id_estado', '=', $idEstado)->get());
    }

    public function update(Request $request) {
        $this->validator($request->all())->validate();

        print_r($request->all());

        $this->contato([
            'idContato' => Auth::user()->contato->id,
            'celular' => $request->input('celular'),
            'email' => $request->input('email'),
        ]);

        $this->endereco([
            'idEndereco' => Auth::user()->endereco->id,
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'cep' => $request->input('cep'),
            'pontoReferencia' => $request->input('pontoReferencia'),
            'complemento' => $request->input('complemento'),
            'bairro' => $request->input('bairro'),
            'id_cidade' => $this->cidade($request->all())['id']
        ]);

        $this->updateUsuario([
            'idUsuario' => Auth::user()->id,
            'senha' => bcrypt($request->input('senha')),
            'nome' => $request->input('nome')
        ]);

        return redirect()->back();
    }

    private function cidade(array $data) {
        return Cidade::where('id', '=', $data['cidade'])->get()->first();
    }

    protected function validator(array $data) {
        if ($data['senha'] != '') {
            return Validator::make($data, [
                        'nome' => 'required|string|max:255',
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

        return Validator::make($data, [
                    'nome' => 'required|string|max:255',
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

    protected function updateUsuario(array $data) {
        return Usuario::udpateUsuario([
                    'idUsuario' => $data['idUsuario'],
                    'tipoUsuario' => 1,
                    'senha' => $data['senha'],
                    'nome' => $data['nome']
        ]);
    }

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

        return (Endereco::updateEndereco([
                    'idEndereco' => $data['idEndereco'],
                    'endereco' => $data['endereco'],
                    'numero' => $data['numero'],
                    'cep' => $data['cep'],
                    'pontoReferencia' => $referencia,
                    'complemento' => $complemento,
                    'bairro' => $data['bairro'],
                    'id_cidade' => $data['id_cidade']
        ]));
    }

    private function contato(array $data) {
        return Contato::updateContato([
                    'idContato' => $data['idContato'],
                    'celular' => $data['celular'],
                    'email' => $data['email']
        ]);
    }

}
