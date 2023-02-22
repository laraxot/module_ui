<main class="py-6 bg-surface-secondary">
    <div class="container-fluid max-w-screen-md vstack gap-6">
        <div class="card">
            <div class="card-body py-4">
                <!-- Icon + Dropdown -->
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="flex-1">
                        <!-- Title -->
                        <h6 class="h5 font-semibold mb-1">{{ $title }}</h6>
                        <!-- Text -->
                        <p class="text-sm text-muted">{{ $subtitle }}</p>
                    </div>
                    <div class="flex-1">
                        <div
                            class="d-flex align-items-center mt-5 mb-3 lh-none  text-heading d-block display-5 ls-tight mb-0">
                            <span
                                class="font-semibold text-2xl align-self-start mt-1 mt-sm-1 me-1">{{ $currency }}</span>
                            <span>{{ $amount }}</span>
                            <span class="d-inline-block font-regular text-muted text-lg mt-sm-3 ms-1"> /
                                {{ $period }}</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div
                            class=" ml-3 d-flex align-items-center mt-5 mb-3 lh-none  text-heading d-block display-5 ls-tight mb-0">
                            {{ $payment_button }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
