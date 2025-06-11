<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Remedio;

class RemedioController extends Controller
{
    public function index()
    {
        $remedios = Remedio::all();

        if (Auth::user()->is_admin) {
            return view('admgerenciar', [
                'remedios' => $remedios,
                'user' => Auth::user()
            ]);
        } else {
            return view('gerenciar', [
                'remedios' => $remedios,
                'user' => Auth::user()
            ]);
        }
    }

    public function store(Request $request)
    {
$request->validate([
    'nome' => [
        'required',
        'string',
        'max:100',
        'regex:/^[A-Za-zÀ-ú\s]{3,100}$/'
    ],
    'quantidade' => 'required|integer|min:1|max:10000',
    'miligrama' => [
        'required',
        'string',
        'max:20',
        'regex:/^\d+(mg|g|ml)$/i'  // Exemplo: 500mg, 20g, 10ml
    ],
    'validade' => 'required|date|after:today',
    'preco' => 'required|numeric|min:0.01|max:9999.99',
]);

        Remedio::create($request->all());

        return redirect()->back()->with('success', 'Remédio adicionado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $remedio = Remedio::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'miligrama' => 'required|string|max:50',
            'validade' => 'required|date',
            'preco' => 'required|numeric|min:0',
        ]);

        $remedio->update($request->all());

        return redirect()->back()->with('success', 'Remédio atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $remedio = Remedio::findOrFail($id);
        $remedio->delete();

        return redirect()->back()->with('success', 'Remédio removido com sucesso!');
    }
}
