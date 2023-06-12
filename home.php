<!-- Masthead -->
<header class="masthead">
    <div class="container h-100">
       <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Welcome to <?php echo $_SESSION['setting_name']; ?></h3>
                <hr class="divider my-4" />
                <!-- Add the dropdown list for selecting the canteen -->
                <label for="canteen">Select Canteen:</label>
                <select name="canteen" id="canteen">
                    <option value="1">Canteen 1</option>
                    <option value="2">Canteen 2</option>
                    <option value="3">Canteen 3</option>
                </select>
                <!-- Add the "Order Now" button -->
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#menu" onclick="load_menu()">Order Now</a>
            </div>
        </div>
    </div>
</header>

<!-- Add a separate div to display the selected items -->
<section class="page-section" id="selected-items">
    <div class="container">
        <h3>Selected Items:</h3>
        <div id="selected-items-field" class="row"></div>
    </div>
</section>

<!-- Add the JavaScript function to load the menu.php file -->
<script>
    function load_menu() {
        var canteenId = $('#canteen').val();

        $.ajax({
            url: 'get_menu.php',
            method: 'POST',
            data: {
                canteenId: canteenId
            },
            success: function(response) {
                $('#selected-items-field').html(response);

                // Scroll to the selected-items section
                $('html, body').animate({
                    scrollTop: $('#selected-items').offset().top
                }, 800);
            }
        });
    }
</script>
<section id="offers">
  <h2>Special Offers</h2>
  
</section>
<div id="slideshow">
  <?php
  // PHP code to generate slideshow data
  $images = [
    ['image' => "Images/burgir.jpg", 'text' => '50% off on first burger', 'additional_text' => 'Use code - BURGER1'],
    ['image' => "Images/panner munchurian.webp", 'text' => '20% off on paneer', 'additional_text' => 'Try it now!     Use Code - PANEER20'],
    ['image' => "Images/friedrice.jpg", 'text' => '10%off on friedricee', 'additional_text' => 'Special deal!!    USE CODE - FRIED10']
  ];
  
  foreach ($images as $image) {
    echo '<div class="slide">';
    echo '<img src="' . $image['image'] . '" alt="' . $image['text'] . '">';
    echo '<div class="caption">' . $image['text'] . '</div>';
    echo '<div class="cap1">' . $image['additional_text'] . '</div>';
    echo '</div>';
  }
  ?>
</div>

<script>
// JavaScript code for slideshow functionality
var slides = document.getElementsByClassName("slide");
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 3000); // Change slide every 3 seconds

function nextSlide() {
  slides[currentSlide].style.display = "none";
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].style.display = "block";
}
</script>




<div id="best-sellers">
    <h2>Best Sellers</h2>
    <div id="best-sellers-list">
        <!-- Best sellers will be dynamically generated here -->
    </div>
</div>
<script>
// JavaScript code to fetch and display best sellers
window.addEventListener('DOMContentLoaded', function() {
    fetchBestSellers();
});

function fetchBestSellers() {
    // Make an AJAX request to get the best sellers data
    // Replace 'get_best_sellers.php' with your server endpoint
    fetch('get_best_sellers.php')
        .then(response => response.json())
        .then(data => {
            displayBestSellers(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function displayBestSellers(data) {
    var bestSellersList = document.getElementById('best-sellers-list');

    // Clear the previous list
    bestSellersList.innerHTML = '';

    // Loop through the data and create HTML for each best seller
    data.forEach(function(item) {
        var bestSellerItem = document.createElement('div');
        bestSellerItem.classList.add('best-seller-item');

        var image = document.createElement('img');
        image.src = item.image;
        image.alt = item.name;

        var name = document.createElement('p');
        name.textContent = item.name;

        var price = document.createElement('p');
        price.textContent = 'Price: $' + item.price;

        bestSellerItem.appendChild(image);
        bestSellerItem.appendChild(name);
        bestSellerItem.appendChild(price);

        bestSellersList.appendChild(bestSellerItem);
    });
}
</script>
<?php
// Sample data for best sellers
$bestSellers = [
    [
        'name' => 'Product 1',
        'image' => 'path/to/image1.jpg',
        'price' => 10.99
    ],
    [
        'name' => 'Product 2',
        'image' => 'path/to/image2.jpg',
        'price' => 19.99
    ],
    [
        'name' => 'Product 3',
        'image' => 'path/to/image3.jpg',
        'price' => 14.99
    ]
];


?>

<!-- Add the product details modal -->
<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="product-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-modal-label">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="product-modal-body">
                <!-- Product details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.view_prod', function() {
        var productId = $(this).data('id');

        $.ajax({
            url: 'view_prod.php',
            method: 'GET',
            data: { id: productId },
            success: function(response) {
                $('#product-modal-body').html(response);
                $('#product-modal').modal('show');
            }
        });
    });
</script>
