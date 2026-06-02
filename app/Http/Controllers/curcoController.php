<?php

namespace App\Http\Controllers;

use App\Models\cursos;
use App\Models\departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class curcoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null)
    {
        //
        $request = $request ?: request();

        $query = cursos::query();
        if ($request->filled('nome')) {
            $query->where('nome', 'LIKE', '%' . $request->nome . '%');
        }
        if ($request->filled('depa_id')) {
            $query->where('depa_id', $request->depa_id);
        }


        $curso = $query->get();
        $depa = departamentos::get();


        return view('gerir.cursos', compact('curso', 'depa'));
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
        if (departamentos::find($request->depa_id)) {

            // dd($request->all());
            $veri = cursos::create([
                'nome' => $request->nome,
                'duracao' => $request->duracao,
                'mensalidade' => $request->mensalidade,
                'area_conhecimento' => $request->area_conhecimento,
                'qtd_disciplina' => $request->qtd_disciplina,
                'qtd_vaga' => $request->qtd_vaga,
                'nivel_academico' => $request->nivel_academico,
                'depa_id' => $request->depa_id
            ]);

            alert($veri['nome'], 'Curso registado.', 'success');
            return redirect()->route('curco.index');
        } else {
            alert(Auth::user()->name, 'Verificar departaemnto.', 'error');
            return redirect()->route('curco.index');
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
        if (departamentos::find($request->depa_id)) {
            $veri = cursos::findorfail($id);

            $veri->update([
                'nome' => $request->nome,
                'duracao' => $request->duracao,
                'mensalidade' => $request->mensalidade,
                'area_conhecimento' => $request->area_conhecimento,
                'qtd_disciplina' => $request->qtd_disciplina,
                'qtd_vaga' => $request->qtd_vaga,
                'nivel_academico' => $request->nivel_academico,
                'depa_id' => $request->depa_id
            ]);

            alert($veri['nome'], 'Dados actualizado.', 'success');
            return redirect()->route('curco.index');
        } else {
            alert(Auth::user()->name, 'Verificar departaemnto.', 'error');
            return redirect()->route('curco.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if ($veri = cursos::find($id)) {

            $veri->delete();

            alert($veri['nome'], 'Dados apagados.', 'success');
            return redirect()->route('curco.index');
        } else {
            alert(Auth::user()->name, 'Verificar dados do curso.', 'error');
            return redirect()->route('curco.index');
        }
    }
}
