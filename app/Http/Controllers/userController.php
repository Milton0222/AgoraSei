<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request = null)
    {
        //

        $request = $request ?: request();

        $query = User::query();

        if ($request->filled('email')) {
            $query->where('email', $request->email);
        }
        if ($request->filled('tipo')) {
            if ($request->tipo == 1) {
                $query->where('isAdmin', 1);
            } elseif ($request->tipo == 2) {
                $query->where('isEst', 1)->where('isAdmin',0);
            }
        }

        $users = $query->get();
        return view('gerir.users', compact('users'));
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
        if (Auth::user()->isAdmin == 1) {

            if ($request->tipo == 1) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => strtolower($request->email),
                    'password' => bcrypt(123456789),
                    'isAdmin' => 1,
                    'isEst' => 1
                ]);
                alert($user['name'], 'Utilizador registado como admin.', 'success');
            } elseif ($request->tipo == 2) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => strtolower($request->email),
                    'password' => bcrypt(123456789),
                    'isEst' => 1
                ]);
                alert($user['name'], 'Utilizador registado como estudante.', 'success');
            }
        } else {
            alert('AgoraSEI', 'Consultar administrador', 'info');
        }
        return redirect()->route('user.index');
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
        if (Auth::user()->isAdmin == 1) {

            $user = User::findorfail($id);
            if ($request->tipo == 1) {
                $user->update([
                    'name' => $request->name,
                    'email' => strtolower($request->email),
                    'isAdmin' => 1,
                    'isEst' => 1
                ]);
                alert($user['name'], 'Dados do Utilizador actualizado como admin.', 'success');
            } elseif ($request->tipo == 2) {
                $user->update([
                    'name' => $request->name,
                    'email' => strtolower($request->email),
                    'isEst' => 1
                ]);
                alert($user['name'], 'Dados do Utilizador actualizado como estudante.', 'success');
            }
        } else {
            alert('AgoraSEI', 'Consultar administrador', 'info');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (Auth::user()->isAdmin == 1) {

            $user = User::findorfail($id);
            $user->delete();
            alert($user['name'], 'Dados do Utilizador apagados.', 'success');
        } else {
            alert('AgoraSEI', 'Consultar administrador', 'info');
        }
        return redirect()->route('user.index');
    }
}
