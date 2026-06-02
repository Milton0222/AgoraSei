<?php

namespace App\Http\Controllers;

use App\Models\actividades;
use App\Models\instituicoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class activController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null)
    {
        //
        $request = $request ?: request();

        $query = actividades::query();
        $inst = instituicoes::orderBy('id', 'DESC')->get();


        //consulta
        if ($request->filled('nome')) {

            $query->join('instituicoes', 'actividades.inst_id', 'instituicoes.id')
                ->selectRaw('actividades.id,actividades.inst_id, instituicoes.descricao as nome,actividades.descricao, actividades.created_at')
                ->where('actividades.descricao', 'LIKE', '%' . $request->nome . '%');
            $activ = $query->get();


            return view('gerir.actividades', compact('inst', 'activ'));
        }
        if ($request->filled('id')) {
            $query->join('instituicoes', 'actividades.inst_id', 'instituicoes.id')
                ->selectRaw('actividades.id,actividades.inst_id, instituicoes.descricao as nome,actividades.descricao, actividades.created_at')
                ->where('actividades.inst_id', $request->id);

            $activ = $query->get();


            return view('gerir.actividades', compact('inst', 'activ'));
        } else {

            $query->join('instituicoes', 'actividades.inst_id', 'instituicoes.id')
                ->selectRaw('actividades.id,actividades.inst_id, instituicoes.descricao as nome,actividades.descricao, actividades.created_at');
            $activ = $query->get();


            return view('gerir.actividades', compact('inst', 'activ'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (instituicoes::find($request->inst_id)) {
            $veri = actividades::create([
                'descricao' => $request->descricao,
                'inst_id' => $request->inst_id
            ]);

            alert($veri['descricao'], 'Registada.', 'success');
            return redirect()->route('activ.index');
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
        if (instituicoes::find($request->inst_id)) {
            $veri = actividades::findorfail($id);
            $veri->update([
                'descricao' => $request->descricao,
                'inst_id' => $request->inst_id
            ]);

            alert($veri['descricao'], 'Dados actualizados.', 'success');
            return redirect()->route('activ.index');
        } else {
            alert(Auth::user()->name, 'Verificar instituição', 'error');
            return redirect()->route('activ.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if ($veri = actividades::find($id)) {
            $veri->delete();

            alert($veri['descricao'], 'Dados apagados.', 'success');
            return redirect()->route('activ.index');
        } else {
            alert(Auth::user()->name, 'Verificar actividade', 'error');
            return redirect()->route('activ.index');
        }
    }
}
