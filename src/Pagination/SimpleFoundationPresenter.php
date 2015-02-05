<?php namespace Foundation\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class SimpleFoundationPresenter extends BootstrapThreePresenter {

    /**
     * Create a simple Foundation presenter.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
     * @return void
     */
    public function __construct(PaginatorContract $paginator)
    {
        $this->paginator = $paginator;
    }

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