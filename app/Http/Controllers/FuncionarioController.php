<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();
        return view('funcionario.gerenciar', compact('remedios'));
    }

    public function adicionar(Request $request)
    {
        Remedio::create($request->all());
        return redirect()->back()->with('success', 'Remédio adicionado com sucesso!');
    }

    public function atualizar(Request $request, $id)
    {
        $remedio = Remedio::findOrFail($id);
        $remedio->update($request->all());
        return redirect()->back()->with('success', 'Remédio atualizado com sucesso!');
    }

    public function remover($id)
    {
        $remedio = Remedio::findOrFail($id);
        $remedio->delete();
        return redirect()->back()->with('success', 'Remédio removido com sucesso!');
    }
}
