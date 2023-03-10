<div>

    @if ($step === 1)

        <h2>Validated Email Addresses</h2>

        <div class="input-group mb-3">
            <select id="add_email_form" wire:model.lazy="{{ $attrs['wire:model.lazy'] }}" wire:change="updateFormData"
                name="{{ $attrs['name'] }}" class="{{ $attrs['class'] }}" aria-label="Default select example">
                <option selected>Select Email Address</option>
                @foreach ($my_validated_email_addresses as $email)
                    <option value="{{ $email->value }}">{{ $email->value }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button wire:click="add()" class="btn btn-info" type="button">Add</button>
            </div>
        </div>
    @endif


    @if ($step === 2)
        <div id="add_email_form">
            <h2>Add Email Address</h2>

            <div class="input-group mb-3">
                <input wire:model.lazy="form_data.add_email" type="email" class="form-control"
                    placeholder="Email Address" aria-label="Email Address" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button wire:click="verify_email()" class="btn btn-success" type="button">Verify</button>
                </div>
            </div>
        </div>
    @endif

    @if ($step === 3)
        <h2>Write the code that you received via email</h2>
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
