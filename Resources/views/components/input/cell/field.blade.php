<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    @foreach ($field->fields as $v)
        <li class="list-group-item">
            <strong>{{ $v->getLabel() }}</strong>: 
            <x-input.freeze :field="$v" :row="$row" />
        </li>
    @endforeach
  </ul>
</div>
