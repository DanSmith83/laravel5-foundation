<?php

namespace Foundation\Form;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;

class FoundationFiveFormBuilder extends FormBuilder {


    /**
     * @param HtmlBuilder $html
     * @param UrlGenerator $url
     * @param string $csrfToken
     * @param Store $session
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url, Store $session)
    {
        parent::__construct($html, $url, $session->getToken());

        $this->errors = new MessageBag;

        if ($errors = $session->has('errors'))
        {
            $this->errors = $session->get('errors');
        }
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