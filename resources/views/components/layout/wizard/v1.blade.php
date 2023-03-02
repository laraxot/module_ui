@props([
    'steps' => [],
    'is_first' => false,
    'is_last' => false,
])
<div>
    {{ dddx($steps) }}
    <ul class="nav nav-tabs overflow-x border-0">
        @foreach ($steps as $step)
            <li class="nav-item">
                <span href="#" class="nav-link {{ $step->isCurrent() ? 'active' : '' }}">{{ $step->label }}</span>
            </li>
        @endforeach
    </ul>

    {{ $slot }}

    <x-flash-message />

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $is_first ? 'disabled' : '' }}">
                <a class="page-link" href="#" aria-label="Previous" wire:click="previousStep">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item {{ $is_last ? 'disabled' : '' }}">
                <a class="page-link" href="#" aria-label="Next" wire:click="goNextStep">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
