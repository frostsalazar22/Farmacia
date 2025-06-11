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

        {{-- Mensagens de alerta --}}
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        <h3>Adicionar Novo Remédio</h3>
        <form action="{{ route('funcionario.adicionar') }}" method="POST">
            @csrf
            <input type="text" name="nome" placeholder="Nome do Remédio" maxlength="100" required pattern="[A-Za-zÀ-ú\s]+">
            <input type="number" name="quantidade" placeholder="Quantidade" min="1" max="10000" required>
            <input type="text" name="miligrama" placeholder="Ex: 500mg, 20g" maxlength="20" required pattern="^\d+(mg|g|ml)$">
            <input type="date" name="validade" required>
            <input type="number" step="0.01" name="preco" placeholder="Preço" min="0.01" max="9999.99" required>
            <button type="submit">Adicionar</button>
        </form>

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
                                <input type="text" name="nome" value="{{ $remedio->nome }}" maxlength="100" required pattern="[A-Za-zÀ-ú\s]+">
                                <input type="number" name="quantidade" value="{{ $remedio->quantidade }}" min="1" max="10000" required>
                                <input type="text" name="miligrama" value="{{ $remedio->miligrama }}" maxlength="20" required pattern="^\d+(mg|g|ml)$">
                                <input type="date" name="validade" value="{{ $remedio->validade }}" required>
                                <input type="number" step="0.01" name="preco" value="{{ $remedio->preco }}" min="0.01" max="9999.99" required>
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
