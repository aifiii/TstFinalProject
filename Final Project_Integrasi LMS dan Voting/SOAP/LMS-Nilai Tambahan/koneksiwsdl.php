<?php

require "vendor/autoload.php";
require "nilaitambahan.php";

$gen= new \PHP2WSDL\PHPClass2WSDL("nilaiTambahan", "http://localhost/cobalms/server2.php");

$gen -> generateWSDL();
file_put_contents ("nilaitambahan.wsdl", $gen->dump());
echo "sudah!";