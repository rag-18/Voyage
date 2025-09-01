<?php
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
if (!isset($_SESSION['a'])) {
    header("Location: login/login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}// Fetch tourist ID from session email
$email = $_SESSION['a'];
$stmt = $conn->prepare("SELECT tourist_ID FROM tourist WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $touristid = $row['tourist_ID'];
} else {
    // Handle case where no tourist is found
    echo "No tourist found.";
    exit;
}

// Handle form submission
if (isset($_POST['Submit'])) {
    $location = $_POST['location'];
    $descrip = $_POST['description'];
    $createdAt = date("Y-m-d H:i:s");

    // Handle file upload
    $filename = null;
    if ($_FILES['file']['name'] != "") {
        $filename = handleFileUpload($_FILES['file']);
        if (!$filename) {
            echo "Invalid file type or size.";
            exit();
        }
    }

    // Insert the blog post
    if (insertBlogPost($conn, $touristid, $location, $descrip, $filename, $createdAt)) {
        $_SESSION['msg'] = "Posted Successfully";
        header("Location: blog.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Function to handle file upload
function handleFileUpload($file)
{
    global $root;

    $allowed_types = ['image/jpeg', 'image/png'];
    $max_size = 5000000;

    if (!in_array($file['type'], $allowed_types) || $file['size'] > $max_size) {
        return false;
    }

    $uploaddir = $root . '/voyage/images/';
    $filename = uniqid() . basename($file['name']);
    $uploadfile = $uploaddir . $filename;

    if ($file['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return $filename;
        }
    }

    return false;
}

// Function to insert blog post into the database
function insertBlogPost($conn, $touristid, $location, $descrip, $filename, $createdAt)
{
    if ($filename) {
        $stmt = $conn->prepare("INSERT INTO `blogpost` (`post_ID`, `tourist_ID`, `location`, `images`, `content`, `createdat`) VALUES (NULL, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $touristid, $location, $filename, $descrip, $createdAt);
    } else {
        $stmt = $conn->prepare("INSERT INTO `blogpost` (`post_ID`, `tourist_ID`, `location`, `content`, `createdat`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("isss", $touristid, $location, $descrip, $createdAt);
    }

    return $stmt->execute();
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
			
		<br>
				<section>
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-8">
								<div class="card-body">
									<form class="user" method="post" action="" enctype="multipart/form-data">
										<div class="form-group">
                            <input type="text" class="form-control form-control-user" id="location" name="location" required  placeholder="Location">
                        </div>
						
								 <div class="form-group">
				<textarea class="form-control form-control-user" id="description" name="description" required placeholder="Description"></textarea>
									</div>

                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="file" name="file">
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



  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/bootstrap-datepicker.js"></script>
  <script src="../js/jquery.timepicker.min.js"></script>
  <script src="../js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../js/google-map.js"></script>
  <script src="../js/main.js"></script>
    
  </body>
</html>