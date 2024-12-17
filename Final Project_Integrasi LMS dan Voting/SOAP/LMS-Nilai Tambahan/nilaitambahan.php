<?php
// Define the class to handle the SOAP service
class NilaiTambahan {
    private $history = [];  // To store history of additional scores

    // The method as per the WSDL specification for getNilaiTambahan
    public function getNilaiTambahan($voteMenang) {
        // Initial score
        $initialScore = 60;

        // Check if the vote is won and calculate the final score
        if ($voteMenang) {
            $finalScore = $initialScore + 20;
            $this->history[] = ["voteMenang" => true, "finalScore" => $finalScore];
            return ["statusNilaiTambahan" => "Vote Anda menang! Nilai akhir Anda adalah: " . $finalScore];
        } else {
            // If vote is not won, return the initial score
            $this->history[] = ["voteMenang" => false, "finalScore" => $initialScore];
            return ["statusNilaiTambahan" => "Vote Anda Kalah. Nilai Anda tetap: " . $initialScore];
        }
    }

    // Method to get the history of scores
    public function getHistory() {
        return $this->history;
    }
}

// Start the SOAP server
try {
    // Specify the correct WSDL file
    $wsdl = 'http://localhost/cobalms/nilaitambahan.wsdl'; // Adjust the WSDL file path if necessary
    
    // Create a new SOAP server instance
    $server = new SoapServer($wsdl); 
    
    // Ensure the NilaiTambahan class is loaded before calling setClass()
    $server->setClass('NilaiTambahan');
    
    // Handle the SOAP request
    $server->handle();
} catch (SoapFault $e) {
    // Error handling if the SOAP request fails
    error_log("Error: " . $e->getMessage());
    echo json_encode(["error" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
