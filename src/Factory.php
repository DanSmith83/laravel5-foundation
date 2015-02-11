<?php

namespace Foundation;

use Foundation\Pagination\FoundationFivePresenter;
use Foundation\Pagination\SimpleFoundationFivePresenter;

class Factory {

    /**
     * @param $records
     * @return FoundationFivePresenter
     */
    public function paginate($records)
    {
        return new FoundationFivePresenter($records);
    }

    /**
     * @param $records
     * @return SimpleFoundationFivePresenter
     */
    public function simplePaginate($records)
    {
        return new SimpleFoundationFivePresenter($records);
    }
}