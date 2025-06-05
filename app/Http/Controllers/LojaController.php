<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;

class LojaController extends Controller
{
    public function index(Request $request)
    {
        $medicamentos = Medicamento::where('disponivel', true)->paginate(10);
        return view('loja.index', compact('medicamentos'));
    }
}
