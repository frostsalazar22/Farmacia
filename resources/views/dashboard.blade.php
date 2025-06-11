@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
        <h1 class="text-2xl font-bold text-red-600 mb-4">Acesso Negado</h1>
        <p class="text-gray-700 mb-4">Você não está autorizado a acessar essa área do sistema.</p>
        <a href="{{ route('home') }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Voltar para a Página Inicial</a>
    </div>
</div>
@endsection
