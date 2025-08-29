<x-layout>

<div class="container-fluid py-5 h-100">
    <div class="container" style="max-width:700px;">
        <h2 class="text-center display-5 fw-bold mb-5" style="color: var(--title-color);">{{ __('ui.checkoutTitle') }}</h2>

        {{-- Sezione Form spedizione --}}
        <section class="mb-5 p-4" style="border: 1px solid var(--form-border-container); border-radius:12px;">
            <h4 class="fw-bold mb-4 heading-title">{{ __('ui.shippingInfo') }}</h4>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('ui.name') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('ui.surname') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" name="surname" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.address') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('ui.city') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-buildings"></i></span>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('ui.postalCode') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-mailbox"></i></span>
                            <input type="text" name="postal_code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('ui.province') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo"></i></span>
                            <input type="text" name="province" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.phone') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.notes') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('ui.shippingMethod') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-truck"></i></span>
                        <select name="shipping_method" class="form-select" required>
                            <option value="standard">{{ __('ui.standard') }}</option>
                            <option value="express">{{ __('ui.express') }}</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn w-100 btn-lg fw-bold mt-3" style="color: var(--contrast-color); border:none;">
                    <i class="bi bi-check-circle me-2"></i>{{ __('ui.confirmOrder') }}
                </button>
            </form>
        </section>

        {{-- Sezione Riepilogo Carrello --}}
        <section class="mb-5 p-4" style="border: 1px solid var(--form-border-container); border-radius:12px;">
            <h4 class="fw-bold mb-3 heading-title">{{ __('ui.cartSummary') }}</h4>
            <ul class="list-group list-group-flush mb-3"">
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    @php
                        $price = $item->article->price ?? 0;
                        $subtotal = $price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <li class=" d-flex justify-content-between align-items-center py-3" style=" border:none; color: var(--text-color);">
                        <div class="d-flex align-items-center">
                            <img src="{{ $item->article->main_image_url }}" alt="img"
                                 class="rounded-3 me-3 shadow-sm" style="width:60px;height:60px;object-fit:cover;">
                            <span class="fw-semibold">{{ $item->article->title }} x {{ $item->quantity }}</span>
                        </div>
                        <span class="fw-bold">€ {{ number_format($subtotal,2) }}</span>
                    </li>
                    <hr>
                @endforeach
                <li class="d-flex justify-content-between fw-bold py-3" >
                    <span>{{ __('ui.total') }}</span>
                    <span>€ {{ number_format($total,2) }}</span>
                </li>
            </ul>
        </section>

    </div>
</div>

<style>
input, select, textarea {
    border-radius: 8px;
}
button.btn:hover {
    opacity: 0.9;
}
</style>

</x-layout>
