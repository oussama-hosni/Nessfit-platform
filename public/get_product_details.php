<?php
include '../includes/db_connection.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Modify this query to fetch product details based on productId
    $query = "SELECT * FROM produit WHERE id = :productId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":productId", $productId);
    $stmt->execute();
    $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    
    // Return product details as JSON
    echo json_encode($productDetails);
} else {
    echo json_encode(array("error" => "Product ID not provided"));
}
?>
