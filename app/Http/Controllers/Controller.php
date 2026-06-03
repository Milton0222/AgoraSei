<?php

namespace App\Http\Controllers;

use App\Models\cursos;
use App\Models\departamentos;
use App\Models\instituicoes;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index1(Request $request = null)
    {
        //alert()->success('Welcome to the application!');


        $request = $request ?: request();

        $queryc = cursos::query();
        $queryi=instituicoes::query();

        if($request->filled('nome')){
              $queryc->where('nome','LIKE','%'.$request->nome.'%')->orwhere('area_conhecimento','LIKE','%'.$request->nome.'%');
        }
        if($request->filled('instnome')){
            $queryi->where('descricao','LIKE','%'.$request->instnome.'%')
            ->orwhere('localizacao','LIKE','%'.$request->instnome.'%');
        }

        $cursos=$queryc->get();
        $inst=$queryi->get();


        return view('welcome', compact('cursos', 'inst'));
    }

    public function dashboard()
    {
        //buscar instituicoes e quantidades de departamentos
        $relatorio1 = instituicoes::join('departamentos', 'departamentos.inst_id', 'instituicoes.id')
            ->selectRaw('instituicoes.tipo,instituicoes.descricao,instituicoes.inicio_funcao, count(departamentos.inst_id) as qtddepa')
            ->GroupBy('instituicoes.descricao', 'instituicoes.inicio_funcao', 'instituicoes.tipo')
            ->get();
        //contabilizar crescimento de cursos, inst e depa

        $instc = instituicoes::count();
        $depac = departamentos::count();
        $cursoc = cursos::count();

        return view('dashboard', compact('relatorio1', 'depac', 'instc', 'cursoc'));
    }

    //filltrar cursos por nome ou area de conhecimento

    public function filtrar_curso(Request $request)
    {

        $request = $request ?: request();

        $query = cursos::query();
    }
}
