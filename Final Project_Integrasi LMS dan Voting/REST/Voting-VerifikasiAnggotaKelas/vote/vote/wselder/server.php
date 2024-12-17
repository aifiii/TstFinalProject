<?php
require "Kelas.php";

$server = new SoapServer("Kelas.wsdl");
$server->setClass("Kelas");
$server->handle();
?>
