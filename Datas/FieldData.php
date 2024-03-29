<?php

declare(strict_types=1);

namespace Modules\UI\Datas;

use Livewire\Wireable;
use Modules\Cms\Services\RouteService;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FieldData extends Data implements Wireable {
    use WireableData;

    public string $name;
    public ?string $label = null;
    public ?string $name_dot = null;
    public string $type = 'text';  // default
    public int $col_size = 12;
    public array $except = [];
    /**
     * @var array|string
     */
    public $rules = [];
    public mixed $value;

    public ?string $method = null;

    /**
     * @phpstan-var view-string|null
     */
    public ?string $view = null;

    /**
     * @var DataCollection<FieldData>
     */
    public ?DataCollection $fields;

    // public array $options = [];
    public ?array $options = [];

    public ?array $attributes = [];
    /*
    public function __construct(
        string $name, ?string $label = null, string $type, int $col_size = 12, $rules, $value, ?string $method = null, ?string $view = null,
        ?DataCollection $fields, array $options = [], array $attributes = []) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->col_size = $col_size;
        $this->method = $method;
        $this->view = $view;
        $this->fields = $fields;
        $this->options = $options;
        $this->attributes = $attributes;

        // -------------------------
        $this->name_dot = bracketsToDotted($name);

        dddx($this);
    }
    */

    public function getNameDot(): string {
        $this->name_dot = bracketsToDotted($this->name);

        return $this->name_dot;
    }

    public function getLabel(): string {
        if (null !== $this->label) {
            return $this->label;
        }
        $trans_key = 'pub_theme::txt.'.$this->name.'.label';
        $trans = trans($trans_key);
        if ($trans != $trans_key) {
            if (! is_string($trans)) {
                throw new \Exception('['.__LINE__.']['.__FILE__.']');
            }
            $this->label = $trans;

            return $trans;
        }

        return $this->name;
    }

    public function getInputClass(): string {
        return 'form-control';
    }

    /**
     * @return DataCollection<FieldData>
     */
    public function getFields(?string $act = null): DataCollection {
        if (null == $act) {
            $act = RouteService::getAct();
        }

        if (null == $this->fields) {
            throw new \Exception('['.__LINE__.']['.__FILE__.']');
        }

        return $this->fields->filter(
            function ($item) use ($act) {
                if (! $item instanceof FieldData) {
                    throw new \Exception('['.__LINE__.']['.__FILE__.']');
                }

                return ! in_array($act, $item->except);
            }
        );
    }
}
