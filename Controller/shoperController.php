<?php

class shoperController extends baseController
{

    public $fbConn;
    public $shoper;

    public function __construct($fbConn, $shoper)
    {
        $this->fbConn = $fbConn;
        $this->shoper = $shoper;
    }

    public function index()
    {
        $shoperModel = new shoperModel($this->shoper);
        $productsShoper = $shoperModel->getAllProducts();
        //print("<pre>".print_r($productsShoper,true)."</pre>");
        $all_products = array();
        echo "Indeks;Nazwa;ean;Shoper;Streamsoft<br>";
        foreach ($productsShoper as $rowProductShoper)
        {
            $fbIndeks = $shoperModel->getFbStockProductIndeks($this->fbConn, $rowProductShoper['code'],FB_SALNIE_ID_MAG);
            $rowProductShoper['stanDysp'] = $fbIndeks['STANDYSP'];
            $rowProductShoper['nazwaDl'] = $fbIndeks['NAZWADL'];
            //$all_products = array_merge($all_products,$rowProductShoper);
            //echo $rowProductShoper['code'] .';'. $rowProductShoper['nazwaDl'] .';'. $rowProductShoper['ean'] .';'. $rowProductShoper['stock'] .';'. $rowProductShoper['stanDysp'].'<br>';

        }
    }
}