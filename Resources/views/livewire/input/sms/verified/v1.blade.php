<div>



    @if ($step === 1)
        <h2>Validated Sms Addresses</h2>
        <div class="input-group mb-3">
            <select wire:model.lazy="{{ $attrs['wire:model.lazy'] }}" wire:change="updateFormData"
                name="{{ $attrs['name'] }}" class="{{ $attrs['class'] }}" aria-label="Default select example">
                <option selected>Select Mobile Number</option>
                @foreach ($my_validated_sms_addresses as $sms)
                    <option value="{{ $sms->value }}">{{ $sms->value }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button wire:click="add()" class="btn btn-info" type="button">Add</button>
            </div>
        </div>
    @endif

    @if ($step === 2)
        <div id="add_sms_form">
            {{-- <h2>AddMobileNumber</h2> --}}
            <div class="input-group mb-3">
                <input wire:model.lazy="form_data.add_mobile" type="text" class="form-control"
                    placeholder="Example: +39395566771" aria-label="Mobile Number" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button wire:click="verify_sms()" class="btn btn-success" type="button">Verifica</button>
                </div>
            </div>
        </div>
    @endif

    @if ($step === 3)
        <h3>Inserisci il codice che hai ricevuto via sms</h3>
        <div class="input-group mb-3">
            <input wire:model.lazy="form_data.token" type="text" class="form-control" placeholder="Verification Code"
                aria-label="Verification Code" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button wire:click="verify_code()" class="btn btn-success" type="button">Verify</button>
            </div>
        </div>
    @endif

    <x-flash-message />
</div>
