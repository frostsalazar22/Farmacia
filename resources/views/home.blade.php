@extends('layouts.public')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">Bem-vindo à Farmácia</h1>
        <p class="mt-4 text-gray-600">Escolha seu tipo de acesso:</p>
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Botão para Funcionário -->
        <a href="{{ route('funcionario.gerenciar') }}" class="group">
            <div class="p-6 bg-white rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <h2 class="text-xl font-semibold text-gray-800">Funcionário</h2>
                <p class="text-gray-600 mt-2">Gerencie os remédios disponíveis no sistema.</p>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Acessar Sistema
                    </button>
                </div>
            </div>
        </a>

        <!-- Botão para Administrador -->
        <a href="{{ route('admin.gerenciar') }}" class="group">
            <div class="p-6 bg-white rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <h2 class="text-xl font-semibold text-gray-800">Administrador</h2>
                <p class="text-gray-600 mt-2">Gerencie usuários e remédios cadastrados.</p>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600">
                        Acessar Sistema
                    </button>
                </div>
            </div>
        </a>

    </div>
</div>
@endsection
