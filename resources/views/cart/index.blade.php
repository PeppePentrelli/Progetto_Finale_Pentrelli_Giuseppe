<x-layout>
    <main class="container my-5">
        <h2 class="mb-4 fw-bold text-md-center">{{ __('ui.cartTitle') }}</h2>

        <div class="row">
            @if ($cartItems->count())
                <div class="table-responsive">
                    <table class="table align-middle table-hover w-100">
                        <thead class="d-none  d-md-table-header-group">
                            <tr>
                                <th scope="col">{{ __('ui.cartImage') }}</th>
                                <th scope="col">{{ __('ui.cartTitleColumn') }}</th>
                                <th scope="col">{{ __('ui.cartQuantity') }}</th>
                                <th scope="col">{{ __('ui.cartPrice') }}</th>
                                <th scope="col">{{ __('ui.cartTotal') }}</th>
                                <th scope="col" class="text-center"></th>
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

                                <tr class="d-md-table-row">
                                    {{-- Mobile --}}
                                    <td colspan="6" class="d-md-none p-3 border rounded shadow-sm mb-3 cart-row-mobile text-center">
                                        <a href="{{ route('article.show', $item->article->id) }}">
                                            <img src="{{ $item->article->main_image_url }}"
                                                 class="img-fluid rounded shadow-sm mb-2"
                                                 style="height:80px; width:80px; object-fit:cover"
                                                 alt="{{ $item->article->title }}"
                                                 loading="lazy">
                                        </a>
                                        <a href="{{ route('article.show', $item->article->id) }}"
                                           class="fw-bold heading-text text-decoration-none d-block mb-2">
                                            {{ $item->article->title }}
                                        </a>

                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <form action="{{ route('cart.decrement', $item->id) }}" method="POST" class="me-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                            </form>

                                            <span class="badge bg-primary">{{ $item->quantity }}</span>

                                            <form action="{{ route('cart.increment', $item->id) }}" method="POST" class="ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mb-1">
                                            <small class="">{{ __('ui.cartPrice') }}:</small>
                                            € {{ number_format($price, 2) }}
                                        </div>

                                        <div class="mb-2 fw-semibold heading-text">
                                            <small class="">{{ __('ui.cartTotal') }}:</small>
                                            € {{ number_format($subtotal, 2) }}
                                        </div>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Vuoi rimuovere questo articolo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash me-1"></i> Rimuovi
                                            </button>
                                        </form>
                                    </td>

                                    {{-- PC --}}
                                    <td class="d-none d-md-table-cell text-center">
                                        <a href="{{ route('article.show', $item->article->id) }}">
                                            <img src="{{ $item->article->main_image_url }}"
                                                 class="img-fluid rounded shadow-sm"
                                                 style="height:70px; width:70px; object-fit:cover"
                                                 alt="{{ $item->article->title }}"
                                                 loading="lazy">
                                        </a>
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        <a href="{{ route('article.show', $item->article->id) }}"
                                           class="text-decoration-none  fw-semibold heading-title">
                                            {{ $item->article->title }}
                                        </a>
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('cart.decrement', $item->id) }}" method="POST" class="me-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                            </form>

                                            <span class="badge btn-social-form">{{ $item->quantity }}</span>

                                            <form action="{{ route('cart.increment', $item->id) }}" method="POST" class="ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td class="d-none d-md-table-cell">€ {{ number_format($price, 2) }}</td>
                                    <td class="d-none d-md-table-cell heading-title fw-semibold">€ {{ number_format($subtotal, 2) }}</td>
                                    <td class="d-none d-md-table-cell text-center">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Vuoi rimuovere questo articolo?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Totale finale --}}
                            <tr class=" fw-bold">
                                <td colspan="4" class="text-end">{{ __('ui.cartTotal') }}</td>
                                <td class="heading-title">€ {{ number_format($total, 2) }}</td>
                                <td class="text-center">
                                    <a class="btn btn-success  w-md-auto" href="{{ route('checkout') }}">
                                        Procedi al pagamento
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info mt-4" role="alert">
                    {{ __('ui.cartEmpty') }}
                </div>
            @endif
        </div>
    </main>


</x-layout>
