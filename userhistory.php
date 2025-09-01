
<?php
session_start();
if(isset($_SESSION['a']))
{

}
else
{
	header("Location:login/login.php");
}


$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$email=$_SESSION['a'];




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>VOYAGE - Travel and Tourism</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	
	   <style>
    .navbar-nav .nav-link {
        color: white !important; /* Change text color to white for nav links */
    }
    .navbar-nav .nav-link:hover {
        color: #f0f0f0; /* Optional: Change color on hover */
    }
    .navbar-brand {
        color: white !important; /* Change brand text color to white */
    }
    .destination-img {
        width: 100%; /* or a specific size, like 600px */
        height: 400px; /* Adjust height as needed */
        background-size: cover;
    }

    </style>
	
  </head>
  <body>
  
  			 <div align="center" style="background-color:#343a40; color: white;">
				<?php if(isset($_SESSION['msg'])) { 
					echo $_SESSION['msg']; 
					unset($_SESSION['msg']); 
				}?>
			</div>



   <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">VOYAGE</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="places.php" class="nav-link">Places</a></li>
	          <li class="nav-item active"><a href="hotel.php" class="nav-link">Packages</a></li>
	          <li class="nav-item"><a href="blog.blog" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="review.php" class="nav-link">Review</a></li>
			    <?php 
				if (isset($_SESSION['a'])): 
				$user=$_SESSION['a'];
				?>
                    <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" 					aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $user; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php" style="font-size: 1rem;">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="userhistory.php" style="font-size: 1rem;">
                                <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i> History
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="font-size: 1rem;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="login/login.php" class="nav-link">Login</a></li>
                <?php endif; ?>

	        </ul>
	      </div>
	    </div>
	  </nav>
	  
	    	<br>
					
			
		
    <!-- END nav -->
<section>
    <div class="col-lg-9">
        <div class="row">
           
                <div class="col-md-6 heading-section text-center ftco-animate">
                    <h2 class="mb-3">Booking History</h2>
                </div>
            </div>
	
			</div></div>
			</section>
			
			    <table border="2" width="82%" height="20%" align="center">
				<tr>
				<th>#</th>
				<th>Booking Id</th>
				<th>Package Name</th>	
				<th>From</th>
				<th>To</th>
				<th>Status</th>
				<th>Action</th>
                </tr>
				
				<?php
				$sql = "SELECT * FROM booking WHERE useremail = '$email'";
									
				$result = $conn->query($sql);
				$index = 1;
				if ($result->num_rows > 0) 
				{
		 		 while($row = $result->fetch_assoc()) {
				echo "<tr>
				<td>{$index}</td>
				<td> #BK{$row['booking_ID']}</td>
				<td>{$row['title']}</td>
				<td>{$row['fromdate']}</td>
				<td>{$row['todate']}</td>
				<td>";
          
         	    switch ($row['status']) 
				{
                case 0:
                    echo "Pending";
                    break;
                case 1:
                    echo "Confirmed";
                    break;
                case 2:
                    echo "Canceled by you";
                    break;
                case 3:
                    echo "Canceled by admin";
                    break;
            	}
				echo "</td>
				<td><a href='cancel.php?id={$row['booking_ID']}'>Cancel</a></td>
				</tr>";
							$index++;
				}
					} else {
						echo "<tr><td colspan='7'>No bookings found</td></tr>";
					}
                ?>
              </table>
			
			
			<br><br>
			<br><br><br><br><br>

  		  <!-- Logout Modal -->
			<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<a class="btn btn-primary" href="/voyage/login/logout.php">Logout</a>
						</div>
					</div>
				</div>
			</div>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>