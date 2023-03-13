@props([
    'label'=>null,
    'id'=>null,
])
<div class="form-check form-switch">
  <input type="text" value="0" wire:model="form_data.{{ $name }}.{{ $id }}">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="1" wire:model="form_data.{{ $name }}.{{ $id }}">
  <label class="form-check-label" for="flexSwitchCheckDefault">Acconsento</label>
</div>
