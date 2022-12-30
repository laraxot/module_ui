<div>
    {{-- <x-input type="select"></x-input.select> --}}
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <label for="name" class="control-label form-label">status</label>
    <select class="form-control" wire:change="changeStatus" wire:model="status">
        <option selected="" value="">Scegli status</option>
        @foreach ($options as $option)
            <option value="{{ $option }}" @if ($option == $this->status) selected @endif>{{ $option }}
            </option>
        @endforeach
    </select>
</div>
