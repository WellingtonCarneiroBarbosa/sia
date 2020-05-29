<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard\Agendamentos\agendamentoModel;
use App\Models\Dashboard\locais\localModel;
use App\Models\Dashboard\empresas\empresaModel;
/**O Carbon é uma classe que herda diretamente da
 * classe DateTime do PHP, mas o que isso quer dizer?
 *
 * Quer dizer que numa instância (objeto) do Carbon você tem
 * todos os métodos do DateTime e pode utilizar uma instância
 * Carbon em qualquer local que seria necessário uma instância da classe
 * DateTime.
 * */
use Carbon\Carbon;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**Pega todos os agendamentos do banco de dados para listá-los */
        $agendamentos = agendamentoModel::with('localAgendamento')->with('clienteAgendamento')->paginate(5);

        $locais = localModel::get();

        $quantidadeLocal = count($locais);

        $clientes = empresaModel::get();

        $quantidadeCliente = count($clientes);

        /**cria nova instancia carbon */
        $carbon = new Carbon;

        /**cria nova instancia carbon usando o método
         * estático now
         */
        $carbon = $carbon->now();

        $now = $carbon;


        /**Pega o mês atual */
        $mesAtual = $carbon->month;

        $mesAtualNome = $now->formatLocalized('%B');


        define('mesAtualTxt', utf8_encode($mesAtualNome));





        /**Pega o mês anterior */
        $mesAnterior = $carbon->subMonth()->month;

        /**Converte para string o mes anterior */
        $now = $carbon;
        $mesPassado = $now->formatLocalized('%B');


        $mesPassado = utf8_encode($mesPassado);

        /**seleciona os agendamentos criados no mes atual */
        $qtdAgendamentosMesAtual = agendamentoModel::whereMonth('created_at', $mesAtual)->get();

        /**seleciona os agendamentos criados no mes anterior */
        $qtdAgendamentosMesAnterior = agendamentoModel::whereMonth('created_at', $mesAnterior)->get();

        /**Seleciona os agendamentos cancelados no mes atual */
        $qtdAgendamentosCanceladosMesAtual = agendamentoModel::onlyTrashed()->whereMonth('deleted_at', '=', $mesAtual)->get();

        /**Seleciona os agendamentos cancelados no mes anterior */
        $qtdAgendamentosCanceladosMesAnterior = agendamentoModel::onlyTrashed()->whereMonth('deleted_at', '=', $mesAnterior)->get();

        /**Conta os agendamentos do mes atual */
        $qtdAgendamentosMesAtual = count($qtdAgendamentosMesAtual);

        /**Conta os agendamentos do mes anterior */
        $qtdAgendamentosMesAnterior = count($qtdAgendamentosMesAnterior);

         /**Conta os agendamentos cancelados do mes atual */
         $qtdAgendamentosCanceladosMesAtual = count($qtdAgendamentosCanceladosMesAtual);

         /**Conta os agendamentos cancelados do mes anterior */
         $qtdAgendamentosCanceladosMesAnterior = count($qtdAgendamentosCanceladosMesAnterior);

          /**Realiza o cálculo de variação percentual
            * entre agendamentos cancelados
            */
        if($qtdAgendamentosCanceladosMesAtual > $qtdAgendamentosCanceladosMesAnterior && $qtdAgendamentosCanceladosMesAnterior != 0 && $qtdAgendamentosCanceladosMesAtual != 0){

            $estatisticaPositivaCancelados = 'nao';
            $variacaoPercentualCancelados = variacaoPercentualPositiva($qtdAgendamentosCanceladosMesAtual, $qtdAgendamentosCanceladosMesAnterior);

        }else if($qtdAgendamentosCanceladosMesAnterior > $qtdAgendamentosCanceladosMesAtual && $qtdAgendamentosCanceladosMesAnterior != 0 && $qtdAgendamentosCanceladosMesAtual != 0){

            $estatisticaPositivaCancelados = 'sim';
            $variacaoPercentualCancelados = variacaoPercentualNegativa($qtdAgendamentosCanceladosMesAnterior, $qtdAgendamentosCanceladosMesAtual);

        }else if($qtdAgendamentosCanceladosMesAnterior == 0 && $qtdAgendamentosCanceladosMesAtual != 0){

            $estatisticaPositivaCancelados = 'nao';
            $variacaoPercentualCancelados = variacaoPercentualSemDadoAnterior($qtdAgendamentosCanceladosMesAtual);

        }else if($qtdAgendamentosCanceladosMesAnterior == $qtdAgendamentosCanceladosMesAtual || $qtdAgendamentosCanceladosMesAtual == 0){

            $estatisticaPositivaCancelados = 'semVariacao';
            $variacaoPercentualCancelados = 0;

        }

       /**Realiza o cálculo de variação percentual
        * entre novos agendamentos
        */
        if($qtdAgendamentosMesAtual > $qtdAgendamentosMesAnterior && $qtdAgendamentosMesAnterior != 0 && $qtdAgendamentosMesAtual != 0){

            $estatisticaPositiva = 'sim';
            $variacaoPercentual = variacaoPercentualPositiva($qtdAgendamentosMesAtual, $qtdAgendamentosMesAnterior);

        }else if($qtdAgendamentosMesAnterior > $qtdAgendamentosMesAtual && $qtdAgendamentosMesAnterior != 0 && $qtdAgendamentosMesAtual != 0){

            $estatisticaPositiva = 'nao';
            $variacaoPercentual = variacaoPercentualNegativa($qtdAgendamentosMesAnterior, $qtdAgendamentosMesAtual);

        }else if($qtdAgendamentosMesAnterior == 0 && $qtdAgendamentosMesAtual != 0){

            $estatisticaPositiva = 'sim';
            $variacaoPercentual = variacaoPercentualSemDadoAnterior($qtdAgendamentosMesAtual);

        }else if($qtdAgendamentosMesAnterior == $qtdAgendamentosMesAtual || $qtdAgendamentosMesAtual == 0){

            $estatisticaPositiva = 'semVariacao';
            $variacaoPercentual = 0;

        }

        return view('App.dashboard.index', ['agendamentos' => $agendamentos, 'qtdAgendamentos' => $qtdAgendamentosMesAtual, 'qtdAgendamentosMesAnterior' => $qtdAgendamentosMesAnterior, 'estatisticaPositiva' => $estatisticaPositiva, 'variacaoPercentual' => $variacaoPercentual, 'variacaoPercentualCancelados' => $variacaoPercentualCancelados,
        'qtdAgendamentosCancelados' => $qtdAgendamentosCanceladosMesAtual, 'qtdAgendamentosCanceladosMesAnterior' => $qtdAgendamentosCanceladosMesAnterior, 'estatisticaPositivaCancelados' => $estatisticaPositivaCancelados, 'mesPassado' => $mesPassado, 'mesAtualTxt' => mesAtualTxt, 'locais' => $locais, 'quantidadeLocais' => $quantidadeLocal,
        'clientes' => $clientes, 'quantidadeClientes' => $quantidadeCliente]);
    }
}
