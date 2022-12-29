<?php

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FieldData extends Data {
    public string $name;
    public ?string $label=null;
    public ?string $name_dot=null;
    public string $type;
    public array $rules=[];
    public mixed $value;
    
    public ?string $method=null;

    /**
     * @phpstan-var view-string|null
     */
    public ?string $view=null;

    /** 
     * @var DataCollection<FieldData> 
     */
    public ?DataCollection $fields;


    public array $options=[];
}