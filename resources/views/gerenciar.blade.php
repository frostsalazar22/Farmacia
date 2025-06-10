<!DOCTYPE html>
<html>
<head>
    <title>Funcionário - Gerenciar Remédios</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>
        function toggleEdit(id) {
            const row = document.getElementById('row-' + id);
            row.classList.toggle('show-edit');
        }
    </script>
</head>
<body>
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
    </div>
</body>
</html>
