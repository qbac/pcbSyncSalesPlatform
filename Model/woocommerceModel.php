<?php

class woocommerceModel extends baseModel
{
    public $woocommerce;

    public function __construct($woocommerce)
    {
        $this->woocommerce = $woocommerce;   
    }

    public function getProductWooSku($sku)
    {
        $endpoint = 'products/?sku=';
        $resApi = $this->woocommerce->get($endpoint.$sku);

        if (!empty($resApi)){
        $result['id'] = $resApi[0]->id;
        $result['sku'] = $sku;
        $result['stock_quantity'] = $resApi[0]->stock_quantity;
        $result['price'] = $resApi[0]->price;
        $result['regular_price'] = $resApi[0]->regular_price;
        $result['status'] = $resApi[0]->status;
        $result['name'] = $resApi[0]->name;
        $result['link'] = $resApi[0]->permalink;
        return $result;
        } else {return null;}
    }

    public function getProductsWooWithSku()
    {
        $endpoint = 'products';
        $page = 1;
        $products = [];
        $all_products = [];
        //$all_products = $this->woocommerce->get('products?filter[limit]=-1');

        do{
            $products = $this->woocommerce->get($endpoint,array('per_page' => 100, 'page' => $page));
            $all_products = array_merge($all_products,$products);
            $page++;
          } while (count($products) > 0);

        $i = 0;

        if (!empty($all_products)){
        
            foreach($all_products as $rowRestApi){
                if(!empty($rowRestApi->sku)){
                    $result[$i]['id'] = $rowRestApi->id;
                    $result[$i]['sku'] = $rowRestApi->sku;
                    $result[$i]['stock_quantity'] = $rowRestApi->stock_quantity;
                    $result[$i]['price'] = $rowRestApi->price;
                    $result[$i]['regular_price'] = $rowRestApi->regular_price;
                    $result[$i]['status'] = $rowRestApi->status;
                    $result[$i]['name'] = $rowRestApi->name;
                    $result[$i]['link'] = $rowRestApi->permalink;
                    $i++;
                }

            }
        return $result;
        } else {return null;}
    }

    public function setStockWooIdProd($id, $stock)
    {
        $putEnpoint = 'products/';
        $data = [
            'stock_quantity' => $stock,
        ];
        $res = $this-> woocommerce->put($putEnpoint.$id,$data);
        return $res;
    }
}