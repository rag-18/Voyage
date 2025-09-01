<?php
session_start();
if (!isset($_SESSION['a'])) {
    header("Location: login/login.php");
    exit(); // Make sure to exit after redirecting
}
$conn = new mysqli("localhost", "root", "", "voyage");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VOYAGE</title>
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
		/* Center the Share button */
		.add-button-container {
			display: flex;
			justify-content: center; /* Horizontally centers the content */
			align-items: center; /* Vertically centers the content */
			margin-top: 20px; /* Add some space on top */
		}

        .navbar-nav .nav-link {
            color: white !important; /* Change text color to white for nav links */
        }
        .navbar-nav .nav-link:hover {
            color: #f0f0f0; /* Optional: Change color on hover */
        }
        .navbar-brand {
            color: white !important; /* Change brand text color to white */
        }
        .posts-container {
            display: flex;
            flex-wrap: wrap; /* Allows posts to wrap into new rows */
            justify-content: space-between; /* Space out posts */
            margin: 20px; /* Margin around the container */
        }
		.post {
			background: #fff; /* White background for posts */
			border: 1px solid #ccc; /* Light gray border */
			border-radius: 8px; /* Rounded corners */
			width: calc(45% - 20px); /* Reduced width */
			margin: 10px; /* Space between posts */
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
			overflow: hidden; /* Hide overflow for rounded corners */
		}
		.post-image {
			width: 100%; /* Full width image */
			height: auto; /* Maintain aspect ratio */
		}
		.post-content {
			padding: 10px; /* Reduced padding inside post content */
		}
		.post-title {
			font-size: 1.2rem; /* Reduced title font size */
			margin: 0 0 8px; /* Margin below title */
		}
		.post-description {
			font-size: 0.9rem; /* Reduced description font size */
			color: #555; /* Darker gray for description */
		}

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
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="review.php" class="nav-link">Review</a></li>
                    
                    <?php 
                    if (isset($_SESSION['a'])): 
                        $user=$_SESSION['a'];
                    ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo htmlspecialchars($user); ?></span>
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
    <!-- END nav -->
    
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
			
			
			<section class="ftco-section ftco-no-pt ftco-no-pb ftco-services">
			
				<div class="col-md-12 heading-section text-center">
				<h2 class="mb-2">Blogs </h2>
			</div>
			
				<div class="container">
					<div class="row justify-content-center">
						<?php 
						$sql2 = "SELECT * FROM blogpost ORDER BY post_ID DESC";
						$result2 = $conn->query($sql2);
						if ($result2->num_rows > 0) {
							while($row2 = $result2->fetch_assoc()) {
						?>
						<div class="post col-sm-12 col-md-8 col-lg-8 ftco-animate d-flex flex-column align-items-center">
							<img src="/voyage/images/blog/<?php echo htmlspecialchars($row2['images']); ?>" class="post-image mb-3">
							<div class="post-content text-center">
								<h2 class="post-title"><?php echo htmlspecialchars($row2['location']); ?></h2>
								<p class="post-description"><?php echo htmlspecialchars($row2['content']); ?></p>
							</div>
						</div>
						<?php
							}
						}
						?>
					</div>
				</div>
				<div class="add-button-container">
				<a href="share.php" class="btn" style="background-color: #343a40; color: white; width: 70px; border: none;">Share</a>
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
