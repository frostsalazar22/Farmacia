<?php

namespace App\Http\Controllers;

use App\Models\Remedio;

class ClienteController extends Controller
{
    public function index()
    {
        $remedios = Remedio::where('quantidade', '>', 0)->get();
        return view('cliente.loja', compact('remedios'));
    }

    public function comprar(Request $request, $id)
    {
        $remedio = Remedio::findOrFail($id);
        $quantidade = $request->input('quantidade');

        if ($remedio->quantidade >= $quantidade) {
            $remedio->quantidade -= $quantidade;
            $remedio->save();

            // Registra a venda
            Venda::create([
                'remedio_id' => $remedio->id,
                'cliente_id' => auth()->id(),
                'quantidade' => $quantidade,
            ]);

            return redirect()->back()->with('success', 'Compra realizada com sucesso!');
        }

        return redirect()->back()->with('error', 'Quantidade indisponível.');
    }
}
