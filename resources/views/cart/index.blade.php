<x-layout>

    <div class="container my-5">
        <h2>{{ __('ui.cartTitle') }}</h2>

        @if ($cartItems->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ui.cartImage') }}</th>
                        <th>{{ __('ui.cartTitleColumn') }}</th>
                        <th>{{ __('ui.cartQuantity') }}</th>
                        <th>{{ __('ui.cartPrice') }}</th>
                        <th>{{ __('ui.cartTotal') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php
                            $price = $item->article->price ?? 0;
                            $subtotal = $price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td><img src="{{ $item->article->image }}" style="height:50px"></td>
                            <td>{{ $item->article->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>€ {{ number_format($price, 2) }}</td>
                            <td>€ {{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end fw-bold">{{ __('ui.cartTotal') }}</td>
                        <td>€ {{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="">{{ __('ui.cartEmpty') }}</p>
        @endif
    </div>
</x-layout>
