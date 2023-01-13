<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <h1>{{ $title }}</h1>
    <div>
        {{ $loop_index }}/{{ $loop_max }}
    </div>
    <x-progress.bar value="{{ $perc }}" />
    <br />
    <div class="btn-group" role="group" aria-label="Basic example">

        @if ($autostart === 'true')
            @push('scripts')
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        @this.start();
                    });
                </script>
            @endpush
        @else
            <a class="btn btn-primary" href="{{ $url }}" role="button">
                <i class="fas fa-backward"></i>
            </a>
            <button wire:click="start()" class="btn btn-success">Start</button>
        @endif

        @if ($perc == 100 && $onComplete != '')
            @if ($autostart === 'true')
                <script>
                    @this.{{ $onComplete }}();
                </script>
            @else
                <button wire:click="{{ $onComplete }}()" class="btn btn-success btn-lg">{{ $onComplete }}</button>
            @endif
        @endif
    </div>

    @foreach ($errors as $error)
        {!! $error !!}
    @endforeach
    <div>{!! $message !!}</div>

    @push('scripts')
        <script>
            Livewire.on('updateProgress', perc => {
                @this.start();
            });
        </script>
    @endpush
</div>
