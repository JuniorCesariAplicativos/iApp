@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">

    <style>
        .modal.left .modal-dialog { position:fixed; right: 0; margin: auto; width: 52rem; height: 100%; -webkit-transform: translate3d(0%, 0, 0); -ms-transform: translate3d(0%, 0, 0); -o-transform: translate3d(0%, 0, 0); transform: translate3d(0%, 0, 0); }
        .modal.left .modal-content { height: 100%; overflow-y: auto; border-radius: 0; border: none; }
        @media (min-width: 576px) {.modal.left .modal-dialog { max-width: 100rem; margin: 1.75rem auto; }}
    </style>
@endsection
@section('content')

    <div class="container">
        @csrf
        @if(isset($epi))
        <div style="text-align=center">
            <h1><span class="badge badge-soft-dark ml-1">ID do Epi: {{ $epi->EPI_ID  }}</span></h1>
            
            </div>
            <br>
            @endif
        <div class="row">
            <div class="col-12">
                <form action="{{ action('Configuracoes\EpiController@epi_salvar') }}" method="POST" id="form_epi">
                    @csrf                              
                    @if(isset($teste))
                        <input type="hidden" name="epi_id" value="{{ $teste->EPI_ID  }}">
                    @endif
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="input-label">Tipo de EPI</label>
                                        <select class="form-control select1" name="tipo">
                                            <option value="">Selecione...</option>
                                            @foreach($tipos as $tipo)
                                                <option value="{{$tipo}}" {{ isset($teste) && $teste->EPI_TIPO == $tipo ? 'selected' : ''  }} >{{$tipo}} </option> 
                                               
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                                
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="input-label">Dias de Revisão</label>
                                        <input class="form-control" id="date" type="text" name="diasRevisao"  value="{{ isset($teste) ? $teste->EPI_DIAS_REVISAO : '' }}" placeholder="Ex: Dias de uso necessários para a revisão. ">
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label class="input-label">Dias de Validade</label>
                                        <input type="text" name="diasValidade" class="form-control" value="{{ isset($teste) ? $teste->EPI_DIAS_VALIDADE : '' }}" placeholder="Ex: ">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" value="{{ isset($teste) ? $teste->EPI_DESCRICAO : '' }}" placeholder="Ex:Descrição do Epi ">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Fator Redução</label>
                                        <input type="text" name="fatorReducao" class="form-control" value="{{ isset($teste) ? $teste->EPI_FATOR_REDUCAO : '' }}" placeholder="Ex: Redução;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Epi Descartável</label>
                                        <select class="select1-selection custom-select"  id="epiDestatavel" name="descartavel"  onchange="verifica(this.value)" size="1" style="opacity: 1;"  value="{{ isset($teste) ? $teste->EPI_DESCARTAVEL : '' }}" >
                                            <option value="" class="js-select-custom" selected>Selecione</option>
                                            <option value="SIM">Sim</option>
                                            <option value="NÃO">Não</option>
                                        </select>
                                        
                                        <!-- value="{{ isset($teste) ? $teste->EPI_DESCARTAVEL : '' }}" -->
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6" >
                                    <div class="form-group">
                                        <label class="input-label">Devolver</label>
                                        <input type="text" name="devolver" id="devolver" class="form-control" value="{{ isset($teste) ? $teste->EPI_DEVOLVER : '' }}" placeholder="Ex: Itens de devolução do EPI;" disabled>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Valor</label>
                                        <input type="text" name="valor" class="form-control" value="{{ isset($teste) ? $teste->EPI_VALOR : '' }}" placeholder="Ex: Informar a validade do EPI em dias;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label"> Nº Almoxarifado</label>
                                        <input type="text" name="indentificacao" class="form-control" value="{{ isset($teste) ? $teste->EPI_IDENTIFICACAO : '' }}" placeholder="Ex: Informar a validade do EPI em dias;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Certificado</label>
                                        <input type="text" name="certificado" class="form-control" value="{{ isset($teste) ? $teste->EPI_CERTIFICADO : '' }}" placeholder="Ex: Informar a validade do EPI em dias;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Caracteristicas</label>
                                        <input type="text" name="caracteristica" class="form-control" value="{{ isset($teste) ? $teste->EPI_CARACTERISTICAS : '' }}" placeholder="Ex: Informar a validade do EPI em dias;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Estoque Mínino</label>
                                        <input type="text" name="estoque_minino" class="form-control" value="{{ isset($teste) ? $teste->EPI_QTDE_MINIMA : '' }}" placeholder="Ex: Informar a validade do EPI em dias;">
                                    </div>
                                </div>
                               <!--  <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Data Inutilização (Opicional) </label>
                                        <input class="form-control" id="date" type="date">
                                    </div>
                                </div> -->
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="input-label">Certificado Conformidade</label>
                                        <input type="text" name="conformidade" class="form-control"  value="{{ isset($teste) ? $teste->EPI_CONFORMIDADE : '' }}" placeholder="Ex: Número do certificado de conformidade e, em seguida, a sua data de validades.;">
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>

                        <div class="card-footer d-flex {{ isset($teste) ? 'justify-content-between' : 'justify-content-end' }}">
                            @if(isset($teste))

                                <a href="{{ route('configuracoes.epi.deletar') }}?id={{ $teste->EPI_ID }}" class="btn btn-danger btn-sm confirm">Excluir</a>
                            @endif
                            <button type="submit" class="btn btn-primary btn_header_hero btn-sm">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
@section('js')
    <script src="{{ asset('assets/js/money.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form_epi').validate();
           // $('.prec2').inputmask('decimal', @json(config('iapp.inputmask2')));
            $('.select1').selectpicker(@json(config('iapp.selectpicker')));
            $('.select2').selectpicker(@json(config('iapp.selectpicker')));
        });
    </script>

<script>
  $(document).on('ready', function () {
    // initialization of select picker
    $.HSCore.components.HSSelectPicker.init('.js-select');
  });
</script>

<script>
    function verifica(value){
	var input = document.getElementById("devolver");

        if(value == "SIM"){
            input.disabled = false; 
        }else if(value == "NÃO"){
            input.disabled = true;
        }
    };
</script>
@endsection
