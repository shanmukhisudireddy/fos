<!DOCTYPE html>
<html>

<head>
    <title>Amrita Vishwa Vidyapeetham/confirm-payment</title>
    <link rel="stylesheet" href="payconfirm.css">
    <link rel="icon" href="https://www.facultyplus.com/wp-content/uploads/2018/11/Amrita-Logo.png" type="image/x-icon">
</head>

<body>
    <p
        style="background-image: url('https://cdn2.vectorstock.com/i/1000x1000/14/36/indian-cuisine-sketch-pattern-background-vector-23081436.jpg');">
        <center>
            <?php
            $flag = 0;
            date_default_timezone_set('Indian/Maldives');
            // servername => localhost
            // username => root
            // password => empty
            // database name => db_payment
            $conn = mysqli_connect("localhost", "root", "", "data_payment");

            // Check connection
            if ($conn === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            if (isset($_POST['name']) && isset($_POST['mob']) && isset($_POST['email1']) && isset($_POST['gender']) && isset($_POST['roll']) && isset($_POST['pass'])) {
                $name = $_POST['name'];
                $mobile = $_POST['mob'];
                $email = $_POST['email1'];
                $payment_mode = $_POST['gender'];
                $roll = $_POST['roll'];
                $password = $_POST['pass'];
                $timestamp = date('Y-m-d H:i:s');
                session_start();
                if (isset($_SESSION['bill'])) {
                    $amount_paid = $_SESSION['bill'];
                }
                // Assuming the 'student' table has columns roll, password, and amount
                $query = "SELECT amount FROM student WHERE roll = '$roll' AND password = '$password'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $amount_to_be_paid = $row['amount'];
                    $new_amount = $amount_to_be_paid - $amount_paid;
                    if ($payment_mode == 'Wallet' && $amount_to_be_paid >= $amount_paid) {
                        // Performing insert query execution
                        // here our table name is payment
                        $sql = "INSERT INTO payment VALUES ('$name', '$mobile', '$email', '$payment_mode', '$roll', '$timestamp')";
                        $flag = 1;
                        $update_query = "UPDATE student SET amount = $new_amount WHERE roll = '$roll' AND password = '$password'";
                        if (mysqli_query($conn, $sql)) {
                            if (mysqli_query($conn, $update_query)) { // Execute the update query
                                echo "Payment confirmed successfully.";

                            } else {
                                echo "ERROR: Sorry, payment could not be confirmed. " . mysqli_error($conn);
                            }
                        } else {
                            echo "ERROR: Sorry, payment could not be confirmed. " . mysqli_error($conn);
                        }
                    } else if ($payment_mode == 'cod') {
                        // Performing insert query execution
                        $sql = "INSERT INTO payment VALUES ('$name', '$mobile', '$email', '$payment_mode', '$roll', '$timestamp')";
                        $flag = 1;
                        if (mysqli_query($conn, $sql)) {
                            echo "Payment confirmed successfully.";
                        } else {
                            echo "ERROR: Sorry, payment could not be confirmed. " . mysqli_error($conn);
                        }
                    } else {
                        echo "ERROR: Invalid payment mode or insufficient amount.";
                    }
                } else {
                    echo "ERROR: Invalid roll number or password.";
                }
            } else {
                echo "ERROR: Please fill in all the required details.";
            }

            // Close connection
            mysqli_close($conn);
            ?>
        </center>
        <?php if ($flag == 1): ?>
            
            <center>
                <table bordercolor="blue" cellpadding="20" bgcolor="cornsilk" class="list">
                    <tr id="heading">
                        <td colspan="2">
                            <h1><b>PAYMENT CONFIRMED</b></h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Fullname: </h3>
                        </td>
                        <td>
                            <?php echo $name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Mobile number: </h3>
                        </td>
                        <td>
                            <?php echo $mobile; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Email:</h3>
                        </td>
                        <td>
                            <?php echo $email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            <h3>Track Status:</h3>
                        </td>
                        <td>
                        <a href="delivery.php"><button>Track Status</button></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p id="s"></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <b>
                                    <p>
                                        Amount Paid
                                    </p>
                                </b>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button onclick="window.print()">Print receipt</button>
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
        <?php endif; ?>

    </p>
</body>

</html>