	<?php
	session_start();
	if (isset($_POST['login'])) {
		$txtemail = $_POST['email'];
		$txtpassword = $_POST['password'];
	
		$conn = mysqli_connect("localhost", "root", "", "voyage");
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
		// SQL query without prepared statements (vulnerable to SQL injection)
		$sql = "SELECT * FROM tourist WHERE email='$txtemail'";
		$result = $conn->query($sql);
	
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($txtpassword == $row["password"]) {
				$_SESSION['a'] = $row['email'];
				header("Location: ../index.php");
				exit(); // Ensure that the script stops executing after the redirect
			} else {
				echo "Invalid login.";
			}
		} else {
			echo "No results found.";
		}
	
		$conn->close();
	}
	?>
	
<?php

if (isset($_POST['Signup'])) {
    $name = $_POST['name'];
    $txtemail = $_POST['email'];
    $txtpassword = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "voyage");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $email_check_sql = "SELECT * FROM tourist WHERE email = '$txtemail'";
    $result = $conn->query($email_check_sql);

    if ($result->num_rows > 0) {
        // Email already exists, show an error message
        echo "This email is already registered. Please use a different email.";
    } else {
        // Email is unique, proceed to insert new record
        $sql = "INSERT INTO tourist (name, email, phone, address, password) 
                VALUES ('$name', '$txtemail', '$phone', '$address', '$txtpassword')";

        if ($conn->query($sql) === TRUE) {
           
			  $_SESSION['msg'] =  "Account created successfully! Login in";
            // Redirect to the home page or login page after successful signup 
			header("Location: login.php"); 
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
}
?>

	
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <title>VOYAGE</title>
	  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
	  <link rel="stylesheet" href="./style.css">
	</head>
	<body>
				  	    <div align="center" style=" color: black;">
				<?php if(isset($_SESSION['msg'])) { 
					echo $_SESSION['msg']; 
					unset($_SESSION['msg']); 
				}?>
			</div>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="#" method="POST">
				<h1>Create Account</h1>
				<div class="social-container"></div>
<form action="#" method="POST" id="signupForm">
    
		<!-- Name Field -->
		<input type="text" name="name" placeholder="Name" required pattern="[A-Za-z\s]{3,50}" title="Name should only contain letters and spaces, 3-50 characters" />
		
		<!-- Email Field (valid email format) -->
		<input type="email" name="email" placeholder="Email" required />
		
		<!-- Password Field -->
		<input type="password" name="password" placeholder="Password" required minlength="6" title="Password should be at least 6 characters long" />
		
		<!-- Phone Field (exactly 10 digits) -->
		<input type="text" name="phone" placeholder="Contact number" required pattern="^\d{10}$" title="Phone number should be exactly 10 digits" />
		
		<!-- Address Field -->
		<input type="text" name="address" placeholder="Address" required minlength="5" title="Address should be at least 5 characters long" />
		
		<!-- Submit Button -->
		<button type="submit" name="Signup">Sign Up</button>

			</form>
		</div>
		<div class="form-container sign-in-container">
			<form method="POST" action="">
				<h1>Sign in</h1>
				<div class="social-container"></div>
				<span>Use your account</span>
				<input type="email" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password" required />
				<button type="submit" name="login">Login</button><br>
				<span><a href="../Admin/login/login.php">Admin login</a></span>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome To VOYAGE!</h1>
					<p>To keep connected with us, please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Welcome To VOYAGE!</h1>
					<p>Enter your personal details and start your journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="./script.js"></script>
	</body>
	</html>
