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
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-zÀ-ú\s]{2,50}$/'
            ],
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string|min:6|max:20',
            'role' => 'required|in:funcionario,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,

        ]);

        return redirect()->back()->with('success', 'Funcionário cadastrado com sucesso!');
    }

}
