<?php

declare(strict_types=1);

namespace Modules\UI\Actions;

use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Spatie\QueueableAction\QueueableAction;

class GetRulesWithParamsAction
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(): array {
=======
    public function execute(): array
    {
>>>>>>> 4a8c17c748c115a1ed0de97c2fc7506d68e4b299
        $validatorClass = new \ReflectionClass(ValidatesAttributes::class);

        $r = collect($validatorClass->getMethods(\ReflectionMethod::IS_PUBLIC))
            ->filter(function ($method) {
                return Str::startsWith($method->name, 'validate');
            })
<<<<<<< HEAD
            ->map(function ($method) {
                // $param_names = collect($method->getParameters())->pluck('name', 'name')->except(['attribute', 'value']);
=======
            ->map(
                function ($method) {
                    // $param_names = collect($method->getParameters())->pluck('name', 'name')->except(['attribute', 'value']);

                    $method_name = str_replace('validate_', '', Str::snake($method->name));
>>>>>>> 4a8c17c748c115a1ed0de97c2fc7506d68e4b299

                $method_name = str_replace('validate_', '', Str::snake($method->name));

                $params = $this->getParamsType($method_name);

<<<<<<< HEAD
                if (null != $params) {
                    $start = strpos((string) $method->getDocComment(), 'Validate');
                    $end = strpos((string) $method->getDocComment(), '@');

                    $comment = '';
                    if (is_int($start)) {
                        $comment = substr((string) $method->getDocComment(), $start, $end - $start);
                        $comment = preg_replace('/\s\s+/', ' ', $comment);
                        $comment = str_replace('* ', '', (string) $comment);
                        $comment = trim($comment);
=======
                        $comment = '';
                        if (is_int($start)) {
                            $comment = substr((string) $method->getDocComment(), $start, $end - $start);
                            $comment = preg_replace('/\s\s+/', ' ', $comment);
                            $comment = str_replace('* ', '', (string) $comment);
                            $comment = trim($comment);
                        }

                        return [
                            'name' => $method_name,
                            'comment' => $comment,
                            'params' => $params,
                        ];
>>>>>>> 4a8c17c748c115a1ed0de97c2fc7506d68e4b299
                    }

<<<<<<< HEAD
                    return [
                        'name' => $method_name,
                        'comment' => $comment,
                        'params' => $params,
                    ];
                }
            })->filter(function ($v) {
                return null !== $v;
            })->toArray();

=======
>>>>>>> 4a8c17c748c115a1ed0de97c2fc7506d68e4b299
        // dd($r);

        return $r;
    }

    /**
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
                'max' => 'number',
            ],
            'declined' => [''],
            'different' => ['field' => 'text'],
            'digits' => ['value' => 'number'],
            'digits_between' => [
                'min' => 'number',
                'max' => 'number',
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
        // return ['json' => 'json'];
    }
}
