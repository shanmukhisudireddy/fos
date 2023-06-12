<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include('header.php');
    include('admin/db_connect.php');
    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Delivery</title>
    <link rel="icon" href="./Images/Restaurants/download.png" type="image/icon type"> <!-- href link to be changed-->
<link rel="stylesheet" href="C:\xampp\htdocs\fos\css\delivery.css">  <!-- href link to be changed-->
<link rel="stylesheet" href="C:\xampp\htdocs\fos\css\slider.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style>
    	header.masthead {
		  background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
		}
    </style>
</head>
<header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end mb-4 page-title">
                	<h3 class="text-white">Track Order</h3>
                    <hr class="divider my-4" />

                </div>
                
            </div>
        </div>
    </header>
<body>
<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./">Amrita Vishwa Vidyapeetham</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=cart_list"><span> <span class="badge badge-danger item_count">0</span> <i class="fa fa-shopping-cart"></i>  </span>Cart</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <?php if(isset($_SESSION['login_user_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "Welcome ". $_SESSION['login_first_name'].' '.$_SESSION['login_last_name'] ?> <i class="fa fa-power-off"></i></a></li>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
                      <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
       

<!--side bar-->
<!--Side bar ends-->
<br><br><br><br><br><br>
<section class="h-100 h-custom container" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
            <div class="card-body p-5">
  
              <p class="lead fw-bold mb-5" style="color: #f37a27;">Order Tracking</p>
  
              <div class="row">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Date</p> <!--date datatype-->
                  <p><?php
                  $dt=date("Y/m/d");
                  echo $dt ?></p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Order No.</p>  <!--varchar datatype primary key-->
                  <p><?php 
                  $o_id = uniqid('AVV');
                  echo $o_id?></p>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Destination</p> <!--varchar datatype-->
                  <p><?php  echo $_SESSION['login_address']?></p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Estimated delivery time</p> <!--int datatype-->
                  <p><?php 
                  $del_time=(rand(10,30));
                  
                  echo number_format($del_time)." mins"?></p>
              </div>
            </div>
              
              <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                <div class="row">
                  <div class="col-md-8 col-lg-9">
                    <p>Bill Amount</p>
                  </div>
                  <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                    <p class="lead fw-bold mb-0" style="color: #f37a27;"><?php echo $_SESSION['bill'] ?></p> <!--float datatype-->
                  </div>
                </div>
              </div>
              <?php

// servername => localhost
// username => root
// password => empty
// database name => staff
$conn = mysqli_connect("localhost", "root", "", "fos_db");
// Check connection
if($conn === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
        
}

// Taking all 5 values from the form data(input)
$order_id = $o_id;
$bill_amnt = $_SESSION['bill'];
$dstn_addr = $_SESSION['login_address'];
$delivery_time = $del_time;
$date = $dt;

// We are going to insert the data into our sampleDB table
$sql = "INSERT INTO delivery VALUES ('$order_id',
    '$bill_amnt','$dstn_addr','$delivery_time','$date')";
// Close connection
mysqli_close($conn);
?>       
  
              <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>
  
              <div class="row">
                <div class="col-lg-12">
  
                  <div class="horizontal-timeline">
                    <ul class="list-inline items d-flex justify-content-between">
                      <li class="list-inline-item items-list">
                        <p id=1 class="py-1 px-2 rounded" style="color: #f37a27;">Order placed</p
                          class="py-1 px-2 rounded" style="color: #f37a27;">
                      </li>
                      <li class="list-inline-item items-list">
                        <p id=2 class="py-1 px-2 rounded" style="color: #f37a27;">Cooking</p
                          class="py-1 px-2 rounded" style="color: #f37a27;">
                      </li>
                      <li class="list-inline-item items-list">
                        <p id=3 class="py-1 px-2 rounded" style="color: #f37a27;">Out for delivery
                        </p>
                      </li>
                      <li class="list-inline-item items-list">
                        <p id=4 class="py-1 px-2 rounded" style="color: #f37a27;">Delivered</p
                          class="py-1 px-2 rounded" style="color: #f37a27;">
                      </li>
                    </ul>
  
                  </div>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<br><br>

<!--Footer Section-->
<footer class="bg-light py-5">
            <div class="container"><div class="small text-center text-muted"> Amrita Vishwa Vidyapeetham</div></div>
        </footer>
        
       <?php include('footer.php') ?>

<!--Home  ends-->

<script>
    var i = 1;                  //  set your counter to 1

function myLoop() {         //  create a loop function
  setTimeout(function() {   //  call a 3s setTimeout when the loop is called
    document.getElementById(i).style.color = '#ffffff'
    document.getElementById(i).style.backgroundColor = '#f37a27'
       //  your code here
    i++;                    //  increment the counter
    if (i < 5) {           //  if the counter < 10, call the loop function
      myLoop();             //  ..  again which will trigger another 
    }                       //  ..  setTimeout()
  }, 6000)
}

myLoop(); 
</script>
</body>
</html>