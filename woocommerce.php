<?php

include_once('config/config.php');
include_once('Controller/baseController.php');
include_once('Model/baseModel.php');
require __DIR__ . '/vendor/autoload.php';

include_once('Controller/woocommerceController.php');
include_once('Model/woocommerceModel.php');

use Automattic\WooCommerce\Client;

try {
    $connElbi = new PDO("firebird:host=".FB_SERVER.";dbname=".FB_SERVER. ":".FB_DATABASE_ELBITECH.";charset=UTF8", FB_USER_DB, FB_PASS_DB);
    $connElbi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connSalnie = new PDO("firebird:host=".FB_SERVER.";dbname=".FB_SERVER. ":".FB_DATABASE_SALNIE.";charset=UTF8", FB_USER_DB, FB_PASS_DB);
    $connSalnie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $woocommerce = new Client(WOO_URL,WOO_CONSUMER_KEY,WOO_CONSUMER_SECRET);
    $salnieSync = new woocommerceController($connSalnie, $woocommerce);
    $salnieSync->index();



    }
catch(PDOException $e)
    {
    echo "<p>Connection failed: " . $e->getMessage()."</p>";
    echo 'Error Connect Firebird Database';
    }