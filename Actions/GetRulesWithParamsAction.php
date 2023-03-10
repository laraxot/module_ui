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
                dd($method->getParameters());
                $start = strpos($method->getDocComment(), 'Validate');
                $end = strpos($method->getDocComment(), '@');

                $comment = '';
                if (is_int($start)) {
                    $comment = substr($method->getDocComment(), $start, $end - $start);
                    $comment = preg_replace('/\s\s+/', ' ', $comment);
                    $comment = str_replace('* ', '', $comment);
                    $comment = trim($comment);
                }

                //dd($comment);
                return [
                    'name' => str_replace('validate_', '', Str::snake($method->name)),
                    'comment' => $comment,
                ];
            })->toArray();
    }
}
