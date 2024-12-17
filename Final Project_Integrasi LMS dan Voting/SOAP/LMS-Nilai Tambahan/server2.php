<?php

require ('nilaitambahan.php');
$server = new SoapServer ('nilaitambahan.wsdl');
$server -> setClass ('nilaiTambahan');
$server-> handle();