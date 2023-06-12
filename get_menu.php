<?php
include 'admin/db_connect.php';

if (isset($_POST['canteenId'])) {
    $canteenId = $_POST['canteenId'];

    // Modify the SQL query to filter products based on the selected canteen
    $qry = $conn->prepare("SELECT * FROM product_list WHERE canteen_id = ?");
    $qry->bind_param("i", $canteenId);
    $qry->execute();
    $result = $qry->get_result();

    while ($row = $result->fetch_assoc()) {
        // Display the product information
        echo '
        <div class="col-lg-3">
            <div class="card menu-item">
                <img src="assets/img/' . $row['img_path'] . '" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $row['name'] . '</h5>
                    <p class="card-text truncate">' . $row['description'] . '</p>
                    <div class="text-center">
                        <button class="btn btn-sm btn-outline-primary view_prod btn-block" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i> View</button>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}
?>
