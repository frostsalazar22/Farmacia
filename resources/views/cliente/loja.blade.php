<h1>Loja de Remédios</h1>
<ul>
    @foreach ($remedios as $remedio)
        <li>
            {{ $remedio->nome }} - R$ {{ $remedio->preco }}
            <form action="{{ route('cliente.comprar', $remedio->id) }}" method="POST">
                @csrf
                <input type="number" name="quantidade" min="1" max="{{ $remedio->quantidade }}">
                <button type="submit">Comprar</button>
            </form>
        </li>
    @endforeach
</ul>
