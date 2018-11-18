<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Livro;
use App\Models\Usuario;
use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

class BoletoController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }

    private $comprador;
    private $venda;
    private $livro;
    private $vendedor;
    private $dadosboleto;
    private $dados;

    public function index($id = 0) {
        $this->venda = Venda::FindOrFail($id);
        $this->livro = Livro::FindOrFail($this->venda->livroComprado->id);
        $this->comprador = Usuario::FindOrFail($this->venda->compradorVenda->id);
        $this->vendedor = Usuario::FindOrFail($this->venda->livroComprado->donoLivro->id);
        $this->iniciaDados();
        $this->iniciaDadosBoleto();
        $this->geraDados();
        $this->gerarDadosBoleto();
        $this->configuraInformacoes();

        return view('pages.boleto')->
                        with('dadosboleto', $this->dadosboleto)->
                        with('html', $this->fbarcode($this->dadosboleto["codigo_barras"]));
    }

    private function iniciaDadosBoleto() {
        $this->dadosboleto["inicio_nosso_numero"] = '';
        $this->dadosboleto["nosso_numero"] = '';
        $this->dadosboleto["nosso_numero_si"] = '';
        $this->dadosboleto["numero_documento"] = '';
        $this->dadosboleto["data_vencimento"] = '';
        $this->dadosboleto["data_documento"] = '';
        $this->dadosboleto["data_processamento"] = '';
        $this->dadosboleto["valor_boleto"] = '';
        $this->dadosboleto["sacado"] = '';
        $this->dadosboleto["cpf_sacado"] = '';
        $this->dadosboleto["endereco1"] = '';
        $this->dadosboleto["endereco2"] = '';
        $this->dadosboleto["demonstrativo1"] = '';
        $this->dadosboleto["demonstrativo2"] = '';
        $this->dadosboleto["demonstrativo3"] = '';
        $this->dadosboleto["instrucoes1"] = '';
        $this->dadosboleto["instrucoes2"] = '';
        $this->dadosboleto["instrucoes3"] = '';
        $this->dadosboleto["instrucoes4"] = '';

        $this->dadosboleto["quantidade"] = "";
        $this->dadosboleto["valor_unitario"] = "";
        $this->dadosboleto["aceite"] = '';
        $this->dadosboleto["especie"] = '';
        $this->dadosboleto["especie_doc"] = '';
        $this->dadosboleto["agencia"] = '';
        $this->dadosboleto["conta"] = '';
        $this->dadosboleto["conta_dv"] = '';
        $this->dadosboleto["posto"] = '';
        $this->dadosboleto["byte_idt"] = '';
        $this->dadosboleto["carteira"] = '';
        $this->dadosboleto["identificacao"] = '';
        $this->dadosboleto["cpf_cnpj"] = '';
        $this->dadosboleto["endereco"] = '';
        $this->dadosboleto["cidade_uf"] = '';
        $this->dadosboleto["cedente"] = '';
        $this->dadosboleto["agencia_codigo"] = '';
        $this->dadosboleto["linha_digitavel"] = '';
    }

    private function iniciaDados() {
        $this->dados['nome_sacado'] = '';
        $this->dados['endereco1_sacado'] = '';
        $this->dados['endereco2_sacado'] = '';
        $this->dados['cpf_sacado'] = '';
        $this->dados['taxa_boleto'] = '';
        $this->dados['data_vencimento'] = '';
        $this->dados['valor_cobrado'] = '';
        $this->dados['juros'] = 0;
        $this->dados['demonstrativo1'] = '';
        $this->dados['demonstrativo2'] = '';
        $this->dados['demonstrativo3'] = '';
        $this->dados["inicio_nosso_numero"] = '';
        $this->dados["nosso_numero"] = '';
        $this->dados["numero_documento"] = '';
        $this->dados["instrucoes1"] = '';
        $this->dados["instrucoes2"] = '';
        $this->dados["instrucoes3"] = '';
    }

    private function gerarDadosBoleto() {
        $dias_de_prazo_para_pagamento = 1;

        $taxa_boleto = $this->dados['taxa_boleto'];

        //date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
        $data_venc = $this->dados['data_vencimento'];

        // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
        $valor_cobrado = $this->dados['valor_cobrado'];

        $valor_cobrado = str_replace(",", ".", $valor_cobrado);

        $valor_boleto = number_format($valor_cobrado + $taxa_boleto + $this->dados['juros'], 2, ',', '');

        //date("y"); // Ano da geração do titulo ex: 07 para 2007 
        $this->dadosboleto["inicio_nosso_numero"] = $this->dados["inicio_nosso_numero"];

        $this->dadosboleto["nosso_numero_si"] = $this->dados["nosso_numero_si"];

        // Nosso numero (máx. 5 digitos) - Numero sequencial de controle.
        $this->dadosboleto["nosso_numero"] = $this->dados["nosso_numero"];

        // Num do pedido ou do documento
        $this->dadosboleto["numero_documento"] = $this->dados["numero_documento"];

        // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
        $this->dadosboleto["data_vencimento"] = $data_venc;

        // Data de emissão do Boleto
        $this->dadosboleto["data_documento"] = date("d/m/Y");

        // date("d/m/Y"); // Data de processamento do boleto (opcional)
        $this->dadosboleto["data_processamento"] = '';

        // Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
        $this->dadosboleto["valor_boleto"] = $valor_boleto;


        // DADOS DO SEU CLIENTE
        $this->dadosboleto["sacado"] = $this->dados['nome_sacado'];
        $this->dadosboleto["endereco1"] = $this->dados['endereco1_sacado'];
        $this->dadosboleto["endereco2"] = $this->dados['endereco2_sacado'];

        $this->dadosboleto['cpf_sacado'] = $this->dados['cpf_sacado'];

        // INFORMACOES PARA O CLIENTE
        $this->dadosboleto["demonstrativo1"] = $this->dados['demonstrativo1'];
        $this->dadosboleto["demonstrativo2"] = $this->dados['demonstrativo2'];
        $this->dadosboleto["demonstrativo3"] = $this->dados['demonstrativo3'];

        // INSTRUCÕES PARA O CAIXA
        $this->dadosboleto["instrucoes1"] = $this->dados["instrucoes1"];
        $this->dadosboleto["instrucoes2"] = '';
        $this->dadosboleto["instrucoes3"] = '';
        $this->dadosboleto["instrucoes4"] = '';

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $this->dadosboleto["quantidade"] = "";
        $this->dadosboleto["valor_unitario"] = "";

        // N - remeter cobrança sem aceite do sacado  (cobranças não -registradas)
        // S - remeter cobrança apos aceite do sacado (cobranças registradas)
        $this->dadosboleto["aceite"] = "N";
        $this->dadosboleto["especie"] = "R$";

        // OS - Outros segundo manual para cedentes de cobrança SICREDI
        // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
        // DADOS DA SUA CONTA - SICREDI
        $this->dadosboleto["especie_doc"] = "A";

        // Num da agencia (4 digitos), sem Digito Verificador
        $this->dadosboleto["agencia"] = "0000";

        // Num da conta (5 digitos), sem Digito Verificador
        $this->dadosboleto["conta"] = "000000";

        // Digito Verificador do Num da conta
        $this->dadosboleto["conta_dv"] = "0";
        // DADOS PERSONALIZADOS - SICREDI
        $this->dadosboleto["posto"] = "01";      // Codigo do posto da cooperativa de credito
        $this->dadosboleto["byte_idt"] = "9";   // Byte de identificação do cedente do bloqueto utilizado para compor o nosso numero.
        // 1 - Idtf emitente: Cooperativa | 2 a 9 - Idtf emitente: Cedente
        $this->dadosboleto["carteira"] = "A";   // Codigo da Carteira: A (Simples) 
        // SEUS DADOS
        $this->dadosboleto["identificacao"] = "FliipBook";
        $this->dadosboleto["cpf_cnpj"] = "00.000.000/0000-00";
        $this->dadosboleto["endereco"] = "Rua dos bobos, 0 - Centro";
        $this->dadosboleto["cidade_uf"] = "00000-000 - Lugar Nenhum / CE";
        $this->dadosboleto["cedente"] = "GABRIEL NOGUEIRA BEZERRA";
    }

    private function modulo11($num, $base = 9, $r = 0) {

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2 
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            return $digito;
        } elseif ($r == 1) {
            // esta rotina sofrer algumas altera��es para ajustar no layout do SICREDI
            $r_div = (int) ($soma / 11);
            $digito = ($soma - ($r_div * 11));
            return $digito;
        }
    }

    private function digitoVerificadorNossoNumero($numero) {
        $resto2 = $this->modulo11($numero, 9, 1);

        $digito = 11 - $resto2;

        if ($digito > 9) {
            $dv = 0;
        } else {
            $dv = $digito;
        }

        return $dv;
    }

    private function formataNumero($numero, $loop, $insert, $tipo = "geral") {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
            /*
              retira as virgulas
              formata o numero
              preenche com zeros
             */
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }

    private function geraDados() {
        $this->dados['nome_sacado'] = $this->comprador->nome;
        $this->dados['endereco1_sacado'] = $this->comprador->endereco->endereco . ' - ' . $this->comprador->endereco->bairro;
        $this->dados['endereco2_sacado'] = $this->comprador->endereco->cidade->nome .
                ' - ' . $this->comprador->endereco->cidade->estado->uf . ' - ' . $this->comprador->endereco->cep;
        $this->dados['cpf_sacado'] = '000.000.000-00';
        $this->dados['taxa_boleto'] = 0;

        $this->dados['data_vencimento'] = date('d/m/Y', strtotime($this->vencimento()));
        $this->dados['valor_cobrado'] = number_format($this->venda->valor, 2, ',', '');
        $this->dados['demonstrativo1'] = 'Comprou o livro: ' . $this->livro->nome;


        $this->dados["inicio_nosso_numero"] = date('y', strtotime($this->vencimento()));
        // lembrando que esse nosso_numero é para ser colocado em cada matricula dos estudantes
        $this->dados["numero_documento"] = $this->venda->id;
        $this->dados["instrucoes1"] = '';

        $agencia = $this->formataNumero('2301', 4, 0);

        $posto = $this->formataNumero('00', 2, 0);

        $conta = $this->formataNumero('000000', 5, 0);

        if ($this->venda->nossoNumero <= 0) {
            $vendaA = Venda::orderBy('nossoNumero', 'desc')->get()->first();

            // primeiro boleto
            if ($vendaA->nossoNumero <= 0) {
                $numeroAux = $this->dados["inicio_nosso_numero"] . "9" . $this->formataNumero('1', 5, 0);
                // primeiro boleto é igual 1
                $this->dados["nosso_numero"] = 1;
                $this->venda->nossonumero = 1;
                //$this->matricula->update();
            } else {
                // outros boletos
                $numeroAux = $this->dados["inicio_nosso_numero"] . "9" . $this->formataNumero($vendaA->nossonumero, 5, 0);

                $this->venda->nossoNumero = $vendaA->nossoNumero + 1;
                $this->venda->update();
            }

            $dv_nosso_numero = $this->digitoVerificadorNossoNumero("$agencia$posto$conta$numeroAux");

            $nossonumero_dv = "$numeroAux$dv_nosso_numero";

            $nossonumero = substr($nossonumero_dv, 0, 2) . '/' .
                    substr($nossonumero_dv, 2, 6) . '-' .
                    substr($nossonumero_dv, 8, 1);

            $this->venda->update();
        } else {

            $numeroAux = $this->dados["inicio_nosso_numero"] . "9" .
                    $this->formataNumero($this->venda->nossonumero, 5, 0);
            $dv_nosso_numero = $this->digitoVerificadorNossoNumero("$agencia$posto$conta$numeroAux");

            $nossonumero_dv = "$numeroAux$dv_nosso_numero";

            $nossonumero = substr($nossonumero_dv, 0, 2) .
                    '/' . substr($nossonumero_dv, 2, 6) .
                    '-' . substr($nossonumero_dv, 8, 1);
        }


        $this->dados["nosso_numero_si"] = $nossonumero;
    }

    public function vencimento() {
        return $this->venda->created_at;
        //return $this->adicionaDiasData(date('Y-m-d'), $this->parametros->diasantesvecimento);
    }

    public function adicionaDiasData($data, $dias) {
        return date('Y-m-d', strtotime('+' . $dias . ' days', strtotime(date($data))));
    }

    public function geraMultaMora() {

        return;

        if (date('Y-m-d') > date('Y-m-d', strtotime($this->vencimento()))) {
            $this->dados['juros'] = $this->parametros->multaatraso;

            $di = $this->gerarTimeStamp(date('d/m/Y', strtotime($this->vencimento())));

            $df = $this->gerarTimeStamp(date('d/m/Y'));

            $diferenca = $df - $di;

            $dias = (int) floor($diferenca / (60 * 60 * 24));

            $this->dados['juros'] = $this->dados['juros'] + ($dias * $this->parametros->moradia);

            $mi = date('m', strtotime($this->vencimento()));

            $mf = date('m');

            $this->dados['juros'] = $this->dados['juros'] + (($mf - $mi) * $this->curso->valor);



            if ($this->dados['juros'] > 0) {
                $this->dados['demonstrativo3'] = 'Atraso de ' . ($mf - $mi) . ' mês(es) e ' . $dias . ' dia(s) ' .
                        ', Multa por Atraso: R$ ' . $this->parametros->multaatraso .
                        ', Mora dos dias: ' . '(' . $dias . ') R$ ' . number_format($dias * $this->parametros->moradia, 2, ',', '') .
                        ', Parc. Atrasadas:' . ' (' . ($mf - $mi) . ') R$ ' . number_format(($mf - $mi) * $this->curso->valor, 2, ',', '') .
                        ' Total: R$ ' . number_format($this->dados['juros'], 2, ',', '');
            }
        }
    }

    private function digitoVerificador_nossonumero($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);
        // esta rotina sofrer algumas altera��es para ajustar no layout do SICREDI
        $digito = 11 - $resto2;
        if ($digito > 9) {
            $dv = 0;
        } else {
            $dv = $digito;
        }
        return $dv;
    }

    private function digitoVerificador_campolivre($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);

        if ($resto2 <= 1) {
            $dv = 0;
        } else {
            $dv = 11 - $resto2;
        }

        return $dv;
    }

    private function digitoVerificador_barra($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);
        $digito = 11 - $resto2;
        if ($digito <= 1 || $digito >= 10) {
            $dv = 1;
        } else {
            $dv = $digito;
        }
        return $dv;
    }

    private function formata_numero($numero, $loop, $insert, $tipo = "geral") {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }

        if ($tipo == "valor") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }

        return $numero;
    }

    private function esquerda($entra, $comp) {
        return substr($entra, 0, $comp);
    }

    private function direita($entra, $comp) {
        return substr($entra, strlen($entra) - $comp, $comp);
    }

    private function fator_vencimento($data) {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(($this->_dateToDays("1997", "10", "07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    private function _dateToDays($year, $month, $day) {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }

        return ( floor(( 146097 * $century) / 4) +
                floor(( 1461 * $year) / 4) +
                floor(( 153 * $month + 2) / 5) +
                $day + 1721119);
    }

    private function modulo_10($num) {
        $numtotal10 = 0;
        $fator = 2;
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num, $i - 1, 1);
            $temp = $numeros[$i] * $fator;
            $temp0 = 0;
            foreach (preg_split('//', $temp, -1, PREG_SPLIT_NO_EMPTY) as $k => $v) {
                $temp0 += $v;
            }

            $parcial10[$i] = $temp0;
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2;
            }
        }
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }
        return $digito;
    }

    private function modulo_11($num, $base = 9, $r = 0) {
        $soma = 0;
        $fator = 2;
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num, $i - 1, 1);
            $parcial[$i] = $numeros[$i] * $fator;
            $soma += $parcial[$i];
            if ($fator == $base) {
                $fator = 1;
            }
            $fator++;
        }
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            return $digito;
        } elseif ($r == 1) {
            $r_div = (int) ($soma / 11);
            $digito = ($soma - ($r_div * 11));
            return $digito;
        }
    }

    private function monta_linha_digitavel($codigo) {
        $p1 = substr($codigo, 0, 4);
        $p2 = substr($codigo, 19, 5);
        $p3 = $this->modulo_10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";
        $p1 = substr($codigo, 24, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";
        $p1 = substr($codigo, 34, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";
        $campo4 = substr($codigo, 4, 1);
        $p1 = substr($codigo, 5, 4);
        $p2 = substr($codigo, 9, 10);
        $campo5 = "$p1$p2";
        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    private function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        return $parte1 . "-X";
    }

    private function configuraInformacoes() {
        $codigobanco = "000";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "0";
        $fator_vencimento = $this->fator_vencimento($this->dadosboleto["data_vencimento"]);
        $valor = $this->formata_numero($this->dadosboleto["valor_boleto"], 10, 0, "valor");
        $agencia = $this->formata_numero($this->dadosboleto["agencia"], 4, 0);
        $posto = $this->formata_numero($this->dadosboleto["posto"], 2, 0);
        $conta = $this->formata_numero($this->dadosboleto["conta"], 5, 0);
        $conta_dv = $this->formata_numero($this->dadosboleto["conta_dv"], 1, 0);
        $carteira = $this->dadosboleto["carteira"];
        $filler1 = 1;
        $filler2 = 0;
        $byteidt = $this->dadosboleto["byte_idt"];
        $tipo_cobranca = 3;
        $tipo_carteira = 1;
        $nnum = $this->dadosboleto["inicio_nosso_numero"] . $byteidt . $this->formata_numero($this->dadosboleto["nosso_numero"], 5, 0);
        $dv_nosso_numero = $this->digitoVerificador_nossonumero("$agencia$posto$conta$nnum");
        $nossonumero_dv = "$nnum$dv_nosso_numero";
        $campolivre = "$tipo_cobranca$tipo_carteira$nossonumero_dv$agencia$posto$conta$filler1$filler2";
        $campolivre_dv = $campolivre . $this->digitoVerificador_campolivre($campolivre);
        $dv = $this->digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$campolivre_dv", 9, 0);
        $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$campolivre_dv";
        $nossonumero = substr($nossonumero_dv, 0, 2) . '/' . substr($nossonumero_dv, 2, 6) . '-' . substr($nossonumero_dv, 8, 1);
        $agencia_codigo = $agencia . "." . $this->modulo_11($posto) . "." . $conta;
        $this->dadosboleto["codigo_barras"] = $linha;
        $this->dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
        $this->dadosboleto["agencia_codigo"] = $agencia_codigo;
        $this->dadosboleto["nosso_numero"] = $nossonumero;
        $this->dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;
    }

    private function fbarcode($valor) {

        $html = '';
        $local = asset('bibliotecas/img/boleto//');
        $fino = 1;
        $largo = 3;
        $altura = 50;
        $barcodes[0] = "00110";
        $barcodes[1] = "10001";
        $barcodes[2] = "01001";
        $barcodes[3] = "11000";
        $barcodes[4] = "00101";
        $barcodes[5] = "10100";
        $barcodes[6] = "01100";
        $barcodes[7] = "00011";
        $barcodes[8] = "10010";
        $barcodes[9] = "01010";
        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = "";
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }

        $html .= '<img src="' . $local . '/images/p.png" width=' . $fino . ' height=' . $altura . ' border=0>';
        $html .= '<img src="' . $local . '/images/b.png" width=' . $fino . ' height=' . $altura . ' border=0>';
        $html .= '<img src="' . $local . '/images/p.png" width=' . $fino . ' height=' . $altura . ' border=0>';
        $html .= '<img src="' . $local . '/images/b.png" width=' . $fino . ' height=' . $altura . ' border=0>';

        $texto = $valor;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

        while (strlen($texto) > 0) {
            $i = round($this->esquerda($texto, 2));
            $texto = $this->direita($texto, strlen($texto) - 2);
            $f = $barcodes[$i];
            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }
                $html .= '<img src="' . $local . '/images/p.png" width=' . $f1 . ' height=' . $altura . ' border=0>';

                if (substr($f, $i, 1) == "0") {
                    $f2 = $fino;
                } else {
                    $f2 = $largo;
                }

                $html .= '<img src="' . $local . '/images/b.png" width=' . $f2 . ' height=' . $altura . ' border=0>';
            }
        }


        $html .= '<img src="' . $local . '/images/p.png" width=' . $largo . ' height=' . $altura . ' border=0>';
        $html .= '<img src="' . $local . '/images/b.png" width=' . $fino . ' height=' . $altura . ' border=0>';
        $html .= '<img src="' . $local . '/images/p.png" width=1 height=' . $altura . ' border=0>';

        return $html;
    }

}
