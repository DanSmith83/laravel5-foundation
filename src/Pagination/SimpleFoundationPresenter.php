<?php namespace Foundation\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class SimpleFoundationPresenter extends BootstrapThreePresenter {

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="arrow unavailable"><a href="#">'.$text.'</a></li>';
    }
    

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages())
        {
            return sprintf(
                '<ul class="pagination">%s %s</ul>',
                $this->getPreviousButton(),
                $this->getNextButton()
            );
        }

        return '';
    }
}