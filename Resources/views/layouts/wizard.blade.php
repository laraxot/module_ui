<div>
    {{-- dddx([
        //'previousStep'=>$this->previousStep(),
        //'nextStep'=>$this->nextStep(),
        //'methods'=>get_class_methods($this)
        'state'=>$this->state(),
        'state_methods'=>get_class_methods($this->state()),
        ]) --}}
    <ul class="nav nav-tabs overflow-x border-0">
        @foreach($steps as $step)
            <li class="nav-item">
                <span href="#" class="nav-link {{ $step->isCurrent() ?'active':''}}">{{ $step->label }}</span>
            </li>
        @endforeach
    </ul>

    @yield('content')

    <div>
         <div wire:click="previousStep" class="btn btn-primary">
            ⬅ Previous
        </div>

        <div wire:click="goNextStep" class="btn btn-primary">
            Go to the next step
        </div>
    </div>
</div>