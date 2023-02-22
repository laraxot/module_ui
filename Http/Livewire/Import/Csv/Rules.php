<?php

/**
 * @see https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/
 */

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Import\Csv;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
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

    public string $action_class;

    public array $vars;

    // protected array $rules = [
    //     'data.*.0' => 'required',
    //     'data.*.1' => 'email',
    // ];

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(array $rules, string $action_class, array $vars) {
        $this->my_rules = $rules;
        $this->my_rules = ['required', 'numeric'];
        if (! class_exists($action_class)) {
            throw new \Exception('['.__FILE__.']['.__LINE__.']');
        }
        $this->action_class = $action_class;
        $this->vars = $vars;
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
        $view = app(GetViewAction::class)->execute();
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function import() {
        $rows = $this->data;

        if ($this->is_first_row_head) {
            $rows = $rows->slice(1);
        }

        foreach ($rows as $row) {
            Validator::make((array) $row, $this->my_rules)->validate();
        }

        app($this->action_class)->execute($rows, $this->vars);

        session()->flash('message', 'Import successfully ');
    }
}
