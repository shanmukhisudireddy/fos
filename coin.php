ALTER TABLE users ADD coin_balance INT DEFAULT 0;

<!-- Display the user's coin balance -->
<p><strong>Coins:</strong>
    <?php echo $_SESSION['coin_balance']; ?>
</p>
<style>
    .coin-balance {
        font-size: 16px;
        color: #333;
        margin-bottom: 10px;
    }
</style>

<script>
    $(document).ready(function () {
        $('#applyCoupon').click(function () {
            var couponCode = $('#couponCode').val();

            // Send the coupon code and user's coin balance to the server for verification
            $.ajax({
                url: 'verify_coupon.php',
                method: 'POST',
                data: { couponCode: couponCode, coinBalance: <?php echo $_SESSION['coin_balance']; ?> },
                dataType: 'json',
                success: function (response) {
                    if (response.valid) {
                        // Apply the discount or perform other actions
                        var billAmount = <?php echo $total; ?>;
                        var discount = response.discount; // Retrieve the discount percentage from the server response
                        var coinsUsed = response.coinsUsed; // Retrieve the number of coins used from the server response

                        // Calculate the discounted amount based on coins used
                        var discountedAmount = billAmount - coinsUsed * <?php echo $coinToDiscountRatio; ?>;

                        $('#discountedAmount').text('Discounted Amount: $' + discountedAmount.toFixed(2));
                    } else {
                        // Coupon code is invalid
                        alert('Invalid coupon code. Please try again.');
                    }
                },
                error: function () {
                    // Error occurred while applying the coupon
                    alert('Error occurred while applying the coupon. Please try again.');
                }
            });
        });
    });
</script>
<?php
// Establish database connection
// Include necessary PHP code for database connection

// Check if user is logged in
if (isset($_SESSION['login_user_id'])) {
    // Calculate the number of coins earned based on the total number of items purchased
    $coinsEarned = floor($totalItemsPurchased / 10);

    // Update the user's coin balance in the database
    $userId = $_SESSION['login_user_id'];
    $updateQuery = "UPDATE users SET coin_balance = coin_balance + ? WHERE user_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $coinsEarned, $userId);
    $stmt->execute();
}

// Calculate the user's coin balance
$coinBalance = isset($_SESSION['coin_balance']) ? $_SESSION['coin_balance'] : 0;
?>

<!-- Display the user's coin balance -->
<p><strong>Coins:</strong>
    <?php echo $coinBalance; ?>
</p>

<script>
    $(document).ready(function () {
        $('#applyCoupon').click(function () {
            var couponCode = $('#couponCode').val();
            var coinBalance = <?php echo $coinBalance; ?>;

            // Send the coupon code and user's coin balance to the server for verification
            $.ajax({
                url: 'verify_coupon.php',
                method: 'POST',
                data: { couponCode: couponCode, coinBalance: coinBalance },
                dataType: 'json',
                success: function (response) {
                    if (response.valid) {
                        // Apply the discount or perform other actions
                        var billAmount = <?php echo $total; ?>;
                        var discount = response.discount; // Retrieve the discount percentage from the server response
                        var coinsUsed = response.coinsUsed; // Retrieve the number of coins used from the server response

                        // Calculate the discounted amount based on coins used
                        var coinToDiscountRatio = <?php echo $coinToDiscountRatio; ?>;
                        var discountedAmount = billAmount - coinsUsed * coinToDiscountRatio;

                        $('#discountedAmount').text('Discounted Amount: $' + discountedAmount.toFixed(2));
                    } else {
                        // Coupon code is invalid
                        alert('Invalid coupon code. Please try again.');
                    }
                },
                error: function () {
                    // Error occurred while applying the coupon
                    alert('Error occurred while applying the coupon. Please try again.');
                }
            });
        });
    });
</script>