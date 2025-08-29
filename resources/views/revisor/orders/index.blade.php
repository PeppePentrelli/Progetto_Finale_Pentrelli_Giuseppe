<x-layout>
    <div class="container my-5">
        <h1 class="mb-4">Ordini da Revisionare</h1>
        
        <table class="table revisor-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Totale</th>
                    <th>Data</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->total }} €</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('revisor.orders.show', $order) }}" class="btn btn-warning btn-sm">
                                Vedi Dettagli
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>

    <style>

        table.revisor-table,
        table.revisor-table thead,
        table.revisor-table tbody,
        table.revisor-table tr,
        table.revisor-table th,
        table.revisor-table td {
            background-color: transparent !important;
            color: var(--price-color) !important;
            border-color: var(--price-color) !important; 
        }

        table.revisor-table a {
            color: var(--price-color) !important;
        }

        table.revisor-table th {
            font-weight: bold;
        }
    </style>
</x-layout>
