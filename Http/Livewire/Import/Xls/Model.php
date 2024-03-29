<?php

/**
 * @see https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/
 */

declare(strict_types=1);

namespace Modules\UI\Http\Livewire\Import\Xls;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Cms\Actions\GetViewAction;
use Modules\Xot\Services\XLSService;

/**
 * Class Field.
 *
 * @property Collection $data
 */
class Model extends Component
{
    use WithFileUploads;

    /**
     * @var \SplFileInfo
     */
    public $myfile;

    public array $fillable;
    public array $fields = [];
    public array $trans = [];
    public array $form_data = [];
    public string $modelClass;

    public bool $is_first_row_head = false;

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(string $modelClass, ?array $fields, ?array $trans)
    {
        $this->modelClass = $modelClass;
        $this->fillable = app($modelClass)->getFillable();
        $this->fillable = array_combine($this->fillable, $this->fillable);

        if (\is_array($fields)) {
            $this->fields = $fields;
        }
        if (\is_array($trans)) {
            $this->trans = $trans;
            $this->fillable = collect($this->fillable)->merge($this->trans)->all();
        }
    }

    /**
     * Undocumented function.
     */
    public function getDataProperty(): Collection
    {
        $path = $this->myfile->getRealPath();

        if (false !== $path) {
            return XLSService::make()
                ->fromFilePath($path)
                ->getData();
        } else {
            return collect([]);
        }
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();
        $view_params = [];

        return view($view, $view_params);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function import()
    {
        $model = app($this->modelClass);

        $rows = $this->data;

        /**
         * controllo che non vengano erroneamente importati contatti con tutti campi null.
         */
        $rows = $rows->filter(
            function ($item) {
                $items = [];
                if (is_object($item) && method_exists($item, 'toArray')) {
                    $items = $item->toArray();
                }
                foreach ($items as $key => $value) {
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
            if (is_object($v) && method_exists($v, 'values')) {
                $values = $v->values()->all();
            } else {
                throw new \Exception('[][]');
            }
            $data = array_combine($keys, $values);
            $data = array_merge($data, $this->fields);
            $data['mobile_phone'] = strval($data['mobile_phone']);
            $model->create($data);
        }
        session()->flash('message', 'Import successfully ');
    }
}
