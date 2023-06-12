<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? 1 : 0;
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $img = $_POST['imgpath'];
    $canteen_id = $_POST['canteen_id'];

    // Perform necessary data validation and sanitization before inserting into the database

    // Insert the menu item into the database
    $insert_query = "INSERT INTO `product_list` (`category_id`, `canteen_id`, `name`, `description`, `price`, `img_path`, `status`)
                    VALUES ('$category_id', '$canteen_id','$name', '$description','$price','$img', '$status');
    if ($conn->query($insert_query) === TRUE) {
        // Menu item added successfully
        echo 1;
    } else {
        // Error in adding menu item
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
