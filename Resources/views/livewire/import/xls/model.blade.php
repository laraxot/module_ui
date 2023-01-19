<div class="card bg-light mt-3">
    <div class="card-header">
        Import Excel to Database
    </div>
    <div class="card-body">

        <input type="file" name="file" class="form-control" wire:model="myfile">
        @error('myfile')
            <span class="error">{{ $message }}</span>
        @enderror
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_first_row_head" wire:model="is_first_row_head">
            <label class="custom-control-label" for="is_first_row_head">first row is header ?</label>
        </div>

        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        @if ($myfile)
            <table class="table table-bordered">
                @php
                    //dddx($this->data);
                @endphp
                @foreach ($this->data->take(6) as $rows)
                    @if ($loop->first)
                        <tr>
                            @foreach ($rows as $k => $v)
                                <th>{{ $k }}
                                    <select class="form-input" wire:model="form_data.{{ $k }}">
                                        <option value=""> --- </option>
                                        @foreach ($fillable as $kf=>$vf)
                                            <option value="{{ $kf }}">{{ $vf }}</option>
                                        @endforeach
                                    </select>

                                </th>
                            @endforeach
                        </tr>
                    @endif
                    <tr>
                        @foreach ($rows as $k => $v)
                            <td>{{ $v }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
            <button class="btn btn-success" wire:click="import">Import</button>
        @endif

    </div>
</div>
