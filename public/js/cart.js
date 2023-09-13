document.addEventListener("DOMContentLoaded", function () {
  var addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

  addToCartButtons.forEach(function (button) {
      button.addEventListener("click", function () {
          var productName = this.getAttribute("data-product-name");

          // Make an AJAX request to fetch product details based on productId
          fetch('get_product_details.php?product_name=' + productName)
              .then(response => response.json())
              .then(data => {
                  // Update the modal content with the product details
                  var modalTitle = document.getElementById("cartModalLabel");
                  var modalBody = document.getElementById("cartItemList");

                  modalTitle.textContent = "Cart Items";
                  var listItem = document.createElement("li");
                  listItem.textContent = data.productName + " - " + data.productBrand + " - " + data.productPrice + "TND - " + data.productPiece;
                  modalBody.innerHTML = "";
                  modalBody.appendChild(listItem);
              })
              .catch(error => {
                  console.error("Error fetching product details: " + error);
              });
      });
  });
});
