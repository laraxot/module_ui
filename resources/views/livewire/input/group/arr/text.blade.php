<div>
    <h3>{{ $name }}
    </h3>
    <div>
        @foreach ($form_data as $list)
            <div>
                <input type="text" wire:model="group">
                <button type="button" class="btn btn-primary" wire:click="addGroup()"> + </button>
            </div>
            <div>
                @foreach ($list as $group => $emails)
                    {{ $group }}
                    <div>
                        <input type="text" wire:model="email">
                        <button type="button" class="btn btn-primary" wire:click="addMail()"> + </button>
                        @foreach ($emails as $g => $email)
                            - {{ $email }}
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div>
        <button type="button" class="btn btn-primary" wire:click="getData">get data</button>
    </div>


    {{-- <h3>{{ $name }}
        <button type="button" class="btn btn-primary" wire:click="addArr()"> + </button>
    </h3>
    @foreach ($form_data[$name] ?? [] as $k => $v)
        <input type="text" name="{{ $name }}[{{ $k }}]" value="{{ $v }}">
        <button type="button" class="btn btn-danger" wire:click="subArr({{ $k }})"> - </button>
    @endforeach --}}

</div>
