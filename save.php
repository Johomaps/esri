<?php
// Receive the raw POST data
$jsonInput = file_get_contents('php://input');
$decoded = json_decode($jsonInput, true);

if (isset($decoded['filename']) && isset($decoded['data'])) {
    // Clean the filename to prevent security issues
    $filename = basename($decoded['filename']); 
    
    // Format the JSON cleanly
    $jsonString = json_encode($decoded['data'], JSON_PRETTY_PRINT);
    
    // Write the file to the same directory
    if (file_put_contents($filename, $jsonString)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to write file. Check directory permissions."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid data sent."]);
}
?>