<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epi extends Model
{
    use HasFactory;

    protected $table = 'epi';

    protected $primaryKey = 'EPI_ID';

    public $timestamps = false;

    protected $fillable = [
        'EPI_ID',       
        'EPI_TIPO',
        'EPI_DIAS_VALIDADE',
        'EPI_DESCRICAO',
        'EPI_DIAS_REVISAO',
        'EPI_FATOR_REDUCAO',
        'EPI_DESCARTAVEL',
        'EPI_DEVOLVER',
        'EPI_INSTRUCAO_USO',
        'EPI_VALOR',
        'EPI_IDENTIFICACAO',
        'EPI_CERTIFICADO',
        'EPI_CARACTERISTICAS',
        'EPI_CONFORMIDADE',
        'EPI_QTDE_MINIMA',
        'EPI_QTDE_SALDO',
        'EPI_DATA_CREATE',
        'EPI_DATA_UPDATE',
        'EPI_USER_CREATE',
        'EPI_USER_UPDATE',
        'EPI_DATA_DELETE',
        'EPI_USER_DELETE',
        'EPI_D_E_L_E_T_E',
        'EPI_ESTABELECIMENTOS_ID',
        
    ];

     /* RELATIONSHIPS */
     public function permissoes() {
        return $this->belongsToMany(\App\Models\Permissoes::class, 'epi_permissoes', 'EPI_PERMISSOES_EPI_ID', 'EPI_PERMISSOES_PERMISSOES_ID');
    }

    public function epi() {
        return $this->belongsTo(\App\Models\Epi::class, 'EPI_ID');
    }


    /* FUNCTIONS */
    public static function tipoEpis() {
        return [
            'Proteção auditiva',
            'Proteção respiratória',
            'Proteção visual e facial',
            'Proteção da cabeça',
            'Proteção de mãos e braços',
            'Proteção de pernas e pés',
            'Proteção contra quedas',
        ];
    }

     public static function ObterEpi($text= '') {
        return \App\Models\Epi::where('EPI_IDENTIFICACAO','LIKE','%'.$text.'%')
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->select(
                    'EPI_ID',       
                    'EPI_TIPO',
                    'EPI_DIAS_REVISAO',
                    'EPI_DIAS_VALIDADE',
                    'EPI_DESCRICAO',
                    'EPI_FATOR_REDUCAO',
                    'EPI_DESCARTAVEL',
                    'EPI_DEVOLVER',
                    'EPI_INSTRUCAO_USO',
                    'EPI_VALOR',
                    'EPI_IDENTIFICACAO',
                    'EPI_CERTIFICADO',
                    'EPI_CARACTERISTICAS',
                    'EPI_CONFORMIDADE',
                    'EPI_QTDE_MINIMA',
                    'EPI_QTDE_SALDO',
                    'EPI_D_E_L_E_T_E',
                    'EPI_ESTABELECIMENTOS_ID',
                    
                )
                ->get();
               
    }
 
  
/*   
    public static function ObterTodosEpiPorTipo($tipo) {
        return \App\Models\Epi::where('EPI_TIPO', $tipo)
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->select(
                    'EPI_ID',
                    'EPI_IDENTIFICACAO	',
                    'EPI_INSTRUCAO_USO',
                    'EPI_TIPO',
                    'EPI_ESTABELECIMENTOS_ID',
                    
                )
                ->get();
    } */

    public static function ObterEpiPorTipo($id, $tipo) {
        return \App\Models\Epi::where('EPI_ID ', $id)
                ->where('EPI_TIPO', $tipo)
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->first();
    }
    

    public static function ObterTodosEpiPorTipoAcesso() {
        return \App\Models\Epi::with('permissoes')
                ->where('EPI_TIPO', 'ACESSO')
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->select(
                    'EPI_ID',       
                    'EPI_TIPO',
                    'EPI_DIAS_REVISAO',
                    'EPI_DIAS_VALIDADE',
                    'EPI_DESCRICAO',
                    'EPI_FATOR_REDUCAO',
                    'EPI_DESCARTAVEL',
                    'EPI_DEVOLVER',
                    'EPI_INSTRUCAO_USO',
                    'EPI_VALOR',
                    'EPI_IDENTIFICACAO',
                    'EPI_CERTIFICADO',
                    'EPI_CARACTERISTICAS',
                    'EPI_CONFORMIDADE',
                    'EPI_QTDE_MINIMA',
                    'EPI_QTDE_SALDO',
                    'EPI_D_E_L_E_T_E',
                    'EPI_ESTABELECIMENTOS_ID',
                )
                ->get();
    }

    public static function ObterTodosEpis() {
        return \App\Models\Epi::with('epi')
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID) // with('ep')
                ->where('EPI_D_E_L_E_T_E', '0')
                ->select(
                    'EPI_ID',       
                    'EPI_TIPO',
                    'EPI_DIAS_REVISAO',
                    'EPI_DIAS_VALIDADE',
                    'EPI_DESCRICAO',
                    'EPI_FATOR_REDUCAO',
                    'EPI_DESCARTAVEL',
                    'EPI_DEVOLVER',
                    'EPI_INSTRUCAO_USO',
                    'EPI_VALOR',
                    'EPI_IDENTIFICACAO',
                    'EPI_CERTIFICADO',
                    'EPI_CARACTERISTICAS',
                    'EPI_CONFORMIDADE',
                    'EPI_QTDE_MINIMA',
                    'EPI_QTDE_SALDO',
                    'EPI_D_E_L_E_T_E',
                    'EPI_ESTABELECIMENTOS_ID',
                )
                ->get();
    }

    public static function ContaTodosEpis() {
        return \App\Models\Epi::where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->count();
    }

    public static function ObterEpis($id) {
        return \App\Models\Epi::where('EPI_ID', $id)
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->first();
    }

    public static function ObterListagem(){
        return \App\Models\Epi::where('EPI_ID')
            ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
            ->where('EPI_D_E_L_E_T_E', '0')
            ->select(
                'EPI_ID',
                'EPI_TIPO',
                'EPI_DESCRICAO',
                'EPI_DIAS_REVISAO',
                'EPI_DIAS_VALIDADE',
                'EPI_FATOR_REDUCAO',
                'EPI_DESCARTAVEL',
                'EPI_DEVOLVER',
                'EPI_INSTRUCAO_USO',
                'EPI_VALOR',
                'EPI_IDENTIFICACAO',
                'EPI_CERTIFICADO',
                'EPI_CARACTERISTICAS',
                'EPI_CONFORMIDADE',
                'EPI_QTDE_MINIMA',
                'EPI_QTDE_SALDO',
                'EPI_ESTABELECIMENTOS_ID',
            )
            ->get();
    }

    public static function ObterTodosEpiComPaginacao($text = null) {
        return \App\Models\Epi::where(function($query) use ($text) {
                    if($text) $query->where('EPI_TIPO', 'LIKE', '%'.$text.'%');
                })
                ->where('EPI_ESTABELECIMENTOS_ID', \Auth::user()->USUARIOS_ESTABELECIMENTOS_ID)
                ->where('EPI_D_E_L_E_T_E', '0')
                ->select(
                    'EPI_ID',
                    'EPI_TIPO',
                    'EPI_DESCRICAO',
                    'EPI_DIAS_REVISAO',
                    'EPI_DIAS_VALIDADE',
                    'EPI_FATOR_REDUCAO',
                    'EPI_DESCARTAVEL',
                    'EPI_DEVOLVER',
                    'EPI_INSTRUCAO_USO',
                    'EPI_VALOR',
                    'EPI_IDENTIFICACAO',
                    'EPI_CERTIFICADO',
                    'EPI_CARACTERISTICAS',
                    'EPI_CONFORMIDADE',
                    'EPI_QTDE_MINIMA',
                    'EPI_QTDE_SALDO',
                    'EPI_ESTABELECIMENTOS_ID',                    
                )
                ->paginate(50);
    }


    
    
    
}
