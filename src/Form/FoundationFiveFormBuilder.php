<?php

namespace Foundation\Form;

use Illuminate\Html\FormBuilder;

class FoundationFiveFormBuilder extends FormBuilder {

    /**
     * Create a text input field.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function foundationText($name, $value = null, $options = array())
    {
        return $this->startLabel($name).
               $this->input('text', $name, $value, $options).
               $this->endLabel();
    }

    /**
     * Create a form label element.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function startLabel($name, $value = null, $options = array())
    {
        $this->labels[] = $name;

        $options = $this->html->attributes($options);

        $value = e($this->formatLabel($name, $value));

        return '<label for="'.$name.'"'.$options.'>'.$value;
    }

    public function endLabel()
    {
        return '</label>';
    }
}