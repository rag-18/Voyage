<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
if (!isset($_SESSION['a'])) {
    header("Location: login/login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "voyage");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['a'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT agency_ID,name FROM agency WHERE email = ?");
$stmt->bind_param("i", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $agencyid = $row['agency_ID'];
	$agencyname = $row['name'];
} else {
    // Handle case where no agency is found
    echo "No agency found.";
    exit;
}

if (isset($_POST['Submit'])) {
    $packname = $_POST['packname'];
    $ta = $agencyid;
    $descrip = $_POST['description'];
    $price = $_POST['price'];
    $dura = $_POST['duration'];
    $packagetype = strval($_POST['packagetype']); 
    $stat = $_POST['status'];

    // Handle file upload
    if ($_FILES['file']['name'] != "") {
        $uploaddir = $root . '/voyage/images/';
        $filename = basename($_FILES['file']['name']);
        $uploadfile = $uploaddir . $filename;

        // Check file type and size
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['file']['type'], $allowed_types) || $_FILES['file']['size'] > 5000000) {
            echo "Invalid file type or size.";
            exit();
        }
        
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                // Prepare the SQL statement for insert
                $stmt = $conn->prepare("INSERT INTO `packages`(`package_ID`, `agency_ID`, `title`, `description`, `price`, `image`, `duration`, `pacType`, `status`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issdsdsi",$ta ,$packname, $descrip, $price, $filename, $dura, $packagetype, $stat);
                
                // Execute the statement
                if ($stmt->execute()) {
                    $_SESSION['msg'] = "Package Updated Successfully";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo "File upload failed.";
            }
        } 
    } else {
        // Prepare the SQL statement without an image
        $stmt = $conn->prepare("INSERT INTO `packages`(`package_ID`, `agency_ID`, `title`, `description`, `price`, `duration`, `pacType`, `status`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsds",$ta, $packname, $descrip, $price, $dura, $packagetype, $stat);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['msg'] = "Package Added Successfully";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
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

    <link rel="stylesheet" href="../../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../css/animate.css">
    
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../css/magnific-popup.css">

    <link rel="stylesheet" href="../../css/aos.css">

    <link rel="stylesheet" href="../../css/ionicons.min.css">

    <link rel="stylesheet" href="../../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../css/jquery.timepicker.css">


    
    <link rel="stylesheet" href="../../css/flaticon.css">
    <link rel="stylesheet" href="../../css/icomoon.css">
    <link rel="stylesheet" href="../../css/style.css">
	
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
	.form-group {
    text-align: center; /* Center text within form group */
	}
    </style>
	
  </head>
  <body>

   <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="../ta/index.html">VOYAGE Agency</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="../index.php" class="nav-link">Dashboard</a></li>
	          <li class="nav-item"><a href="../booking.php" class="nav-link">Booking</a></li>
	          <li class="nav-item active"><a href="index.php" class="nav-link">Packages</a></li>
			    <?php 
				if (isset($_SESSION['a'])): 
				$user=$_SESSION['a'];
				?>
                    <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" 					aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $user; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../ta/profile.php" style="font-size: 1rem;">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../ta/login/logout.php" data-toggle="modal" data-target="#logoutModal" style="font-size: 1rem;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                            </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a href="../ta/login/login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
					 <br>
			</ul>
	      </div>
		  </div>
	  </nav>

	  

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
							<a class="btn btn-primary" href="/voyage/admin/login/logout.php">Logout</a>
						</div>
					</div>
				</div>
			</div>
<!-- End Logout Modal -->
		<br>
				<section>
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-8">
								<div class="card-body">
									<form class="user" method="post" action="" enctype="multipart/form-data">
										<div class="form-group">
                            <input type="text" class="form-control form-control-user" id="packname" name="packname" required  placeholder="Package Name">
                        </div>
						
						         <div class="form-group">
								<select name="ta" input type="text" class="form-control ">
								<option value=" ">Select Agency</option>
								<option value="$agencyid"><?php echo $agencyname ?>  </option>
								</select>
									</div>

								 <div class="form-group">
				<textarea class="form-control form-control-user" id="description" name="description" required placeholder="Description"></textarea>
									</div>


                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="price" name="price" required  placeholder="Price">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="duration" name="duration" required placeholder="Duration">
                        </div>

                     <div class="form-group">
									<select class="form-control form-control-user" id="packagetype" name="packagetype"  required>
								<option value="single" >Single</option>
								<option value="couple" >Couple</option>
								<option value="group" >Group</option>
									</select> </div>
								
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="file" name="file">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 mb-3 mb-sm-3">
                                Active: <input type="radio" name="status" value="1">
                                Inactive: <input type="radio" name="status" value="0" >
                            </div>
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


</section>
			<br><br><br><br><br>

  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/jquery.easing.1.3.js"></script>
  <script src="../../js/jquery.waypoints.min.js"></script>
  <script src="../../js/jquery.stellar.min.js"></script>
  <script src="../../js/owl.carousel.min.js"></script>
  <script src="../../js/jquery.magnific-popup.min.js"></script>
  <script src="../../js/aos.js"></script>
  <script src="../../js/jquery.animateNumber.min.js"></script>
  <script src="../../js/bootstrap-datepicker.js"></script>
  <script src="../../js/jquery.timepicker.min.js"></script>
  <script src="../../js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../../js/google-map.js"></script>
  <script src="../../js/main.js"></script>
    
  </body>
</html>