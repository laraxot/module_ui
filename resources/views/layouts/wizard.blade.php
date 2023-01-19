<div>
<<<<<<< Updated upstream
    {{-- dddx([
        //'previousStep'=>$this->previousStep(),
        //'nextStep'=>$this->nextStep(),
        'get_defined_vars'=>get_defined_vars(),
        'methods'=>get_class_methods($this),
        //'vars'=>get_class_vars($this),
        'state'=>$this->state(),
        'state_methods'=>get_class_methods($this->state()),
        'state_current'=>$this->state()->currentStep(),
        ]) 
    --}}
=======
>>>>>>> Stashed changes
    <ul class="nav nav-tabs overflow-x border-0">
        @foreach ($steps as $step)
            <li class="nav-item">
                <span href="#" class="nav-link {{ $step->isCurrent() ? 'active' : '' }}">{{ $step->label }}</span>
            </li>
        @endforeach
    </ul>

    @yield('content')

<<<<<<< Updated upstream
    {{--
    <div>
        @if(!$is_first)
         <div wire:click="previousStep" class="btn btn-primary">
            ⬅ Previous
        </div>
        @endif
        @if(!$is_last)
        <div wire:click="goNextStep" class="btn btn-primary">
            Go to the next step
        </div>
        @endif
    </div>
    --}}
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
</div>
=======
</div>
>>>>>>> Stashed changes
