@extends('App.layouts.dashboard.app')
@section('title', 'Home')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Agendamentos</h6>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="#" class="btn btn-sm btn-neutral mb-2" id="novo-agendamento" data-toggle="modal" data-target="#modal-form">Novo</a>
                    <a href="{{route('agendamentos-cancelados')}}" class="btn btn-sm btn-neutral mb-2">Cancelados</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-agendamento" class="btn btn-sm btn-neutral mb-2 mr-2">Filtros</a>
                </div>
              </div>
            <!-- fim do header -->

            @if(auth()->user()->role_id == 5)
            <!-- show/hide estatisticas -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#exibirEstatisticas").show();
                    $("#ocultarEstatisticas").hide();
                    $("#estatisticas").hide(450);
                });
                $(function(){
                    $("#ocultarEstatisticas").click(function(){
                        $("#estatisticas").hide(500);
                        $("#ocultarEstatisticas").hide();
                        $("#exibirEstatisticas").show();
                    });
                    $("#exibirEstatisticas").click(function(){
                        $("#estatisticas").show(500);
                        $("#ocultarEstatisticas").show();
                        $("#exibirEstatisticas").hide();
                    });
                });
            </script>



            <!-- Card stats -->
            <div class="row" id="estatisticas">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Novos</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$qtdAgendamentos}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                @if($estatisticaPositiva == 'sim' && $qtdAgendamentosMesAnterior != 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{$variacaoPercentual}}%</span>
                                @elseif($estatisticaPositiva == 'nao')
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> {{$variacaoPercentual}}%</span>
                                @elseif($estatisticaPositiva == 'sim' && $qtdAgendamentosMesAnterior == 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{$variacaoPercentual}}%</span>
                                @elseif($estatisticaPositiva == 'semVariacao')
                                    <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                                @endif

                                <span class="text-nowrap">Comparando com 
                                  {{ ucfirst($mesPassado) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Cancelados</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$qtdAgendamentosCancelados}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-fat-delete"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                @if($estatisticaPositivaCancelados == 'sim' && $qtdAgendamentosCanceladosMesAnterior != 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-down"></i> {{$variacaoPercentualCancelados}}%</span>
                                @elseif($estatisticaPositivaCancelados == 'nao')
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> {{$variacaoPercentualCancelados}}%</span>
                                @elseif($estatisticaPositivaCancelados == 'sim' && $qtdAgendamentosCanceladosMesAnterior == 0)
                                    <span class="text-success mr-2"><i class="fa fa-arrow-down"></i> {{$variacaoPercentualCancelados}}%</span>
                                @elseif($estatisticaPositivaCancelados == 'semVariacao')
                                    <span class="text-primary mr-2"><i class="ni ni-fat-delete"></i> 0.00%</span>
                                @endif
                                <span class="text-nowrap">Comparando com 
                                  {{ ucfirst($mesPassado) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                </div><!-- fim dos card status -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="exibirEstatisticas" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Exibir Estatísticas
                        </button>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="ocultarEstatisticas" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ocultar Estatísticas
                        </button>
                    </div>
                    <br>
                    <br>
                    @endif
            </div>
        </div>
    </div>

    <!-- tabela de agendamentos -->

    <div class="container-fluid mt--6"><!-- conteudo da pagina -->

        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-inner--text"><i class="ni ni-like-2"></i><strong> Sucesso!</strong> {{session('status')}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> Ops...</strong> {{session('error')}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if ($qtdAgendamentos == 0)
        <div class="row"><!-- inicio da tabela de agendamentos -->
            <div class="col-xl-12">
              <div class="card bg-default">
                <div class="card-header bg-transparent">
                  <div class="row align-items-center"><!-- inicio cabecalho da tabela -->
                    <div class="col">
                      <h6 class="text-light text-uppercase ls-1 mb-1">Tabela de</h6>
                      <h5 class="h3 text-white mb-0">Agendamentos</h5>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                          <tr><!-- agendamento 01 -->
                            <th scope="col" class="sort" data-sort="name">Local</th>
                            <th scope="col" class="sort" data-sort="budget">Data-Hora Inicial / Data-Hora Final</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th scope="col">Empresa Responsável</th>
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                          </tr>
                        </thead><!-- fim do cabeçalho da tabela -->

                        <tbody class="list"><!-- inicio corpo da tabela -->
                          <tr>
                            <th scope="row">
                              <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="name mb-0 text-sm">Sem Dados</span>
                                </div>
                              </div>
                            </th>
                            <td class="budget">
                              Sem Dados | Sem Dados
                            </td>
                            <td>
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-danger"></i>
                                    <span class="status">Sem Dados</span>
                                </span>
                            </td>
                            <td>
                              <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="name mb-0 text-sm">Sem Dados</span>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                  <a class="dropdown-item" href="#!">Sem Opções Disponíveis</a>
                                </div>
                              </div>
                            </td>
                          </tr><!-- fim do agendamento 01 -->
                        </tbody><!-- fim do corpo da tabela -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- fim da tabela de agendamentos -->
        @else <!-- se houver agendamentos -->
        <div class="row"><!-- inicio da tabela de agendamentos -->
            <div class="col-xl-12">
              <div class="card bg-default">
                <div class="card-header bg-transparent">
                  <div class="row align-items-center"><!-- inicio cabecalho da tabela -->
                    <div class="col">
                      <h6 class="text-light text-uppercase ls-1 mb-1">Tabela de</h6>
                      <h5 class="h3 text-white mb-0">Agendamentos</h5>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                          <tr><!-- agendamento 01 -->
                            <th scope="col" class="sort" data-sort="name">Local</th>
                            <th scope="col" class="sort" data-sort="budget">Data-Hora Inicial / Data-Hora Final</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th scope="col">Empresa Responsável</th>
                            <th scope="col" class="sort" data-sort="completion">Ações</th>
                            <th scope="col"></th>
                          </tr>
                        </thead><!-- fim do cabeçalho da tabela -->

                        <tbody class="list"><!-- inicio corpo da tabela -->
                          @foreach($agendamentos as $agendamento)
                          <tr>
                            <th scope="row">
                              <div class="media align-items-center">
                                <a href="#" class="avatar rounded-circle mr-3">
                                  <img alt="Image placeholder" src="{{asset('dashboard-elements/assets/img/theme/bootstrap.jpg')}}">
                                </a>
                                <div class="media-body">
                                  <span class="name mb-0 text-sm">{{$agendamento->localAgendamento->nome_local}}</span>
                                </div>
                              </div>
                            </th>
                            <td class="budget">
                                {{date_br($agendamento->inicio_data)}}  {{ time_br($agendamento->inicio_hora) }}
                                |
                                {{date_br($agendamento->fim_data) }} {{ time_br($agendamento->fim_hora) }}
                            </td>
                            <td>
                                <!-- se agendamento confirmado... -->
                              @if ($agendamento->status == 1)
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-success"></i>
                                    <span class="status">Confirmado</span>
                                </span>
                              @else
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-warning"></i>
                                    <span class="status">Pendente</span>
                                </span>
                              @endif
                            </td>
                            <td>
                              <div class="media align-items-center">
                                <a href="#" class="avatar avatar-sm rounded-circle mr-3">
                                  <img alt="Image placeholder" src="{{asset('dashboard-elements/assets/img/theme/bootstrap.jpg')}}">
                                </a>
                                <div class="media-body">
                                  <span class="name mb-0 text-sm">{{$agendamento->clienteAgendamento->empresa}}</span>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                  <a class="dropdown-item" href="{{ route('visualizar-agendamento', $agendamento->id)}}">Mais Detalhes</a>
                                  <a class="dropdown-item" href="{{ route('editar-agendamento', $agendamento->id)}}">Editar Agendamento</a>
                                  <form action="{{ route('confirm-destroy', $agendamento->id)}}" onsubmit="loader()" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cancelar Agendamento</button>
                                  </form>
                                </div>
                              </div>
                            </td>
                          </tr><!-- fim do agendamento 01 -->
                          @endforeach
                        </tbody><!-- fim do corpo da tabela -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- fim da tabela de agendamentos -->
          <div class="float-right">
            {{ $agendamentos->links() }}
          </div>
        @endif
        <br>
      <!-- fim do conteudo da pagina -->

      <!-- modal create -->
      <div class="col-md-4">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-10 py-lg-10">
                    <div class="text-center"><h3>Agendar Evento</h3></div>
                    <div class="text-center text-muted mb-4">
                        <small>Preencha os dados abaixo para prosseguir</small>
                    </div>
                    <form method="POST" action="{{ route('criar-agendamento') }}" onsubmit="loader()" role="form">
                    @csrf
                    <!-- titulo do agendamento -->
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-tag"></i></span>
                            </div>
                            <input id="titulo" placeholder="Título do agendamento" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autofocus>

                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div><!-- fim do titulo do agendamento -->

                      <!-- local do agendamento -->
                      <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text text-sm"><i class="fa fa-map mr-2"></i>Local</span>
                            </div>

                            @if ($quantidadeLocais == 0)
                                <select name="local" id="local" disabled class="form-control @error('local') is-invalid @enderror" required>
                                    <option selected>Não há locais cadastrados!</option>
                                </select>
                            @else
                                <select name="local" id="local" class="form-control @error('local') is-invalid @enderror" required>
                                    @foreach ($locais as $l)
                                        <option value="{{$l->id_local}}">{{$l->nome_local}}</option>
                                    @endforeach
                                </select>
                            @endif

                            @error('local')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- fim local do agendamento -->

                    <!--feedback datas-->
                    <div class="alert alert-danger alert-dismissible fade show" id="feedback-datas" style="display: none;" role="alert">
                        <span class="alert-inner--text"><strong> Ops...</strong> <p id="mensagem-feedback-datas"></p> </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="alert alert-warning alert-dismissible fade show" id="feedback-datas-warning" style="display: none;" role="alert">
                        <span class="alert-inner--text"><strong> Atenção!</strong> <p id="mensagem-feedback-datas-warning"></p> </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- data inicial do agendamento -->
                    <div class="form-group focused">
                      <label for="date-final">Data e Hora de Início</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input id="date-inicial" type="date" class="form-control" name="inicio_data" required>

                            @error('date-time-inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <!--hora inicial do agendamento-->
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>

                            <input id="time-inicial" type="time"  class="form-control " name="inicio_hora" required>
  
                            @error('time-inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- fim da data inicial do agendamento -->

                    <!-- data final do agendamento -->
                    <div class="form-group focused">
                    <label for="date-final">Data e Hora de término</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input id="date-final" type="date"  class="form-control" name="fim_data" required>

                        @error('date-time-final')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!--hora final do agendamento-->
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-clock"></i></span>
                        </div>

                        <input id="time-final" type="time" class="form-control " name="fim_hora" required>

                        @error('time-inicial')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <a href="#!" id="validar-datas" class="text-sm float-right mb-2">Validar Informações</a>
                </div>
                <!-- fim da data final do agendamento -->



                <!-- cliente do agendamento -->
                <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">

                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-single-02 mr-2"></i>Cliente</span>
                        </div>

                      @if ($quantidadeClientes == 0)
                          <select name="cliente" id="cliente" disabled class="form-control @error('cliente') is-invalid @enderror" required>
                              <option selected>Não há clientes cadastrados!</option>
                          </select>
                      @else
                        <select name="cliente" id="cliente" class="form-control @error('cliente') is-invalid @enderror" required>
                          @foreach ($clientes as $c)
                            <option value="{{$c->id}}">{{$c->empresa}}</option>
                          @endforeach
                        </select>
                      @endif
                      @error('cliente')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div><!-- fim do cliente do agendamento -->

                 <!-- detalhes do agendamento -->
                 <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                        </div>
                        <textarea id="detalhes" placeholder="Detalhes do Agendamento" class="form-control @error('detalhes') is-invalid @enderror" name="detalhes" value="{{ old('detalhes') }}"></textarea>
                        @error('detalhes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div><!-- fim do detalhes do agendamento -->

                    <!-- pendente ou nao -->

                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id=" customCheckLogin" name="status" type="checkbox">
                        <label class="custom-control-label" for=" customCheckLogin"><span>Aguardando confirmação</span></label>
                    </div>
                    <!-- fim do pendente ou nao -->

                    <!-- submit button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">Cancelar</button>
                            @if($quantidadeLocais == 0 || $quantidadeClientes == 0)
                                <button type="submit" class="btn btn-primary my-4" disabled>Agendar</button>
                            @else
                                <button type="submit" id="agendar-submit" disabled class="btn btn-primary my-4">Agendar</button>
                            @endif
                        </div>
                    <!-- fim do submit button -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
      <!-- fim do modal create -->

      <!-- filtros -->
      <div class="modal-filtros fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="espacol"></div>
            <div class="text-center"><h3>Filtros de Pesquisa</h3></div>
            <div class="text-center text-muted mb-4">
                <small>Escolha um dos métodos abaixo para prosseguir</small>
            </div>
            <div class="modal-body">
             <!--options-->
             <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="form-intervalo-data-tab" data-toggle="tab" href="#form-intervalo-data" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-calendar mr-2"></i>Inter. de Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="form-data-local-tab" data-toggle="tab" href="#form-data-local" role="tab" aria-controls="form-data-local" aria-selected="false"><i class="fa fa-map-marker-alt mr-2"></i>Data e Local</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="form-unica-data-tab" data-toggle="tab" href="#form-unica-data" role="tab" aria-controls="form-unica-data" aria-selected="false"><i class="fa fa-calendar mr-2"></i>Única Data</a>
                  </li>
                </ul>
            </div>

            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="form-intervalo-data" role="tabpanel" aria-labelledby="form-intervalo-data">
                      <h3>Pesquisar por intervalo de data</h3>
                      <form action="{{route('buscar-por-data')}}" onsubmit="loader()" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                          </div>
                                          <input required name="inicio" class="form-control dateTop" placeholder="De" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                          </div>
                                          <input required name="fim" class="form-control dateTop" placeholder="Até" type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- btn pesquisar -->
                            <div class="float-right">
                              <button class="btn btn-primary" type="submit">
                                Pesquisar
                              </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="form-data-local" role="tabpanel" aria-labelledby="form-data-local-tab">
                        <h3>Pesquisar por data e local</h3>
                        <form action="{{route('buscar-por-data-e-local')}}" onsubmit="loader()" method="POST">
                          @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input required name="inicio" placeholder="De" class="form-control dateTop" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input required name="fim" class="form-control dateTop" placeholder="Até" type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                  <div class="col-6">
                                      <div class="form-group">
                                        <label for="local">Local</label>

                                          <div class="input-group mb-4">

                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fa fa-map"></i></span>
                                            </div>

                                            @if ($quantidadeLocais == 0)
                                                <select name="local" id="local" disabled class="form-control @error('local') is-invalid @enderror" required>
                                                    <option selected>Não há locais cadastrados!</option>
                                                </select>
                                            @else
                                                <select name="local" id="local" class="form-control @error('local') is-invalid @enderror" required>
                                                    @foreach ($locais as $l)
                                                        <option value="{{$l->id_local}}">{{$l->nome_local}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="espaco"></div>
                                    <div class="float-right">
                                        <button class="btn btn-primary" type="submit">
                                            Pesquisar
                                        </button>
                                    </div>
                                </div>
                              </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="form-unica-data" role="tabpanel" aria-labelledby="form-unica-data">
                        <h3>Pesquisar por única data</h3>
                        <form action="{{route('buscar-por-data-unica')}}" onsubmit="loader()" method="POST">
                          @csrf
                              <div class="row">
                                  <div class="col-6">
                                      <div class="form-group">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input required name="data" id="unica_data" class="form-control dateTop" placeholder="Data" type="date">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-6">
                                      <div class="form-group">
                                            <!-- btn pesquisar -->
                                            <div class="float-right">
                                                <button class="btn btn-primary" type="submit">
                                                    Pesquisar
                                                </button>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                          </form>
                    </div>
                  </div>
                </div>
            </div>
            <!--end options-->


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary  ml-auto" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- fim do modal filtros -->

    <script src="{{ asset('js/atalhos/agendamentos.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script src="{{ asset('js/datas/validate.min.js') }}"></script>
@endsection
