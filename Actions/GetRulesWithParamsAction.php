<?php



declare(strict_types=1);

namespace Modules\UI\Actions;

use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Str;
use Spatie\QueueableAction\QueueableAction;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class GetRulesWithParamsAction
{
    use QueueableAction;



    public function execute(): array
    {
        $validatorClass = new ReflectionClass(ValidatesAttributes::class);

        $r = collect($validatorClass->getMethods(ReflectionMethod::IS_PUBLIC))
            ->filter(function ($method) {
                return Str::startsWith($method->name, 'validate');
            })
            ->map(function ($method) {

                //$param_names = collect($method->getParameters())->pluck('name', 'name')->except(['attribute', 'value']);

                $method_name = str_replace('validate_', '', Str::snake($method->name));

                $params = $this->getParamsType($method_name);

                if (null != $params) {

                    $start = strpos($method->getDocComment(), 'Validate');
                    $end = strpos($method->getDocComment(), '@');

                    $comment = '';
                    if (is_int($start)) {
                        $comment = substr($method->getDocComment(), $start, $end - $start);
                        $comment = preg_replace('/\s\s+/', ' ', $comment);
                        $comment = str_replace('* ', '', $comment);
                        $comment = trim($comment);
                    }

                    return [
                        'name' => $method_name,
                        'comment' => $comment,
                        'params' => $params
                    ];
                }
            })->filter(function ($v) {
                return $v !== null;
            })->toArray();

        //dd($r);

        return $r;
    }

    /**
     * @param string $method_name
     * @return array|null
     */
    public function getParamsType(string $method_name)
    {
        $parameters = [
            'accepted' => [''],
            'active_url' => [''],
            'after' => ['date' => 'text'],
            'after_or_equal' => ['date' => 'text'],
            'alpha' => ['charset' => 'text'],
            'alpha_dash' => ['charset' => 'text'],
            'alpha_num' => ['charset' => 'text'],
            'before' => ['date' => 'text'],
            'before_or_equal' => ['date' => 'text'],
            'boolean' => [''],
            'date' => [''],
            'date_equals' => ['date' => 'text'],
            'decimal' => [
                'min' => 'number',
                'max' => 'number'
            ],
            'declined' => [''],
            'different' => ['field' => 'text'],
            'digits' => ['value' => 'number'],
            'digits_between' => [
                'min' => 'number',
                'max' => 'number'
            ],
            'email' => [''],
            'filled' => [''],
            'gt' => ['field' => 'text'],
            'gte' => ['field' => 'text'],
            'integer' => [''],
            'ip' => [''],
            'json' => [''],
            'lt' => ['field' => 'text'],
            'lte' => ['field' => 'text'],
            'lowercase' => [''],
            'mac_address' => [''],
            'max' => ['value' => 'number'],
            'max_digits' => ['value' => 'number'],
            'min' => ['value' => 'number'],
            'min_digits' => ['value' => 'number'],
            'multiple_of' => ['value' => 'number'],
            'not_regex' => ['pattern' => 'text'],
            'null' => [''],
            'numeric' => [''],
            'present' => [''],
            'regex' => ['pattern' => 'text'],
            'required' => [''],
            'same' => ['field' => 'text'],
            'size' => ['value' => 'number'],
            'starts_with' => ['values' => 'text'],
            'string' => [''],
            'timezone' => [''],
            'unique' => ['table' => 'text', 'column' => 'text'],
            'uppercase' => [''],
            'url' => [''],
            'uuid' => [''],

        ];

        if (isset($parameters[$method_name])) {
            return $parameters[$method_name];
        }

        return null;
        //return ['json' => 'json'];
    }
}
