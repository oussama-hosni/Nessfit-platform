
$(document).ready(function () {
    updateItemCount();
    $('form.add-to-cart-form').submit(function (event) {
        event.preventDefault();
        var prodname = $(this).find('input[name="prodname"]').val();
        console.log(prodname);
        $.ajax({
            url: '../includes/update_list.php', // Replace with your server-side script URL
            method: 'POST', // or 'GET' depending on your server-side code
            data: { prodname : prodname },
            dataType: 'json',
            success: function (response) {
                if (Array.isArray(response)) {
                    updateItemCount();
                    alert('Product added to the list');
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

function updateItemCount() {
    $.ajax({
        url: '../includes/get_cart_list.php', // Modify the path if necessary
        method: 'GET', // You can use GET to retrieve the data
        dataType: 'json', // Expect JSON response
        success: function (response) {
            console.log('Data retrieved from session:', response);

            // Check if response is an array
            if (Array.isArray(response)) {
                var itemCount = response.length;
                $('#cartItemCount').text(itemCount);

                var cartItemList = $('#cartItemList');
                cartItemList.empty();

                // Create an object to store item counts
                var itemCounts = {};

                // Count the occurrences of each item
                response.forEach(function (item) {
                    if (itemCounts[item]) {
                        itemCounts[item]++;
                    } else {
                        itemCounts[item] = 1;
                    }
                });

                // Append items to the list with their counts
                for (var item in itemCounts) {
                    if (itemCounts.hasOwnProperty(item)) {
                        var listItem = $('<li style="margin-bottom: 10px;">' + item + ' (x' + itemCounts[item] + ') <button style="margin-left: 15px" class="add-to-cart-btn" onclick="deleteProduct(\'' + item + '\')">Delete</button></li>');
                        cartItemList.append(listItem);
                    }
                }
            } else {
                console.log('Invalid response format.');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}


function deleteProduct(prodname) {
    $.ajax({
        url: '../includes/delete_from_list.php', // Path to the delete script
        method: 'POST',
        data: { prodname: prodname },
        dataType: 'json',
        success: function (response) {
            updateItemCount();
            alert('Product deleted successfully');
        },
        error: function (error) {
            // Handle errors
            console.error('Error deleting product:', error);
        }
    });
}







