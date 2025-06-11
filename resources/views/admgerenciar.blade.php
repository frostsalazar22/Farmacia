<!DOCTYPE html>
<html>
<head>
    <title>Admin - Gerenciar Remédios</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>
        function toggleEdit(id) {
            const row = document.getElementById('row-' + id);
            row.classList.toggle('show-edit');
        }
    </script>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => toast.remove(), 4000);
            });
        });
    </script>

    <header>
        <div>Gerenciamento de Remédios</div>
        <div>
            <span class="user-info">{{ Auth::user()->name }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">





        {{-- Mensagens de alerta --}}
        @if(session('success'))
            <div class="toast toast-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="toast toast-error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="toast toast-error">
                <ul style="margin: 0; padding: 0; list-style: none;">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
















        <h2>Cadastro de Novo Funcionário</h2>
    <form method="POST" action="{{ route('admin.adicionarFuncionario') }}" class="form-horizontal">
        @csrf
        <input type="text" name="name" placeholder="Nome" required maxlength="50" pattern="[A-Za-zÀ-ú\s]+">
        <input type="email" name="email" placeholder="Email" required maxlength="100">
        <input type="password" name="password" placeholder="Senha" required minlength="6" maxlength="20">

        <select name="role" required>
            <option value="">Tipo de Usuário</option>
            <option value="funcionario">Funcionário</option>
            <option value="admin">Administrador</option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>



        <h3 class="form-title">Adicionar Novo Remédio</h3>
        <form action="{{ route('funcionario.adicionar') }}" method="POST" class="form-horizontal">
            @csrf
            <input type="text" name="nome" placeholder="Nome do Remédio" maxlength="100" required pattern="[A-Za-zÀ-ú\s]+">
            <input type="number" name="quantidade" placeholder="Quantidade" min="1" max="10000" required>
            <input type="text" name="miligrama" placeholder="Ex: 500mg, 20g" maxlength="20" required pattern="^\d+(mg|g|ml)$">
            <input type="date" name="validade" required>
            <input type="number" step="0.01" name="preco" placeholder="Preço" min="0.01" max="9999.99" required>
            <button type="submit">Adicionar</button>
        </form>


        <h2>Remédios</h2>
        <table>
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
                    <tr id="row-{{ $remedio->id }}">
                        <td>{{ $remedio->nome }}</td>
                        <td>{{ $remedio->quantidade }}</td>
                        <td>{{ $remedio->miligrama }}</td>
                        <td>{{ $remedio->validade }}</td>
                        <td>R$ {{ number_format($remedio->preco, 2, ',', '.') }}</td>
                        <td>
                            <button onclick="toggleEdit({{ $remedio->id }})">Editar</button>
                            <form action="{{ route('funcionario.remover', $remedio->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remover</button>
                            </form>


                            <form class="edit-form" action="{{ route('funcionario.atualizar', $remedio->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nome" value="{{ $remedio->nome }}">
                                <input type="number" name="quantidade" value="{{ $remedio->quantidade }}">
                                <input type="text" name="miligrama" value="{{ $remedio->miligrama }}">
                                <input type="date" name="validade" value="{{ $remedio->validade }}">
                                <input type="number" step="0.01" name="preco" value="{{ $remedio->preco }}">
                                <button type="submit">Salvar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</body>
</html>
