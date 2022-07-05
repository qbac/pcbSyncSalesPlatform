<?php

require __DIR__ . '/vendor/autoload.php';
include_once('config/config.php');
include_once('Controller/baseController.php');
include_once('Model/baseModel.php');
include_once('Controller/shoperController.php');
include_once('Model/shoperModel.php');

try {
    $connElbi = new PDO("firebird:host=".FB_SERVER.";dbname=".FB_SERVER. ":".FB_DATABASE_ELBITECH.";charset=UTF8", FB_USER_DB, FB_PASS_DB);
    $connElbi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connSalnie = new PDO("firebird:host=".FB_SERVER.";dbname=".FB_SERVER. ":".FB_DATABASE_SALNIE.";charset=UTF8", FB_USER_DB, FB_PASS_DB);
    $connSalnie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
    {
    echo "<p>Connection failed: " . $e->getMessage()."</p>";
    echo 'Error Connect Firebird Database';
    }


try {
    $client = \DreamCommerce\ShopAppstoreLib\Client::factory(\DreamCommerce\ShopAppstoreLib\Client::ADAPTER_BASIC_AUTH,
       array(
           'entrypoint'=> SHOPER_URL,
           'username' => SHOPER_USER,
           'password' => SHOPER_PASS
       )
    );

    $salnieSync = new shoperController($connSalnie, $client);
    $salnieSync->index();

} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}