<x-layout>
<div class="container my-5">
    <h1>Ordine #{{ $order->id }}</h1>

    {{-- Dati cliente --}}
    <h3>Dati Cliente</h3>
    <p><strong>Nome:</strong> {{ $order->name }} {{ $order->surname }}</p>
    <p><strong>Email:</strong> {{ $order->user?->email ?? 'Non disponibile' }}</p>
    <p><strong>Telefono:</strong> {{ $order->phone ?? '-' }}</p>

    {{-- Indirizzo di spedizione --}}
    <h3>Indirizzo di Spedizione</h3>
    <p>{{ $order->address }}, {{ $order->city }}, {{ $order->province }}, {{ $order->postal_code }}</p>

    {{-- Note --}}
    @if($order->notes)
    <h3>Note ordine</h3>
    <p>{{ $order->notes }}</p>
    @endif

    {{-- Metodo di spedizione --}}
    <h3>Metodo di Spedizione</h3>
    <p>{{ ucfirst($order->shipping_method) }}</p>

    {{-- Dati fatturazione (se presenti) --}}
    @if($order->billing_company || $order->billing_vat || $order->billing_email || $order->billing_address)
    <h3>Dati Fatturazione</h3>
    <p><strong>Ragione Sociale:</strong> {{ $order->billing_company ?? '-' }}</p>
    <p><strong>Partita IVA / CF:</strong> {{ $order->billing_vat ?? '-' }}</p>
    <p><strong>Email Fatturazione:</strong> {{ $order->billing_email ?? '-' }}</p>
    <p><strong>Indirizzo Fatturazione:</strong> {{ $order->billing_address ?? '-' }}</p>
    @endif

    {{-- Prodotti --}}
    <h3>Prodotti</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Articolo</th>
                <th>Quantità</th>
                <th>Prezzo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->article?->title ?? 'Articolo non disponibile' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>€ {{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totale ordine --}}
    <h3>Totale:</h3>
    <p>€ {{ number_format($order->total, 2) }}</p>
</div>
</x-layout>
