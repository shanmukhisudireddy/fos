<html>

<head>
    <title>Amrita Vishwa Vidyapeetham/confirm-payment</title>
    <link rel="stylesheet" href="payconfirm.css">
    <link rel="icon" href="https://www.facultyplus.com/wp-content/uploads/2018/11/Amrita-Logo.png" type="image/x-icon">
    <style>
        img {
            float: left;
        }

        form {
            float: center;
        }
    </style>
    <br>
    <style>

    </style>
</head>

<body>
    <center>

        <form action="" method="post">
            <table bordercolor="blue" cellpadding="20" bgcolor="cornsilk" class="list">
                <tr id="heading">
                    <td colspan="2">
                        <center>
                            <p>
                            <h1><b>PAYMENT CONFIRMED</b></h1>
                            </p>
                        </center>
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
                        <p id="status"></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p id="s"></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center><b>
                                <p>
                                    Amount Paid
                                </p>
                            </b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <button onclick="window.print()">Print reciept</button>
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    </center>
    <a href="home.html" target="_self" id="home-btn">
        <h3><img src="https://img.icons8.com/material-two-tone/24/000000/home-page.png" /></h3>
    </a>

    <script>
        var fullname = localStorage.getItem("currentname");
        document.getElementById("fname").innerHTML = fullname;

        var mnumber = localStorage.getItem("number");
        document.getElementById("mn").innerHTML = mnumber;

        var e_mail = localStorage.getItem("eml");
        document.getElementById("eml").innerHTML = e_mail;

        var dt = localStorage.getItem("dat");
        document.getElementById("dat").innerHTML = dt;

        var sl = localStorage.getItem("sl");
        document.getElementById("s").innerHTML = sl;
    </script>
</body>

</html>