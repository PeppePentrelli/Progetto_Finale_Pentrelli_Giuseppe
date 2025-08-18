<x-layout>

    <h1 class="text-center heading-title my-3">{{ __('ui.newsletterSubscribersTitle') }}</h1>

    @php
        function maskEmail($email)
        {
            $parts = explode('@', $email);
            $name = $parts[0];
            $domain = $parts[1] ?? '';

            if (strlen($name) > 1) {
                $name = substr($name, 0, 1) . str_repeat('*', strlen($name) - 1);
            }

            return $name . '@' . $domain;
        }
    @endphp

    <main class="container">
        <div class="row">
            <table class="table mt-3 border shadow">
                <thead>
                    <tr>
                        <th>{{ __('ui.firstName') }}</th>
                        <th>{{ __('ui.lastName') }}</th>
                        <th>{{ __('ui.email') }}</th>
                        <th>{{ __('ui.subscriptionDate') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->nome ?? '-' }}</td>
                            <td>{{ $subscriber->cognome ?? '-' }}</td>
                            <td>{{ maskEmail($subscriber->email) }}</td>
                            <td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">{{ __('ui.noSubscribersFound') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</x-layout>
