<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("front_controller.php");
// $fc = new FrontController([
// 	"controller" => "Inventory",
// 	"action" => "ViewInventory",
// 	"params" => array()
// 	]);

$fc = new FrontController();

$fc->run();

?>