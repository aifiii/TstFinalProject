<?php

$wsdl = 'http://localhost/cobalms/nilaitambahan.wsdl'; 

$client = new SoapClient($wsdl);

$params = array(
    'voteMenang' => true // atau false, tergantung vote yang ingin Anda kirim
);

// Mengirim request SOAP
try {

    $response = $client->__soapCall('getNilaiTambahan', array($params));

    echo 'Response: ' . print_r($response, true);
} catch (SoapFault $e) {

    echo 'Error: ' . $e->getMessage();
}
?>
