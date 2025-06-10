<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Remedio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();
        return view('admgerenciar', compact('remedios'));
    }

    public function adicionarFuncionario(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email', // corrigido aqui
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => 'funcionario',
        ]);

        return redirect()->back()->with('success', 'Funcionário cadastrado com sucesso!');
    }

}
