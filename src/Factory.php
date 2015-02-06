<?php

namespace Foundation;

use Foundation\Pagination\FoundationFivePresenter;
use Foundation\Pagination\SimpleFoundationFivePresenter;

class Factory {

    public function paginate($records)
    {
        return new FoundationFivePresenter($records);
    }

    public function simplePaginate($records)
    {
        return new SimpleFoundationFivePresenter($records);
    }
}