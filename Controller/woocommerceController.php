<?php

class woocommerceController extends baseController
{

    public $fbConn;
    public $woocommerce;

    public function __construct($fbConn, $woocommerce)
    {
        $this->fbConn = $fbConn;
        $this->woocommerce = $woocommerce;
    }

    public function index(){

        $wooModel = new woocommerceModel($this->woocommerce);
        //$prodFb = $wooModel->getFbStockProductActive($this->fbConn, FB_SALNIE_ID_MAG);
        // foreach ($prodFb as $rowProdFb) {
        //     $prodWoo = $wooModel->getProductWooSku($rowProdFb['INDEKS']);
        //     if(!empty($prodWoo)){
        //         echo '<pre><code>' . print_r($prodWoo, true) . '</code><pre>';
        //         //$wooModel->setStockWooIdProd($prodWoo['id'], 1);
        //     }
        // }
        //$prodWoo = $wooModel->getProductWooSku('0361');
        //if(!empty($prodWoo)){
        //    echo '<pre><code>' . print_r($prodWoo, true) . '</code><pre>';
        //$wooModel->setStockWooIdProd($prodWoo['id'], 1);
        //}

        $productsWooSku = $wooModel->getProductsWooWithSku();
        $all_products = [];
        foreach ($productsWooSku as $rowProductWooSku){

            $rowProductWooSku['stanDysp'] = $wooModel->getFbStockProductIndeks($this->fbConn, $rowProductWooSku['sku'],FB_SALNIE_ID_MAG)['STANDYSP'];
            $all_products = array_merge($all_products,$rowProductWooSku);
            //print("<pre>".print_r($rowProductWooSku,true)."</pre>");

            if (is_null($rowProductWooSku['stanDysp'])){} else {
                $wooModel->setStockWooIdProd($rowProductWooSku['id'], $rowProductWooSku['stanDysp']);
            }

        }
        //print("<pre>".print_r($all_products,true)."</pre>");
    }
}