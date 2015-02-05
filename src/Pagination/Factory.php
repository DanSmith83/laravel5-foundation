<?php

namespace Foundation\Pagination;

use Foundation\Pagination\FoundationPresenter;

class Factory {

    function paginate($records)
    {
        return new FoundationPresenter($records);
    }
}