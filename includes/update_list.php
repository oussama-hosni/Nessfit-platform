<?php
// Start a session if it's not already started
session_start();

// Check if the user is authenticated (adapt your authentication logic)
if (!isset($_SESSION['name'])) {
    echo "Error: Unauthorized access.";
    exit;
}

// Check if 'prodname' is provided via POST
if (isset($_POST['prodname'])) {
    // Get the 'prodname' value from the POST request
    $prodname = $_POST['prodname'];

    // Initialize an array to store product names in the session (if not already initialized)
    if (!isset($_SESSION['product_names'])) {
        $_SESSION['product_names'] = array();
    }

    // Add the 'prodname' value to the array
    $_SESSION['product_names'][] = $prodname;

    // Send an updated list of products as a JSON response
    $response = json_encode($_SESSION['product_names']);
    echo $response;
} else {
    // Send an error response if 'prodname' is not provided
    http_response_code(400);
    echo "Error: 'prodname' parameter not provided.";
}
?>
