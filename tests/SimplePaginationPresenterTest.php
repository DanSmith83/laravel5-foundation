<?php

use Illuminate\Pagination\LengthAwarePaginator;

class SimplePaginationPresenterTest extends PHPUnit_Framework_TestCase
{

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $this->records   = range(1, 30);
        $options         = ['path' => 'http://website.com', 'pageName' => 'foo'];
        $this->paginator = new LengthAwarePaginator($this->records, 30, 10, 1, $options);
        $this->presenter = new \Foundation\Pagination\SimpleFoundationFivePresenter($this->paginator);
    }

    public function testOutput()
    {
        $this->assertEquals(
            '<ul class="pagination"><li class="arrow unavailable"><a href="#">&laquo;</a></li> <li class="right"><a href="http://website.com/?foo=2" rel="next">&raquo;</a></li></ul>',
            $this->paginator->render($this->presenter)
        );
    }
}

?>