@extends('layouts.public')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-6">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">Bem-vindo à Farmácia</h1>
        <p class="mt-4 text-gray-600">Escolha seu tipo de acesso:</p>
    </div>

    {{-- Alerta de acesso não autorizado --}}
    @if(session('error'))
        <div class="mt-4 px-4 py-2 bg-red-100 text-red-700 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Acesso Funcionário -->
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

        <!-- Acesso Administrador -->
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

    @guest
        <div class="mt-6 text-center text-gray-600">
            <p>Você precisa <a href="{{ route('login') }}" class="text-blue-600 hover:underline">fazer login</a> para acessar as áreas do sistema.</p>
        </div>
    @endguest
</div>
@endsection
