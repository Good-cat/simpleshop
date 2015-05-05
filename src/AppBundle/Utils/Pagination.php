<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 05.05.15
 * Time: 14:09
 */

namespace AppBundle\Utils;

use Doctrine\ORM\PersistentCollection;

class Pagination {
    private $itemsPerPage;
    private $arrayCollection;

    public function setCollection(PersistentCollection $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    public function getPagesCount()
    {
        $pagesCount = ceil(($this->collection->count()) / $this->itemsPerPage);

        return $pagesCount;
    }

    public function getItems($page)
    {
        $services = $this->collection->slice(($page - 1) * $this->itemsPerPage, $this->itemsPerPage);

        return $services;
    }
} 