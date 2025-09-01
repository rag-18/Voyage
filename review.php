<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['a'])) {
    header("Location: login/login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tourist ID based on session email
$email = $_SESSION['a'];
$stmt = $conn->prepare("SELECT tourist_ID FROM tourist WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$touristid = null; // Initialize tourist ID variable
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $touristid = $row['tourist_ID'];
} else {
    die("No tourist found for the provided email.");
}
if (isset($_POST['Submit'])) {
    $title = $_POST['title'];
    $review_text = $_POST['review_text'];

    // Ensure the tourist ID is available
    if ($touristid) {
        $stmt = $conn->prepare("INSERT INTO `review`(`tourist_ID`, `title`, `comments`) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Preparation failed: " . $conn->error);
        }
        $stmt->bind_param("iss", $touristid, $title, $review_text); // Use 'i' for integer ID

        // Execute the statement and check for success
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Review Submitted Successfully";
            header("Location: index.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error: Tourist ID not found.";
    }
}



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
			    /* Recent Activities styles */
			.recent-activities {
				margin-top: 20px; /* Adjust as needed */
				padding: 15px;
				background-color: #f8f9fa; /* Light background for contrast */
				border-radius: 10px; /* Rounded corners */
			}
			.recent-activities h4 {
				margin-bottom: 15px; /* Space below heading */
			}
			.list-group-item {
				background-color: transparent; /* Make list items transparent */
			}
		    </style>

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
	          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
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
<section>
    <div class="container">
	            <div class="col-md-6 heading-section text-center ftco-animate">
                <h2 class="mb-2">Review</h2>
            </div>
    
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-body">
                    <form class="user" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="title" name="title" required placeholder="Review Title">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control form-control-user" id="review_text" name="review_text" required placeholder="Write your review here..." rows="5"></textarea>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" name="Submit" value="SUBMIT" class="btn btn-primary btn-user" style="width:90px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
 <div class="container">
    <!-- Recent Activities Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h4>Recent Booking Activities</h4>
            <ul class="list-group">
                <?php
                $activities = $conn->query("SELECT * FROM review ORDER BY review_ID DESC ");
                while ($activity = $activities->fetch_assoc()) {
                    echo "<li class='list-group-item'> {$activity['title']} - {$activity['comments']} </li>";
                }
                ?>
            </ul>
        </div>
    </div>
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
</section>
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
