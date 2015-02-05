<?php namespace Foundation\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

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

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getPageLinkWrapper($url, $page, $rel = null)
    {
        if ($page == '&laquo;')
        {
            return $this->getPreviousPageWrapper($url, $page, $rel);
        }

        return $this->getNextPageWrapper($url, $page, $rel);
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getPreviousPageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<li class="left"><a href="'.$url.'"'.$rel.'>'.$page.'</a></li>';
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getNextPageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<li class="right"><a href="'.$url.'"'.$rel.'>'.$page.'</a></li>';
    }
}