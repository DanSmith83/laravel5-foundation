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
     * @param $name
     * @param $labelText
     * @param $begin
     * @param $end
     * @param null $selected
     * @param array $options
     * @return string
     */
    public function foundationSelectRange($name, $labelText, $begin, $end, $selected = null, $options = array())
    {
        $range = array_combine($range = range($begin, $end), $range);

        return $this->foundationSelect($name, $labelText, $range, $selected, $options);
    }

    public function foundationSelectYear()
    {
        return call_user_func_array(array($this, 'foundationSelectRange'), func_get_args());
    }

    /**
     * @param $name
     * @param $labelText
     * @param null $selected
     * @param array $options
     * @param string $format
     * @return string
     */
    public function foundationSelectMonth($name, $labelText, $selected = null, $options = array(), $format = '%B')
    {
        $months = array();

        foreach (range(1, 12) as $month)
        {
            $months[$month] = strftime($format, mktime(0, 0, 0, $month, 1));
        }

        return $this->foundationSelect($name, $labelText, $months, $selected, $options);
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
        if ($this->errors->has($name))
        {
            return $this->startLabel($labelText, $this->appendErrors($name, $options)).
                   $html.$this->endLabel().
                   $this->smallError($name);
        }

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

    /**
     * @param $name
     * @return string
     */
    private function smallError($name)
    {
        return sprintf('<small class="error">%s</small>', $this->errors->first($name));
    }
}