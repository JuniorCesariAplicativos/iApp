<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EpiController extends Controller{
    private $data = [];

    public function epi_lista(Request $request) {
        $this->data['breadcrumbs'] = breadcrumb([
            [ 'text' => 'Configurações', 'link' => null ],
        ]);

        $this->data['title'] = "EPI's";

        $this->data['busca'] = $request->busca;

        $this->data['actions'] = [
            [ 'text' => "Adicionar EPI's", 'route' => route('configuracoes.epi.cadastro') ]
        ];
        
       
        $this->data['ep'] = \App\Models\Epi::ObterListagem(); 
        $this->data['view_mode'] = toggleView($request->view, \Route::currentRouteName());
        
        switch ($request->view) {
            case 'flex':
                $epis = \App\Models\Epi::ObterTodosEpis();
                $this->data['flex_data'] = \App\Helpers\FlexMonster::FlexListaEpi($epis);
                $this->data['num_rows'] = $epis->count();
            break;
            default:
                $this->data['ep'] = $epis= \App\Models\Epi::ObterTodosEpiComPaginacao($request->busca);
                $this->data['num_rows'] = $epis->total();
            break;
        }
      
        return view('configuracoes.epi.lista', $this->data);

    }
 
    public function epi_cadastro() {
        $this->data['breadcrumbs'] = breadcrumb([
            [ 'text' => 'Configurações', 'link' => null ],
            [ 'text' => 'Epi', 'link' => route('configuracoes.epi.lista') ],
        ]);

        
        $this->data['title'] = "Adicionar Epi's";  
        $this->data['tipos'] = \App\Models\Epi::tipoEpis(); // BOX
        // $this->data['todos'] = \App\Models\Epi::ObterTodosEpis(); 
        
        return view('configuracoes.epi.cadastro', $this->data);
    }
   
    public function epi_salvar(Request $request) {
        try {
            if($request->has('epi_id')) {
                if(!$epi = \App\Models\Epi::ObterEpis($request->epi_id)) return redirect()->route('configuracoes.epi.lista')->with('error', 'Epi não encontrado.');
                $epi->update([
                    'EPI_TIPO'=> $request->tipo,
                    'EPI_DIAS_VALIDADE' =>$request->diasValidade,
                    'EPI_DESCRICAO'=> $request->descricao,
                    'EPI_FATOR_REDUCAO'=> $request->fatorReducao,
                    'EPI_DIAS_REVISAO'=>$request->diasRevisao,
                    'EPI_DESCARTAVEL'=>$request->descartavel,
                    'EPI_DEVOLVER'=> $request->devolver,
                    'EPI_VALOR'=> $request->valor,
                    'EPI_IDENTIFICACAO' => $request->indentificacao,
                    'EPI_CERTIFICADO'=> $request->certificado,
                    'EPI_INSTRUCAO_USO'=> $request->instrucao,
                    'EPI_CARACTERISTICAS'=>$request->caracteristica,
                    'EPI_QTDE_MINIMA'=> $request->estoque_minino,
                    'EPI_CONFORMIDADE'=> $request->conformidade, 
                    'EPI_USER_CREATE' => \Auth::user()->USUARIOS_ID,
                    'EPI_USER_UPDATE' => \Auth::user()->USUARIOS_ID,
                    'EPI_ESTABELECIMENTOS_ID' => \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID,
                ]);
            } else {
                $epi = \App\Models\Epi::ContaTodosEpis() + 1;
                \App\Models\Epi::create([
                    'EPI_TIPO' => $request->tipo,
                    'EPI_DIAS_VALIDADE' =>$request->diasValidade,
                    'EPI_DESCRICAO'=>$request->descricao,
                    'EPI_FATOR_REDUCAO'=>$request->fatorReducao,
                    'EPI_DIAS_REVISAO'=>$request->diasRevisao,
                    'EPI_DESCARTAVEL'=>$request->descartavel,
                    'EPI_DEVOLVER'=>$request->devolver,
                    'EPI_VALOR'=>$request->valor,
                    'EPI_IDENTIFICACAO' => $request->indentificacao,
                    'EPI_CERTIFICADO'=>$request->certificado,
                    'EPI_INSTRUCAO_USO'=> $request->instrucao,
                    'EPI_CARACTERISTICAS'=>$request->caracteristica,
                    'EPI_QTDE_MINIMA'=>$request->estoque_minino,
                    'EPI_CONFORMIDADE'=>$request->conformidade, 
                    'EPI_USER_CREATE' => \Auth::user()->USUARIOS_ID,
                    'EPI_USER_UPDATE' => \Auth::user()->USUARIOS_ID,
                    'EPI_ESTABELECIMENTOS_ID' => \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID,
                    
                ]);
                
            }

        } catch (\Exception $e) {
            logging($e);
            return redirect()->back()->with('error', 'Não foi possível completar a operação.');
        }

        return redirect()->route('configuracoes.epi.lista')->with('success', 'Operação completada com sucesso.');
    }
     
    public function epi_editar(Request $request) {
        if(!$request->has('id')) return redirect()->route('configuracoes.epi.lista')->with('error', 'Epi não encontrado.');
        if(!$epi = \App\Models\Epi::ObterEpis($request->id)) return redirect()->route('configuracoes.epi.lista')->with('error', 'Epi não encontrado.');

        $this->data['title'] = 'Editando Epi';
        $this->data['teste'] = $epi; 
        $this->data['tipos'] = \App\Models\Epi::tipoEpis(); 
        // $this->data['todos'] = \App\Models\Epi::ObterTodosEpis();

        $this->data['breadcrumbs'] = breadcrumb([
            [ 'text' => 'Configurações', 'link' => null ],
            [ 'text' => 'Epis', 'link' => route('configuracoes.epi.lista') ],
        ]);

        return view('configuracoes.epi.cadastro', $this->data);
    } 

    public function epi_deletar(Request $request) {
        if(!$request->has('id')) return redirect()->route('configuracoes.epi.lista')->with('error', 'Epi não encontrado.');
        if(!$epi = \App\Models\Epi::ObterEpis($request->id)) return redirect()->route('configuracoes.epi.lista')->with('error', 'Epi não encontrado.');

        $epi->update([
            'EPI_DATA_DELETE' => \Carbon\Carbon::now(),
            'EPI_USER_DELETE' => \Auth::user()->USUARIOS_ID,
            'EPI_D_E_L_E_T_E' => 1,
        ]);

        return redirect()->route('configuracoes.epi.lista')->with('success', 'Operação completada com sucesso.');
    }
}

    
   


