<html>

<head>
    <title>Amrita Vishwa Vidyapeetham/pay</title>
    <link rel="stylesheet" href="pay.css">
    <link rel="icon" href="https://www.facultyplus.com/wp-content/uploads/2018/11/Amrita-Logo.png" type="image/x-icon">

    <style>
        form {
            float: center;
        }
    </style>
</head>

<body>

    <script>
        function getpaydet() {
            var n = document.getElementById("name_id").value;
            var m = document.getElementById("mob").value;
            var e = document.getElementById("email").value;

            var dets = { "user": n, "mobile": m, "email": e }
            console.log(dets)
            var paydetails = localStorage.getItem("paydetails")

            var detail = JSON.parse(paydetails || "[]")
            detail.push(dets)
            localStorage.setItem("paydetails", JSON.stringify(detail))
            localStorage.setItem("currentname", "")
            localStorage.setItem("currentname", n)
            JSON.stringify(localStorage.setItem("number", m))
            JSON.stringify(localStorage.setItem("eml", e))


        }
        function redirect() {
            return true
        }

        function yesnoCheck() {
            if (document.getElementById('ynCheck').checked) {
                document.getElementById('ifyesNo').style.visibility = 'visible';
                document.getElementById('ifNo').style.visibility = 'visible';
            } else {
                document.getElementById('ifyesNo').style.visibility = 'hidden';
                document.getElementById('ifNo').style.visibility = 'hidden';
            }
        }

        function validnumber() {
            var mnum = document.paydet.mob.value;
            if (mnum.length == 10) {
                return true;
            }
            else {
                alert("Enter correct Mobile number");
                return false
            }
        }
        function validroll() {
            var rnum = document.paydet.roll.value;
            var rollRegex = /^cb\.[a-z]{2}\.[a-z]\d[a-z]{3}\d{5}$/i;

            if (rnum.length == 16) {
                if (rollRegex.test(rnum)) {
                    return true;
                }
                alert("Please provide a valid roll number.");
                return false;
            } else {
                alert("Please provide a valid roll number.");
                return false;
            }
        }
        function validemail() {
            var email2 = document.paydet.email1.value;
            var atposition = email2.indexOf("@");
            var dotposition = email2.lastIndexOf(".");
            if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email2.length) {
                alert("please provide valid email");
                return false;
            }
        }


    </script>

    <center>
        <form name="paydet" onsubmit="return validnumber()&&validroll()&&validemail()&&redirect();" method="POST"
            action="insert.php">
            <table class="list">
                <tr id="heading">
                    <td colspan="3">
                        <center>
                            <h1><b>PAYMENT GATEWAY</b></h1>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Fullname: </h3>
                    </td>

                    <td colspan="2"><input type="text" size="30" maxlength="30" name="name" id="name" required></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Mobile number: </h3>
                    </td>
                    <td colspan="2"><input type="number" size="30" minlength="10" maxlength="10" id="mob" name="mob"
                            required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Email:</h3>
                    </td>
                    <td colspan="2"><input type="email" size="30" maxlength="30" id="email" name="email1" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Mode of payment:</h3>
                    </td>
                    <td colspan="2">
                        <input type="radio" name="gender" onclick="javascript:yesnoCheck();" value="Wallet"
                            id="ynCheck"><b>E-Wallet</b><br>
                        <input type="radio" name="gender" onclick="javascript:yesnoCheck();" value="cod"
                            id="nyCheck"><b>Cash On Delivery</b>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Roll.No:</h3>
                    </td>
                    <td colspan="2"><input type="text" placeholder="Enter your Roll Number" size="16" maxlength="16"
                            id="roll" name="roll" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Password:</h3>
                    </td>
                    <td colspan="2"><input type="number" placeholder="Enter your wallet password" size="4" minlength="4"
                            maxlength="4" id="pass" name="pass" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <button type="submit" class="button" id="sub" value="Pay" onclick="getpaydet()">Pay</button>
                        </center>
                    </td>
                    <td colspan="2">
                        <center>
                            <button type="reset" class="button" id="res">Reset</button>
                        </center>
                    </td>

                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <a href="pay_lect.html"
                                style="text-decoration: none; color:orangered; font: size 25px; font-weight:bolder;">Not
                                a
                                Student?? Pay here</a>
                        </center>
                    </td>
                </tr>
            </table>

        </form>
    </center>
</body>


</html>