<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use App\Models\instituicoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class depaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null)
    {
        //
        $request = $request ?: request();

        $query = departamentos::query();


        $inst = instituicoes::orderBy('created_at', 'DESC')->get();

        if($request->filled('nome')){
            $query->join('instituicoes','departamentos.inst_id','instituicoes.id')
          ->selectRaw('departamentos.id, nome, descricao, departamentos.created_at, instituicoes.id as inst_id')
            ->where('nome','LIKE','%'.$request->nome.'%');

        }elseif($request->filled('inst_id')){
            $query->join('instituicoes','departamentos.inst_id','instituicoes.id')
          ->selectRaw('departamentos.id, nome, descricao, departamentos.created_at, instituicoes.id as inst_id')
           ->where('departamentos.inst_id',$request->inst_id);

        }else{
            $query->join('instituicoes','departamentos.inst_id','instituicoes.id')
          ->selectRaw('departamentos.id, nome, descricao, departamentos.created_at, instituicoes.id as inst_id');

        }
          
        $depa = $query->get();

        return view('gerir.departamentos', compact('depa', 'inst'));
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
        if (Auth::user()) {

            $depa = departamentos::create([
                'nome' => $request->nome,
                'inst_id' => $request->inst_id
            ]);
            alert($depa['nome'], 'Registado.', 'success');

            return redirect()->route('depa.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('depa.index');
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
        if (Auth::user()) {
            $depa = departamentos::findorfail($id);

            $depa->update([
                'nome' => $request->nome,
                'inst_id' => $request->inst_id
            ]);
            alert($depa['nome'], 'Dados actualizados.', 'success');

            return redirect()->route('depa.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('depa.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (Auth::user()) {

            $depa = departamentos::findorfail($id);

            $depa->delete();

            alert($depa['nome'], 'Dados foram apagados.', 'success');

            return redirect()->route('depa.index');
        } else {
            alert(Auth::user()->name, 'Consultar administrador', 'error');

            return redirect()->route('depa.index');
        }
    }
}
