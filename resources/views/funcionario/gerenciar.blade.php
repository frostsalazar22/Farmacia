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
