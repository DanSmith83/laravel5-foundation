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
        return '<label>'.$this->input('text', $name, $value, $options).'</label>';
    }
}