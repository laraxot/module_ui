@props([
    'steps' => [],
])
<div class="col-12">
    <div class="mb-5">
        <ul class="nav nav-tabs overflow-x border-0">
            @php
                $hasPrevious = false;
                $hasNext = false;
            @endphp
            @foreach ($steps as $step)
                @php
                    if ($step->isPrevious()) {
                        $hasPrevious = true;
                    }
                    if ($step->isNext()) {
                        $hasNext = true;
                    }
                @endphp
                <li class="nav-item">
                    <span href="#" class="nav-link {{ $step->isCurrent() ? 'active' : '' }}">
                        {{ $step->label }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    <nav aria-label="wizard navigation">
        <ul class="pagination d-flex justify-content-between py-4">
            @if ($hasPrevious)
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous" wire:click="previousStep()">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&nbsp;</span>
                    </a>
                </li>
            @endif
            @if ($hasNext)
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next"
                        wire:click="{{ method_exists($this, 'goNextStep') ? 'goNextStep' : 'nextStep' }}()">
                        Avanti
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Next">
                        Avanti
                        <span aria-hidden="true">&nbsp;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    {{ $slot }}

    <x-flash-message />
</div>
