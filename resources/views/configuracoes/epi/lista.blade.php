@extends('layouts.app')
@section('css')
    @include('includes.css_listas')
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @switch($view_mode['mode'])
                        @case('flex')
                            <div class="card-body">
                                <div id="pivotContainer"></div>
                            </div>
                        @break
                        @default
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center flex-grow-1">
                                    <div class="col-12 col-md">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-header-title">Lista de EPI's</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        @include('includes.search_page')
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive datatable-custom">
                                    <table id="datatableWithSearch" class="table table-borderless table-thead-bordered table-nowrap table-striped table-align-middle card-table" data-hs-datatables-options='{ "order": [], "paging": false }'>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width:200px;min-width:200px;">Tipos de EPI´s</th>
                                                <th style="width:200px;min-width:200px;">Dias Revisão</th>
                                                <th style="width:200px;min-width:200px;">Descrição</th>
                                                <th style="width:200px;min-width:200px;">Dias Validade</th>
                                                <th style="width:200px;min-width:200px;">Fator Redução</th>
                                                <th style="width:200px;min-width:200px;">Epi Descartavel</th>  
                                                <th style="width:200px;min-width:200px;">Epi Devolver</th>   <!--Devolver  -->
                                                <th style="width:200px;min-width:200px;">Valor</th>
                                                <th style="width:200px;min-width:200px;">Nº Almoxarifado</th>
                                                <th style="width:200px;min-width:200px;">Certificado</th>
                                                <th style="width:200px;min-width:200px;">Caracteristica</th>
                                                <th style="width:200px;min-width:200px;">Estoque Minino</th>
                                                <!-- <th style="width:200px;min-width:200px;">Saldo Estoque</th> -->
                                                <!-- <th style="width:200px;min-width:200px;">Data Inutilização</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ep as $epi)
                                                <tr>
                                                    <td>
                                                        <a class="media align-items-center" href="{{ route('configuracoes.epi.editar') }}?id={{ $epi->EPI_ID }}">
                                                            <div class="media-body">
                                                            <span class="d-block h5 text-hover-primary mb-0">{{ $epi->EPI_TIPO}}</span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>{{ $epi-> EPI_DIAS_REVISAO }}</td>
                                                    <td>{{ $epi-> EPI_DESCRICAO }}</td>
                                                    <td>{{ $epi-> EPI_DIAS_VALIDADE }}</td>
                                                    <td>{{ $epi-> EPI_FATOR_REDUCAO }}</td>
                                                    <td>{{ $epi-> EPI_DESCARTAVEL}}</td>
                                                    <td>{{ $epi-> EPI_DEVOLVER }}</td>
                                                    <td>{{ $epi-> EPI_VALOR }}</td>
                                                    <td>{{ $epi-> EPI_IDENTIFICACAO }}</td>
                                                    <td>{{ $epi-> EPI_CERTIFICADO }}</td>
                                                    <td>{{ $epi-> EPI_CARACTERISTICAS }}</td>
                                                    <td>{{ $epi-> EPI_QTDE_MINIMA }}</td>
                                                    <!-- <td>{{ $epi-> EPI_QTDE_SALDO }}</td> -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center justify-content-sm-end">
                                {{ $ep->appends([ 'busca' => $busca ])->onEachSide(0)->links('vendor.pagination.default')}}
                                
                                    
                                </div>
                            </div>
                        @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('includes.js_listas')
@endsection