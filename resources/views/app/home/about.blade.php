@extends('layouts.home')

@section('title', Lang::get('About The System'))

@section('content')
<!-- background -->
<div class="wrapper">
    <!--background do template-->
    <div class="section section-hero section-shaped">
        <div class="shape shape-style-3 shape-default">
          <span class="span-150"></span>
          <span class="span-50"></span>
          <span class="span-50"></span>
          <span class="span-75"></span>
          <span class="span-100"></span>
          <span class="span-75"></span>
          <span class="span-50"></span>
          <span class="span-100"></span>
          <span class="span-50"></span>
          <span class="span-100"></span>
        </div>

    <!--background padrao
        <div class="shape shape-style-1 shape-primary">
            <span id="shape1" class="span-150"></span>
            <span id="shape2" class="span-50"></span>
            <span id="shape3" class="span-50"></span>
            <span id="shape4" class="span-75"></span>
            <span id="shape5" class="span-100"></span>
            <span id="shape6" class="span-75"></span>
            <span id="shape7" class="span-50"></span>
            <span id="shape8" class="span-100"></span>
            <span id="shape9" class="span-50"></span>
            <span id="shape10" class="span-100"></span>
        </div>
    -->
        <!-- fim do background -->
        <!--inicio do conteudo-->
        <div class="page-header">
            <div class="container shape-container d-flex align-items-center py-lg">
              <div class="col px-0">
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1 class="text-white display-1">SIA EVENTOS</h1>
                    <h2 class="display-4 font-weight-normal text-white">Conheca mais sobre o nosso video sobre o sistema!</h2>
                    <div class="btn-wrapper mt-4">
                      <a target="_blank" href="https://www.youtube.com/watch?v=8oELt_TkNe0&feature=youtu.be" class="btn btn-warning btn-icon mt-3 mb-sm-0">
                        <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                        <span class="btn-inner--text">Assista ao Trailer do sistema</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <!--separador-->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>

    <!--fim do background-->
    </div>

    <!--features-->
    <div class="section features-6">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="info info-horizontal info-hover-primary">
                <div class="description pl-4">
                  <h5 class="title">Seja bem vindo ao SIA Eventos</h5>
                  <p>Bem vindo ao SIA Eventos um sistema interno de agendamento de eventos do sistema FIEP, um sistema sendo produzido desde o ano de 2019, para facilitar todo o trabalho da equipe de eventos, fazendo assim o trabalho da equipe mais agil, eficiente e com uma maior facilidade para executar algumas acoes. O sistema pode ser utilizado em PC, Tablet ou SMARTPHONES. Sem ocupar espaco no seu PC, pois os arquivos relacionados a agendamentos estao armazenados no proprio sistema.</p>
                  <a href="#" class="text-info"></a>
                </div>
              </div>
              <div class="info info-horizontal info-hover-primary mt-5">
                <div class="description pl-4">
                  <h5 class="title">Agende quantos eventos desejar!</h5>
                  <p>O nosso sistema deixa livre o agendamento de novos eventos de acordo com a sua necessidade!</p>
                  <a href="#" class="text-info"></a>
              <div class="info info-horizontal info-hover-primary mt-5">
                <img class="description pl-4" src="{{asset('home/assets/img/brand/agenda.jpg')}}" width="150%" Heightwidth="150%"> 
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="info info-horizontal info-hover-primary mt-5">
      <div class="description pl-4">
        <h5 class="title">Cadastre quantos locais desejar!</h5>
        <p>O nosso sistema deixa livre o cadastro de novos locais sempre de acordo com a sua necessidade! <p>Tendo no total 7 locais ja cadastrados!</p>
        <a href="#" class="text-info"></a>
    <div class="info info-horizontal info-hover-primary mt-5">
      <img class="description pl-4" src="{{asset('home/assets/img/brand/fotofinal.png')}}" width="50%" Heightwidth="50%"> 
    </div>
  </div>
</div>
</div>
</div>
</div>
      <!--other section-->
      <div class="section features-1">
        <div class="container">
          <div class="row">
            <div class="col-md-8 mx-auto text-center">
              <span class="badge badge-primary badge-pill mb-3">Desenvolvimento</span>
              <h3 class="display-3">Como o projeto foi desenvolvido</h3>
              <p class="lead">Foi necessario tempo,estudo e reunioes para manter a organização para que assim todo esse sistema de agendamentos pudesse ser feito para melhorar e facilitar todo o trabalho da equipe do centro de eventos.</p>
            </div>
          </div>
        </p>
          <div class="row">
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
                  <i class="ni ni-settings-gear-65"></i>
                </div>
                <h6 class="info-title text-uppercase text-primary">Reunioes Scruns</h6>
                <p class="description opacity-8">Para que pudesse ser feito um crontrole sobre e o que seria implementado no sistema foram feitas diversas reunioes usando a metodologia scrun que sao reunioes de 15 min minutos.</p>
                <a href="javascript:;" class="text-primary">Ler documentacao
                  <i class="ni ni-bold-right text-primary"></i>
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
                  <i class="ni ni-atom"></i>
                </div>
                <h6 class="info-title text-uppercase text-success">Desenvolvimento</h6>
                <p class="description opacity-8">Para que o sistema pudesse ser desenvolvido com fluides foram divididas as tarefas de desenvolvimento, sendo assim possivel que o sistema pudesse ser desenvolvido com com uma maior facilidade.</p>
                <a href="javascript:;" class="text-primary">
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info">
                <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
                  <i class="ni ni-world"></i>
                </div>
                <h6 class="info-title text-uppercase text-warning">Conversas com o cliente</h6>
                <p class="description opacity-8">Para saber se o sistema estava atendendo toda a necessidade do cliente foram feitas consultas a equipe de agendamentos assim sendo possivel a finalizao do sistema e o contentamento do cliente.</p>
                <a href="javascript:;" class="text-primary">
                </a>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
    <!--end :) -->
@endsection
 