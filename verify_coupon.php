<?php
// Get the coupon code and item name sent from the client
$couponCode = $_POST['couponCode'];
$name = $_POST['name'];

// Define the valid coupons and their corresponding item names and discount percentages
$validCoupons = [
    'BURGER1' => [
        'name' => 'burger',
        'discount' => 10
    ],
    'PANEER20' => [
        'name' => 'Panner Munchurian',
        'discount' => 20
    ],
    'FRIED10' => [
        'name' => 'Fried Rice',
        'discount' => 10
    ]
];

// Check if the coupon code exists in the valid coupons array and the item matches
if (array_key_exists($couponCode, $validCoupons) && $name === $validCoupons[$couponCode]['name']) {
    // Coupon code and item are valid
    $discount = $validCoupons[$couponCode]['discount'];
    $response = ['valid' => true, 'discount' => $discount];
} else {
    // Coupon code or item is invalid
    $response = ['valid' => false, 'discount' => 0];
}

// Return the validity and discount amount as JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
