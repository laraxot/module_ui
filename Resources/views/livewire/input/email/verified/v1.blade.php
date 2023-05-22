@props([])

<div>

    @if ($step === 1)

        <span>{{ trans('pub_theme::txt.Validated Email Addresses') }}</span>

        <div class="input-group mb-3">
            <select id="verified_email" wire:model.lazy="{{ $attrs['wire:model.lazy'] }}" wire:change="updateFormData"
                name="{{ $attrs['name'] }}" class="{{ $attrs['class'] }}">
                <option selected>Validated Email Address</option>
                @foreach ($validated_email_addresses as $email)
                    <option value="{{ $email->value }}">{{ $email->value }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button wire:click="add()" class="btn btn-info" type="button">+</button>
            </div>
        </div>
    @endif


    @if ($step === 2)
        <div id="add_email_form">

            <div class="input-group mb-3">
                <select id="not_verified_email" wire:model.lazy="{{ $attrs['wire:model.lazy'] }}"
                    name="{{ $attrs['name'] }}" class="{{ $attrs['class'] }}">
                    <option selected>Not Validated Email Addresses</option>
                    @foreach ($not_validated_email_addresses as $email)
                        <option value="{{ $email->value }}">{{ $email->value }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button wire:click="verifyOldEmail()" class="btn btn-success" type="button">Re-Verify
                        Token</button>
                </div>
            </div>

            <div class="input-group mb-3">
                <input wire:model.lazy="form_data.add_email" type="email" class="form-control"
                    placeholder="Email Address" aria-label="Add New Email Address" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button wire:click="verifyEmail()" class="btn btn-warning" type="button">Send Verify
                        Token</button>
                </div>
            </div>
        </div>
    @endif

    @if ($step === 3)
        <h3>Inserisci il codice che hai ricevuto via email</h3>
        <div class="input-group mb-3">
            <input wire:model.lazy="form_data.token" type="text" class="form-control" placeholder="Verification Code"
                aria-label="Verification Code" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button wire:click="verifyCode()" class="btn btn-success" type="button">Verify</button>
            </div>
        </div>
    @endif


    <x-flash-message />

</div>
