<?php

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationPresenterTest extends PHPUnit_Framework_TestCase {

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $this->records   = range(1, 30);
        $options         = ['path' => 'http://website.com', 'pageName' => 'foo'];
        $this->paginator = new LengthAwarePaginator($this->records, 30, 10, 1, $options);
        $this->presenter = new \Foundation\Pagination\FoundationFivePresenter($this->paginator);
    }

    public function testOutput()
    {
        $this->assertEquals(
            '<ul class="pagination" aria-label="Pagination"><li class="arrow unavailable" aria-disabled="true"><a href="#">&laquo;</a></li> <li class="current"><a>1</a></li><li><a href="http://website.com/?foo=2">2</a></li><li><a href="http://website.com/?foo=3">3</a></li> <li><a href="http://website.com/?foo=2" rel="next">&raquo;</a></li></ul>',
            $this->paginator->render($this->presenter)
        );
    }
}