<?php namespace Foundation\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class FoundationPresenter extends BootstrapThreePresenter {

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
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="current"><a href="">'.$text.'</a></li>';
    }
}