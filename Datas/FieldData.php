<?php

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FieldData extends Data {
    public string $name;
    public string $label;
    public string $name_dot;
    public string $type;
    public array $rules;
    public mixed $value;
    
    public ?string $method=null;

    /**
     * @phpstan-var view-string
     */
    public string $view;

    /** 
     * @var DataCollection<FieldData> 
     */
    public DataCollection $fields;
}