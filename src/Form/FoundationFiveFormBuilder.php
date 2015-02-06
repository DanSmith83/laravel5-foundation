<?php

use Illuminate\Html\FormBuilder;

class FoundationFiveFormBuilder extends FormBuilder {

    /**
     * Create a form input field.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function input($type, $name, $value = null, $options = array())
    {
        $options = $this->appendClassToOptions('form-control', $options);

        // Call the parent input method so that Laravel can handle
        // the rest of the input set up.
        return parent::input($type, $name, $value, $options);
    }

    /**
     * Create a select box field.
     *
     * @param  string  $name
     * @param  array   $list
     * @param  string  $selected
     * @param  array   $options
     * @return string
     */
    public function select($name, $list = array(), $selected = null, $options = array())
    {
        $options = $this->appendClassToOptions('form-control', $options);

        // Call the parent select method so that Laravel can handle
        // the rest of the select set up.
        return parent::select($name, $list, $selected, $options);
    }

    /**
     * Append the given class to the given options array.
     *
     * @param  string  $class
     * @param  array   $options
     * @return array
     */
    private function appendClassToOptions($class, array $options = array())
    {
        // If a 'class' is already specified, append the 'form-control'
        // class to it. Otherwise, set the 'class' to 'form-control'.
        $options['class'] = isset($options['class']) ? $options['class'].' ' : '';
        $options['class'] .= $class;

        return $options;
    }

}