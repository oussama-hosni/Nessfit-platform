<!DOCTYPE html>
<html>
<head>
    <title>nessfit</title>
    <link rel="stylesheet" href="./css/sports.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">

    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <!-- Add more CSS and JavaScript files as needed -->

</head>
<body>
<?php
    include 'header.php';
?>
<section class="zone">
        <div class="text-zone">
        <b class="text">Learn to ride a bicycle.<br> You will not regret it if you live.<br><b>Our cycling area.</b></b>
        </div>
        <img class="image-sport" src="./images/bike.png">
    </section> 
    <section class="product">
        <div class="text-zone">
            <br>
            <b class="text">Bikes</b>
        </div>

        <?php
        include '../includes/db_connection.php';

        $query = "SELECT * FROM produit WHERE categorie='cycling' ORDER BY RAND ()";
        $stmt = $db->prepare($query);
        $stmt->execute();
        echo "<ul class='cards' style='margin-bottom: 70px;'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imageData = $row['img'];
            $productName = $row['nom'];
            $productBrand = $row['marque'];
            $productPrix = $row['prix'];
            $productPiece = $row['piece'];

            echo "<li class='card' >";
            echo "<ul>";
            echo "<li><img  style='width:150px' src='data:image/jpeg;base64," . base64_encode($imageData) . "'></li>";  
            echo "</ul>";
            echo "<div class='container'>";
            echo "<h5 class='card-title'>" . $productName . "</h5>";
            echo "<p class='card-text'>" . $productBrand . "</p>";
            echo "<button class='promo'>" . $productPrix . "ZL </button>";
            echo "<form class='add-to-cart-form' method='POST'>";
            echo "<input type='hidden' name='prodname' id='prodname' value='$productName - $productBrand - $productPrix ZL'>";
            echo "<button type='submit' class='add-to-cart-btn'>Add<img src='./images/cart.png' style='width: 12px; height: 12px;'></button>";
            echo "</form>";
            echo "</div>";    
            echo "</li>";
        }
        echo "</ul>";
        ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            console.log('hey');
            $('form.add-to-cart-form').submit(function (event) {
                event.preventDefault();
                var prodname = $(this).find('input[name="prodname"]').val();
                console.log(prodname);
                $.ajax({
                    url: '../includes/get_product_details.php', // Replace with your server-side script URL
                    method: 'POST', // or 'GET' depending on your server-side code
                    data: { prodname : prodname },
                    dataType: 'json',
                    success: function (response) {
                        if (Array.isArray(response)) {
                        
                        var cartItemList = $('#cartItemList');
                        cartItemList.empty();
                        $.each(response, function (index, item) {
                            cartItemList.append('<li>' + item + ' <button style="margin-left : 15px" class="delete-item">Delete</button></li>'); 
                        });
                        updateItemCount(response);
                        $('#cartModal').modal('show');
                        } else {
                            console.log('Invalid response format.');
                        }
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    
        function updateItemCount(response) {
            var itemCount = response.length; 
            $('#cartItemCount').text(itemCount);
        }
    </script>
<?php
    include 'footer.php';
?>
<?php include 'modal.php'; ?>

<script src="./js/cart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
    </html>