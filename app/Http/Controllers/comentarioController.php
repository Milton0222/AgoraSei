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
            $comentarios=comentarios::join('instituicoes','comentarios.inst_id','=','instituicoes.id')->join('users','users.id','=','comentarios.user_id')
                            ->selectRaw('comentarios.id,comentarios.descricao,comentarios.created_at,users.name,users.isAdmin,users.isEst')
                            ->where('comentarios.inst_id',$insts['id'])
                            ->orderBy('comentarios.id','DESC')
                            ->get();
        

        return view('gerir.comentarios',compact('insts','comentarios'));

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
    public function update(Request $request, $id)
    {
        //
         if($coment=comentarios::find($id)){
          
              if($coment['user_id']==Auth::user()->id){
                    $coment->update([
                        'descricao'=>$request->descricao
                    ]);
                    alert(Auth::user()->name,'Comentarios actualizado','success');
              }else{
                  alert(Auth::user()->name,'Não é possivel actuyalizar comentario de outro utilizador','error');
              }
               return redirect()->route('coment.ver',$coment['inst_id']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if($coment=comentarios::find($id)){
          
              if($coment['user_id']==Auth::user()->id){
                    $coment->delete();
                    alert(Auth::user()->name,'Comentarios apagado','success');
              }else{
                  alert(Auth::user()->name,'Não é possivel apagar comentario de outro utilizador','error');
              }
               return redirect()->route('coment.ver',$coment['inst_id']);
        }
    }
}
