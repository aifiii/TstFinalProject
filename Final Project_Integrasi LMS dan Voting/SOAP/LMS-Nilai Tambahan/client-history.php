<?php
    $wsdl = 'http://localhost/cobalms/nilaitambahan.wsdl';
$client = new SoapClient($wsdl);
    $histories = $client->getHistories();
    header('Content-Type: application/json');
    echo json_encode($histories);
