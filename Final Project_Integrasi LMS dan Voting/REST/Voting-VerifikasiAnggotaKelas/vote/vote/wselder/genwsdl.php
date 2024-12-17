<?php
require "vendor/autoload.php";
require "Kelas.php";

// Inisialisasi generator WSDL
use PHP2WSDL\PHPClass2WSDL;

$gen = new PHPClass2WSDL("Kelas", "http://localhost/vote/vote/wselder/server.php");

// Generate WSDL dan simpan ke file
$gen->generateWSDL();
file_put_contents("Kelas.wsdl", $gen->dump());

echo "WSDL generation complete!";
?>
