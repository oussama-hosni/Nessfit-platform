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
    $prodnameToDelete = $_POST['prodname'];

    // Check if the 'product_names' array is set in the session
    if (isset($_SESSION['product_names'])) {
        // Find the index of the product to delete
        $indexToDelete = array_search($prodnameToDelete, $_SESSION['product_names']);

        // If the product is found, remove it from the array
        if ($indexToDelete !== false) {
            array_splice($_SESSION['product_names'], $indexToDelete, 1);
        }

        // Send an updated list of products as a JSON response
        $response = json_encode($_SESSION['product_names']);
        echo $response;
    } else {
        // Send an error response if 'product_names' array is not set
        http_response_code(400);
        echo "Error: 'product_names' array not found in the session.";
    }
} else {
    // Send an error response if 'prodname' is not provided
    http_response_code(400);
    echo "Error: 'prodname' parameter not provided.";
}
?>
