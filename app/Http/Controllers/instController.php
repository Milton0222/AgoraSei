<?php

namespace App\Http\Controllers;

use App\Models\instituicoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class instController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null)
    {
        //

        $request = $request ?: request();

        $query = instituicoes::query();

        if ($request->filled('nome')) {
            $query->where('descricao', 'LIKE', '%' . $request->nome . '%');
        }
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $inst = $query->get();

        return view('gerir.intituicoes', compact('inst'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mudar($id)
    {
        //
        $inst = instituicoes::findorfail($id);

        if ($inst['estado'] == 1) {
            $inst->update([
                'estado' => 0
            ]);
            alert($inst['descricao'], 'Foi arquivada.', 'success');
            return redirect()->route('inst.index');
        } else {
            $inst->update([
                'estado' => 1
            ]);
            alert($inst['descricao'], 'Foi Activada.', 'success');
            return redirect()->route('inst.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        if (Auth::user()->isAdmin) {
            // dd($request->all());
            $inst = instituicoes::create([
                'descricao' => $request->descricao,
                'tipo' => $request->tipo,
                'custo_licenciatura' => $request->custo_licenciatura,
                'provincia' => $request->provincia,
                'localizacao' => $request->localizacao,
                'qtd_estudante' => $request->qtd_estudante,
                'qtd_professor' => $request->qtd_professor,
                'modalidade_estudo' => $request->modalidade_estudo,
                'reconhecido' => $request->reconhecido,
                'amibiente_campus' => $request->ambiente_campus,
                'instagram' => $request->instagram,
                'linha_atendimento' => $request->linha_atendimento,
                'whatsap' => $request->whatsap,
                'facebook' => $request->facebook,
                'site' => $request->site,
                'inicio_funcao' => $request->inicio_funcao,
                'user_id' => Auth::user()->id
            ]);

            alert($inst['descricao'], 'Instituição resgistada', 'success');

            return redirect()->route('inst.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('inst.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::user()->isAdmin) {
            // dd($request->all());
            $inst = instituicoes::findorfail($id);
            $inst->update([
                'descricao' => $request->descricao,
                'tipo' => $request->tipo,
                'custo_licenciatura' => $request->custo_licenciatura,
                'provincia' => $request->provincia,
                'localizacao' => $request->localizacao,
                'qtd_estudante' => $request->qtd_estudante,
                'qtd_professor' => $request->qtd_professor,
                'modalidade_estudo' => $request->modalidade_estudo,
                'reconhecido' => $request->reconhecido,
                'amibiente_campus' => $request->ambiente_campus,
                'instagram' => $request->instagram,
                'linha_atendimento' => $request->linha_atendimento,
                'whatsap' => $request->whatsap,
                'facebook' => $request->facebook,
                'site' => $request->site,
                'inicio_funcao' => $request->inicio_funcao,
            ]);

            alert($inst['descricao'], 'Dados da Instituição actualizados', 'success');

            return redirect()->route('inst.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('inst.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if (Auth::user()->isAdmin) {
            // dd($request->all());
            $inst = instituicoes::findorfail($id);
            $inst->delete();

            alert($inst['descricao'], 'Instituição apagada', 'success');

            return redirect()->route('inst.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('inst.index');
        }
    }
}
