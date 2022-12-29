<div role="group" aria-label="Actions" class="btn-group btn-group-sm">
    @foreach ($panel->getItemTabs() as $tab)
        <x-button type="simple2" :attrs="get_object_vars($tab)"></x-button>
    @endforeach
</div>
<br />
<div role="group" aria-label="Actions" class="btn-group btn-group-sm">
    <x-button.edit :panel="$panel" />
    <x-button.delete :panel="$panel" />
    <x-button.detach :panel="$panel" />
    <x-button.show :panel="$panel" />

</div>
