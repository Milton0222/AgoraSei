<?php

namespace App\Http\Controllers;

use App\Models\comentarios;
use App\Models\instituicoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class comentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function comentarios($id)
    {
        //
        if(Auth::user()){
            $insts=instituicoes::findorfail($id);

        return view('gerir.comentarios',compact('insts'));

        }else{
            alert('AgoraSEI','Para fazer comentario, inicie sessão','info');
            return redirect()->route('login');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(Auth::user()){

        $insts=instituicoes::findorfail($request->inst_id);
          $coment=comentarios::create([
            'descricao'=>$request->descricao,
            'inst_id'=>$insts['id'],
            'user_id'=>Auth::user()->id
          ]);
          alert(Auth::user()->name,'Comentario registado.','success');
    
        return redirect()->route('coment.ver',$insts['id']);

        }else{
            alert('AgoraSEI','Para fazer comentario, inicie sessão','info');
            return redirect()->route('login');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
