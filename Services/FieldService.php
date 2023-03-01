<?php

declare(strict_types=1);

namespace Modules\UI\Services;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class FieldService.
 */
class FieldService extends BaseFieldService
{
    public string $name;

    protected string $label;

    protected string $key;

    protected bool $file_multiple;

    protected array $array_fields = [];

    protected bool $array_sortable = false;

    protected string $input_component = 'ui::components.label_input.default';

    protected int $col_size = 12;

    public array $rules = [];

    /**
     * FieldService constructor.
     */
    public function __construct()
    {
        // $this->label = $label;
        // $this->name = $name ?? Str::snake(Str::lower($label));
        // $this->key = 'form_data.'.$this->name;
    }

    /* Unsafe usage of new static(). Consider making the class or the constructor final
    */

    public static function make(): self
    {
        // return new static($label, $name);
        return new self();
    }

    /**
     * Undocumented function.
     */
    public function setVars(array $vars): self
    {
        foreach ($vars as $k => $v) {
            $func = 'set'.str::Studly($k);
            $this->{$func}($k);
        }

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setColSize(int $col_size): self
    {
        $this->col_size = $col_size;

        return $this;
    }

    public function setType(string $type): self
    {
        // @XOT
        $this->type = Str::snake($type);

        return $this;
    }

    public function type(string $type): self
    {
        // @XOT
        $this->type = Str::snake($type);

        return $this;
    }

    public function setPrefix(string $prefix): self
    {
        $this->key = $prefix.'.'.$this->name;

        return $this;
    }

    public function setInputComponent(string $input_component): self
    {
        $this->input_component = 'ui::components.label_input.'.$input_component;

        return $this;
    }

    public function toArray(): array
    {
        return ['name' => $this->name, 'type' => $this->type];
    }

    /**
     * phpstan-param view-string $view.
     */
    public function getView(): string
    {
        $type = Str::snake($this->type);
        $start = 'ui::livewire.fields.';
        $views = [];
        $pieces = explode('_', $type);
        $pieces_count = \count($pieces);
        for ($i = $pieces_count; $i > 0; --$i) {
            $a = \array_slice($pieces, 0, $i);
            $b = \array_slice($pieces, $i);
            $views[] = $start.implode('_', $a).'.'.implode('_', array_merge(['field'], $b));
        }
        $view = collect($views)->first(
            function ($view_check) {
                return \View::exists($view_check);
            }
        );
        if (false == $view) {
            $ddd_msg =
                [
                    'err' => 'Not Exists ..',
                    'line' => __LINE__,
                    'file' => __FILE__,
                    'pub_theme' => config('xra.pub_theme'),
                    'adm_theme' => config('xra.adm_theme'),
                    // 'view0_dir' => self::viewNamespaceToDir($views[0]),
                    'views' => $views,
                ];
            dddx($ddd_msg);
        }

        if (null === $view) {
            throw new \Exception('view is null');
        }

        return $view;
    }

    public function toHtml(): Renderable
    {
        $view = (string) $this->getView();
        $view_params = [
            'view' => $view,
            'field' => $this,
            // 'form_data' => $form_data,
            // 'row' => $row,
        ];

        return view($view, $view_params);
    }

    public function html(array $form_data = [], ?Model $row = null): Renderable
    {
        /**
         * @XOT //$form_data non dovrebbe servire
         *
         * @phpstan-var view-string

        $view = 'ui::livewire.fields.'.$this->type.'.field';
         */
        $type = Str::snake($this->type);
        $start = 'ui::livewire.fields.';
        $views = [];
        $pieces = explode('_', $type);
        $pieces_count = \count($pieces);
        for ($i = $pieces_count; $i > 0; --$i) {
            $a = \array_slice($pieces, 0, $i);
            $b = \array_slice($pieces, $i);
            $views[] = $start.implode('_', $a).'.'.implode('_', array_merge(['field'], $b));
        }
        $view = collect($views)->first(
            function ($view_check) {
                return \View::exists($view_check);
            }
        );
        if (null === $view) {
            $ddd_msg =
                [
                    'err' => 'Not Exists ..',
                    'line' => __LINE__,
                    'file' => __FILE__,
                    'pub_theme' => config('xra.pub_theme'),
                    'adm_theme' => config('xra.adm_theme'),
                    // 'view0_dir' => self::viewNamespaceToDir($views[0]),
                    'views' => $views,
                ];
            dddx($ddd_msg);
        }

        $view_params = [
            'view' => $view,
            'field' => $this,
            'form_data' => $form_data,
            'row' => $row,
        ];

        if (null === $view) {
            throw new \Exception('view is null');
        }

        return view($view, $view_params);
    }

    public function file(): self
    {
        $this->type = 'file';

        return $this;
    }

    public function multiple(): self
    {
        $this->file_multiple = true;

        return $this;
    }

    public function array(array $fields = []): self
    {
        $this->type = 'array';
        $this->array_fields = $fields;

        return $this;
    }

    public function sortable(): self
    {
        $this->array_sortable = true;

        return $this;
    }
}
