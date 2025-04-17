<main class="col-md-4 p-0 mt-2 bg-surface-secondary">
    <div class="container-fluid">
        <div class="card text-center">
            <div class="card-body p-5">
                <h2 class="card-title">{{ $title }}</h2>
                <h1 class="card-subtitle mb-2 text-muted">{{ $amount }} {{ $currency == 'EUR' ? '€' : $currency }}
                </h1>
                <h3>{{ $period == 'yearly' ? 'Annuale' : $period }}</h3>
                <hr class="m-4" />
                <p class="card-text m-3">{{ $subtitle }}</p>
                {!! $text !!}

                {{ $payment_button }}
            </div>
        </div>
    </div>
</main>
