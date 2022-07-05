<?php

class shoperModel extends baseModel
{
    public $shoper;

    public function __construct($shoper)
    {
        $this->shoper = $shoper;   
    }

    public function getAllProducts()
    {
        $resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductStock($this->shoper);
        $resource->page(1);
        $resource->limit(50);

        $result = $resource->get();
        $pages = $result->pages;
        $allResult = array();

        for($i=1;$i<=$pages; $i++){
            $resource->page($i);
            $result = $resource->get();
            $result = (array) $result;
            $allResult = array_merge($allResult,$result);
        }

        return $allResult;
    }
}