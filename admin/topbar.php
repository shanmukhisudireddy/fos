<style>
	.logo {
    margin-left: 55px;
}
</style>

<nav class="navbar navbar-dark bg-dark fixed-top " style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
          <img src="https://www.facultyplus.com/wp-content/uploads/2018/11/Amrita-Logo.png" width="40px" >
  			</div>
  		</div>
      <div class="col-md-4 float-left text-white">
      <large><b>Amrita Vishwa Vidyapeetham</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white">
	  		<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>