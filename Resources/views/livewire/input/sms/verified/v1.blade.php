<div>

    @if ($is_sent === true)
        <h2>Write the code that you received via sms</h2>
        <div class="input-group mb-3">
            <input wire:model.lazy="form_data.token" type="text" class="form-control" placeholder="Verification Code"
                aria-label="Verification Code" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button wire:click="verify_code()" class="btn btn-success" type="button">Verify</button>
            </div>
        </div>
    @else
        <h2>Add Mobile Number</h2>
        <div class="input-group mb-3">
            <input wire:model.lazy="form_data.add_mobile" type="text" class="form-control"
                placeholder="Example: +39395566771" aria-label="Mobile Number" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button wire:click="verify_sms()" class="btn btn-success" type="button">Verify</button>
            </div>
        </div>
    @endif

    <h2>Validated Sms Addresses</h2>
    <select wire:model.lazy="{{ $attrs['wire:model.lazy'] }}" wire:change="updateFormData" name="{{ $attrs['name'] }}"
        class="{{ $attrs['class'] }}" aria-label="Default select example">
        <option selected>Select Mobile Number</option>
        @foreach ($my_validated_sms_addresses as $sms)
            <option value="{{ $sms->value }}">{{ $sms->value }}</option>
        @endforeach
    </select>

    <x-flash-message />
</div>
