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

        return collect($validatorClass->getMethods(ReflectionMethod::IS_PUBLIC))
            ->filter(function ($method) {
                return Str::startsWith($method->name, 'validate');
            })
            ->map(function ($method) {

                //$param_names = collect($method->getParameters())->pluck('name', 'name')->except(['attribute', 'value']);

                $method_name = str_replace('validate_', '', Str::snake($method->name));

                $params = $this->getParamsType($method_name);

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
            })->toArray();
    }

    public function getParamsType(string $method_name): array
    {
        $parameters = [
            'digits_between' => [
                'min' => 'number',
                'max' => 'number'
            ],
        ];

        if (isset($parameters[$method_name])) {
            return $parameters[$method_name];
        }

        return ['json' => 'json'];
    }
}
