<?php

declare(strict_types=1);

namespace Modules\UI\Services;

/*
* https://github.com/kdion4891/laravel-livewire-forms/blob/master/src/BaseField.php
* https://github.com/bastinald/laravel-livewire-forms/tree/master/src/Components
*/

use Illuminate\Support\Arr;

/**
 * Class BaseFieldService.
 */
class BaseFieldService
{
    protected string $name;

    protected string $type;

    protected string $input_type;

    protected int $textarea_rows = 5;

    protected array $options;

    /**
     * Undocumented variable.
     *
     * @var mixed
     */
    protected $default;

    /**
     * @var mixed
     */
    protected $autocomplete;

    protected string $placeholder = '';

    protected string $help = '';

    protected array $rules = [];

    /**
     * @phpstan-var view-string
     */
    protected string $view;

    /**
     * @param mixed $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function input($type = 'text')
    {
        $this->type = 'input';
        $this->input_type = $type;

        return $this;
    }

    /**
     * @param int $rows
     *
     * @return $this
     */
    public function textarea($rows = 2)
    {
        $this->type = 'textarea';
        $this->textarea_rows = $rows;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function select($options = [])
    {
        $this->type = 'select';
        $this->options($options);

        return $this;
    }

    /**
     * @return $this
     */
    public function checkbox()
    {
        $this->type = 'checkbox';

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function checkboxes($options = [])
    {
        $this->type = 'checkboxes';
        $this->options($options);

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function radio($options = [])
    {
        $this->type = 'radio';
        $this->options($options);

        return $this;
    }

    /**
     * @param array $options
     */
    protected function options($options): void
    {
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    /**
     * Undocumented function.
     *
     * @param mixed $default
     */
    public function default($default): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @param mixed $autocomplete
     *
     * @return $this
     */
    public function autocomplete($autocomplete)
    {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    /**
     * @param string $placeholder
     *
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @param string $help
     *
     * @return $this
     */
    public function help($help)
    {
        $this->help = $help;

        return $this;
    }

    /**
     * @param array $rules
     *
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @phpstan-param view-string $view
     *
     * @param string $view
     *
     * @return $this
     */
    public function view($view)
    {
        $this->view = $view;

        return $this;
    }
}
