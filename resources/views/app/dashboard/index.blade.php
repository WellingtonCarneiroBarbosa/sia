@extends('layouts.dashboard')

@section('title', 'Dashboard')

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
                    <a href="{{route('schedules.canceled.index')}}" class="btn btn-sm btn-neutral mb-2">Cancelados</a>
                    <a href="#" data-toggle="modal" data-target="#modal-filter" id="filtros-agendamento" class="btn btn-sm btn-neutral mb-2 mr-2">Filtros</a>
                </div>
              </div>
            <!-- fim do header -->
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

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><i class="fas fa-thumbs-down"></i><strong> Ops...</strong>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif

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
                        @if ($hasSchedules)
                <tr>
                  <td class="budget">
                    Sem Dados
                  </td>
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

              @else <!-- se houver agendamentos -->

                  <tr>
                    <td class="budget">
                      Sem Dados
                    </td>
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
                @endif
              </tbody><!-- fim do corpo da tabela -->
          <div class="float-right">
            {{ $schedules->links() }}
          </div>

        <br>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- fim da tabela de agendamentos -->
        
      <!-- fim do conteudo da pagina -->

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
                      <form action="{{route('schedules.findPer.date')}}" onsubmit="loader()" method="POST">
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
                        <form action="{{route('schedules.findPer.dateAndPlace')}}" onsubmit="loader()" method="POST">
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
                        <form action="{{route('schedules.findPer.specificDate')}}" onsubmit="loader()" method="POST">
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


@endsection

@section('scripts')
<script src="{{ asset('js/atalhos/agendamentos.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
<script src="{{ asset('js/datas/validate.min.js') }}"></script>
@endsection
