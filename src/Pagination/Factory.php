<?php

namespace Foundation\Pagination;

use Foundation\Pagination\FoundationPresenter;
use Foundation\Pagination\SimpleFoundationPresenter;

class Factory {

    public function paginate($records)
    {
        return new FoundationPresenter($records);
    }

    public function simplePaginate($records)
    {
        return new SimpleFoundationPresenter($records);
    }
}