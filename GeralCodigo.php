AdminController.php(
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adicionarFuncionario(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
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
)

FuncionarioController.php(
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
)


Remedio.php(
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'quantidade',
        'miligrama',
        'validade',
        'preco',
    ];
}
)

User.php(
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'name', 'email', 'password', 'tipo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
)


Usuario.php(
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 'email', 'password', 'tipo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
)


AppLayout.php(
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
)

2014_10_12_000000_create_users_table.php(
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
)
2025_06_09_180803_create_remedios_table.php(
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('remedios', function (Blueprint $table) {
        $table->id();
        $table->string('Nome');
        $table->integer('Quantidade');
        $table->string('Miligrama')->nullable(); // exemplo: "500mg" ou "20g"
        $table->date('Validade')->nullable();
        $table->decimal('Preco', 8, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remedios');
    }
};
)



2025_06_09_180815_create_usuarios_table.php(
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('email')->unique();
        $table->string('password');
        $table->enum('tipo', ['funcionario', 'admin']);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
)


admgerenciar.blade.php(
<h1>Gerenciamento de Remédios</h1>

<a href="{{ route('logout') }}">Logout</a>

<h2>Cadastro de Novo Funcionário</h2>
<form method="POST" action="{{ route('admin.adicionarFuncionario') }}">
    @csrf
    <input type="text" name="name" placeholder="Nome">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Senha">
    <button type="submit">Cadastrar Funcionário</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Miligrama</th>
            <th>Validade</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($remedios as $remedio)
            <tr>
                <td>{{ $remedio->nome }}</td>
                <td>{{ $remedio->quantidade }}</td>
                <td>{{ $remedio->miligrama }}</td>
                <td>{{ $remedio->validade }}</td>
                <td>R$ {{ number_format($remedio->preco, 2, ',', '.') }}</td>
                <td>
                    <form action="{{ route('funcionario.atualizar', $remedio->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="nome" value="{{ $remedio->nome }}">
                        <input type="number" name="quantidade" value="{{ $remedio->quantidade }}">
                        <input type="text" name="miligrama" value="{{ $remedio->miligrama }}">
                        <input type="date" name="validade" value="{{ $remedio->validade }}">
                        <input type="number" step="0.01" name="preco" value="{{ $remedio->preco }}">
                        <button type="submit">Atualizar</button>
                    </form>

                    <form action="{{ route('funcionario.remover', $remedio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Adicionar Novo Remédio</h3>

<form action="{{ route('funcionario.adicionar') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome do Remédio">
    <input type="number" name="quantidade" placeholder="Quantidade">
    <input type="text" name="miligrama" placeholder="Ex: 500mg, 20g">
    <input type="date" name="validade">
    <input type="number" step="0.01" name="preco" placeholder="Preço">
    <button type="submit">Adicionar</button>
</form>
)


gerenciar.blade.php(
<h1>Gerenciamento de Remédios</h1>
<a href="{{ route('logout') }}">Logout</a>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Miligrama</th>
            <th>Validade</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($remedios as $remedio)
            <tr>
                <td>{{ $remedio->nome }}</td>
                <td>{{ $remedio->quantidade }}</td>
                <td>{{ $remedio->miligrama }}</td>
                <td>{{ $remedio->validade }}</td>
                <td>R$ {{ number_format($remedio->preco, 2, ',', '.') }}</td>
                <td>
                    <form action="{{ route('funcionario.atualizar', $remedio->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="nome" value="{{ $remedio->nome }}">
                        <input type="number" name="quantidade" value="{{ $remedio->quantidade }}">
                        <input type="text" name="miligrama" value="{{ $remedio->miligrama }}">
                        <input type="date" name="validade" value="{{ $remedio->validade }}">
                        <input type="number" step="0.01" name="preco" value="{{ $remedio->preco }}">
                        <button type="submit">Atualizar</button>
                    </form>

                    <form action="{{ route('funcionario.remover', $remedio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Adicionar Novo Remédio</h3>

<form action="{{ route('funcionario.adicionar') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome do Remédio">
    <input type="number" name="quantidade" placeholder="Quantidade">
    <input type="text" name="miligrama" placeholder="Ex: 500mg, 20g">
    <input type="date" name="validade">
    <input type="number" step="0.01" name="preco" placeholder="Preço">
    <button type="submit">Adicionar</button>
</form>
)

public.blade.php(
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Farmácia Online')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
</body>
</html>
)



dashboard.blade.php(
@extends('layouts.app')

@section('content')
    <h1>Bem-vindo ao Dashboard</h1>
@endsection
)




home.blade.php(@extends('layouts.public')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">Bem-vindo à Farmácia Online</h1>
        <p class="mt-4 text-gray-600">Escolha sua opção abaixo:</p>
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Botão para Cliente -->
        <a href="{{ route('cliente.index') }}" class="group">
            <div class="p-6 bg-white rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <h2 class="text-xl font-semibold text-gray-800">Cliente</h2>
                <p class="text-gray-600 mt-2">Acesse a loja e faça suas compras.</p>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Acessar Loja
                    </button>
                </div>
            </div>
        </a>

        <!-- Botão para Funcionário -->
        <a href="{{ route('funcionario.gerenciar') }}" class="group">
            <div class="p-6 bg-white rounded-lg shadow-lg transform transition-transform duration-300 hover:scale-105">
                <h2 class="text-xl font-semibold text-gray-800">Funcionário</h2>
                <p class="text-gray-600 mt-2">Gerencie os remédios e mais.</p>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Acessar Gerenciamento
                    </button>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
)



web.php(<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.gerenciar');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
});


// ROTAS SEM LOGIN:
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');


Route::middleware('auth')->group(function () {
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.gerenciar');

    // 🟢 Adicionar novo remédio (POST)
    Route::post('/funcionario/adicionar', [FuncionarioController::class, 'adicionar'])->name('funcionario.adicionar');

    // 🟢 Atualizar remédio (PUT)
    Route::put('/funcionario/{id}/atualizar', [FuncionarioController::class, 'atualizar'])->name('funcionario.atualizar');

    // 🟢 Remover remédio (DELETE)
    Route::delete('/funcionario/{id}/remover', [FuncionarioController::class, 'remover'])->name('funcionario.remover');
});


Route::get('/dashboard', function () {
    return view('dashboard'); // crie essa view ou redirecione para outra página
})->middleware(['auth'])->name('dashboard');



Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');






// Rota para o ADM
Route::post('/admin/adicionar-funcionario', [AdminController::class, 'adicionarFuncionario'])->name('admin.adicionarFuncionario');

require __DIR__.'/auth.php';


)






