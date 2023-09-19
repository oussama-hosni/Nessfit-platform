<?php
session_start();

// Check if the session variable 'product_names' exists and is an array
if (isset($_SESSION['product_names']) && is_array($_SESSION['product_names'])) {
    // Encode the array as JSON and send it as the response
    $response = json_encode($_SESSION['product_names']);
    echo $response;
} else {
    echo json_encode([]); // Send an empty JSON array if no data is available
}
?>