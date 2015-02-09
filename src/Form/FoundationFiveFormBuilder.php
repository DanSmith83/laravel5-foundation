<?php

namespace Foundation\Form;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Session\Store;
use Illuminate\Support\ViewErrorBag;

class FoundationFiveFormBuilder extends FormBuilder {


    /**
     * @param HtmlBuilder $html
     * @param UrlGenerator $url
     * @param string $csrfToken
     * @param Store $session
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url, $csrfToken, ViewErrorBag $errors)
    {
        parent::__construct($html, $url, $csrfToken);

        $this->errors = $errors;
    }

    /**
     * @param $name
     * @param $labelText
     * @param null $value
     * @param array $options
     * @return string
     */
    public function foundationText($name, $labelText, $value = null, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::text($name, $value, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param null $value
     * @param array $options
     * @return string
     */
    public function foundationTextarea($name, $labelText, $value = null, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::textarea($name, $value, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param array $options
     * @return string
     */
    public function foundationPassword($name, $labelText, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::password($name, $labelText, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param array $list
     * @param null $selected
     * @param array $options
     * @return string
     */
    public function foundationSelect($name, $labelText, $list = array(), $selected = null, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::select($name, $list, $selected, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param null $value
     * @param null $checked
     * @param array $options
     * @return string
     */
    public function foundationRadio($name, $labelText, $value = null, $checked = null, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::radio($name, $value, $checked, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param int $value
     * @param null $checked
     * @param array $options
     * @return string
     */
    public function foundationCheckbox($name, $labelText, $value = 1, $checked = null, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            parent::checkable('checkbox', $name, $value, $checked, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $name
     * @param $labelText
     * @param array $options
     * @return string
     */
    public function foundationFile($name, $labelText, $options = array())
    {
        return $this->wrapWithLabel(
            $name,
            $labelText,
            $options,
            $this->input('file', $name, null, $this->appendErrors($name, $options))
        );
    }

    /**
     * @param $value
     * @param array $options
     * @return string
     */
    private function startLabel($value, $options = array())
    {
        $this->labels[] = $value;

        $options = $this->html->attributes($options);

        return '<label'.$options.'>'.$value;
    }

    /**
     * @return string
     */
    private function endLabel()
    {
        return '</label>';
    }

    /**
     * @param $name
     * @param $labelText
     * @param $options
     * @param $html
     * @return string
     */
    private function wrapWithLabel($name, $labelText, $options, $html)
    {
        return $this->startLabel($labelText, $this->appendErrors($name, $options)).$html.$this->endLabel();
    }

    /**
     * @param $name
     * @param $options
     * @return mixed
     */
    private function appendErrors($name, $options)
    {
        if ($this->errors->has($name))
        {
            $options['class'] = isset($options['class']) ? $options['class'].' error' : 'error';
        }

        return $options;
    }
}