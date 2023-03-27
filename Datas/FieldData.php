<?php

declare(strict_types=1);

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FieldData extends Data {
    public string $name;
    public ?string $label = null;
    public ?string $name_dot = null;
    public string $type;
    public int $col_size = 12;
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
            $this->label = $trans;

            return $trans;
        }

        return $this->name;
    }

    public function getInputClass(): string {
        return 'form-control';
    }
}
