<?php

require "vendor/autoload.php";
require "lms.php";

// initialize generator
$gen = new \PHP2WSDL\PHPClass2WSDL("lms", 
"http://localhost/layananlms/server.php");

//generation WSDL and write to .wsdl file
$gen->generateWSDL();
file_put_contents("lms.wsdl", $gen->dump());
echo "Done!";