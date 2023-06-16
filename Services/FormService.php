<?php

declare(strict_types=1);

namespace Modules\UI\Services;

use Collective\Html\FormFacade as Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
// ---- services ---
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Modules\ExtraField\Datas\FieldData;
use Modules\UI\Actions\GetCollectiveComponents;

/**
 * Class FormService.
 */
class FormService
{
    /**
     * ora selectRelationshipOne
     * da select/field_relationship_one.blade.php
     * a  select/relationship/one/field.blade.php.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */

    /*
    When the element is displayed after the call to freeze(), only its value is displayed without the input tags,
    thus the element cannot be edited. If persistant freeze is set,
    then hidden field containing the element value will be output, too.
    */

    /**
     * @param BelongsTo|HasManyThrough|HasOneOrMany|BelongsToMany|MorphOneOrMany|MorphPivot|MorphTo|MorphToMany $rows
     */
    public static function fieldsExcludeRows($rows): array
    {
        $fields_exclude = [];

        $fields_exclude[] = 'id';

        if (method_exists($rows, 'getForeignKeyName')) {
            $fields_exclude[] = $rows->getForeignKeyName();
        }
        if (method_exists($rows, 'getForeignPivotKeyName')) {
            $fields_exclude[] = $rows->getForeignPivotKeyName();
        }
        if (method_exists($rows, 'getRelatedPivotKeyName')) {
            $fields_exclude[] = $rows->getRelatedPivotKeyName();
        }
        if (method_exists($rows, 'getMorphType')) {
            $fields_exclude[] = $rows->getMorphType();
        }
        $fields_exclude[] = 'related_type'; // -- ??

        return $fields_exclude;
    }

    public static function getCollectiveComponents(): array
    {
        $view_path = __DIR__.'/../Resources/views/collective/fields';
        $prefix = 'ui::';

        return app(GetCollectiveComponents::class)->execute($view_path, $prefix);
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Support\HtmlString
     */
    public static function inputHtml(FieldData $field, Model $row)
    {
        $input_type = 'bs'.Str::studly($field->type);
        if (isset($field->sub_type)) {
            $input_type .= Str::studly($field->sub_type);
        }

        $input_name = collect(explode('.', $field->name))->map(
            function ($v, $k) {
                return 0 === $k ? $v : '['.$v.']';
            }
        )->implode('');
        $input_value = $field->value ?? null;

        $col_size = isset($field->col_size) ? $field->col_size : 12;
        $field->col_size = $col_size;

        if (! isset($field->attributes) || ! \is_array($field->attributes)) {
            $field->attributes = [];
        }
        $input_attrs = $field->attributes;
        if (isset($field->fields)) {
            $input_attrs['fields'] = $field->fields;
        }
        $div_exludes = ['Hidden', 'Cell'];
        $input_opts = ['field' => $field];

        if (isset($field->label)) {
            $input_attrs['label'] = $field->label;
        }

        return Form::$input_type($input_name, $input_value, $input_attrs, $input_opts);
    }
}// end class
