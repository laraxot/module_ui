<?php

/**
 * @see https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/
 */

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Import\Csv;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Cms\Actions\GetViewAction;
use Modules\Xot\Services\CSVService;

/**
 * Class Rules.
 *
 * @property Collection $data
 */
class Rules extends Component {
    use WithFileUploads;

    /**
     * @var \SplFileInfo
     */
    public $myfile;

    public array $form_data = [];

    public array $my_rules;

    public bool $is_first_row_head = false;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(array $rules) {
        $this->my_rules = $rules;
    }

    /**
     * Undocumented function.
     */
    public function getDataProperty(): Collection {
        $path = $this->myfile->getRealPath();

        if (false !== $path) {
            $csv_to_array = collect(CSVService::make()->toArray($path));

            return $csv_to_array;

            /*return XLSService::make()
                ->fromFilePath($path)
                ->getData();*/
        } else {
            return collect([]);
        }
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        // $view = 'ui::livewire.import.csv.model';
        $view = app(GetViewAction::class)->execute();
        $view_params = [];

        return view($view, $view_params);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function import() {
        $model = app($this->modelClass);

        $rows = $this->data;

        /**
         * controllo che non vengano erroneamente importati contatti con tutti campi null.
         */
        $rows = $rows->filter(
            function ($item) {
                // if(!method_exists($item,'toArray')){
                //    throw new Exception('['.__LINE__.']['.__FILE__.']');
                // }
                foreach ($item->toArray() as $key => $value) {
                    if (null !== $value) {
                        return $item;
                    }
                }
            }
        );

        if ($this->is_first_row_head) {
            $rows = $rows->slice(1);
        }

        foreach ($rows as $v) {
            $keys = array_values($this->form_data);
            // Cannot call method values() on mixed.
            $values = $v->values()->all();
            $data = array_combine($keys, $values);
            // dddx([$keys, $data, $values]);
            // Result of && is always true.
            // if (false !== $data && false !== $this->fields) {
            // if (false !== $data && false !== $this->fields) {
            $data = array_merge($data, $this->fields);
            // }
            $data['mobile_phone'] = strval($data['mobile_phone']);
            // dddx($data['mobile_phone']);
            // dddx(['data' => $data, 'v' => $v, 'form_data' => $this->form_data, 'keys' => $keys]);
            $model->create($data);
        }
        session()->flash('message', 'Import successfully ');
    }
}
