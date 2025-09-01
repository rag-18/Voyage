<?php
session_start();
if (!isset($_SESSION['a'])) {
    header("Location: login/login.php");
    exit(); // Make sure to exit after redirecting
}

$conn = new mysqli("localhost", "root", "", "voyage");

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $bookingId = intval($_GET['id']);
    
    // Update the status of the booking to 'canceled by user'
    $sql = "UPDATE booking SET status = 3 WHERE booking_ID = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $bookingId);
        if ($stmt->execute()) {
            // Redirect back to booking history with a success message
            $_SESSION['message'] = "Booking canceled successfully.";
            header("Location: booking.php");
            exit();
        } else {
            $_SESSION['error'] = "Error canceling booking: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing statement: " . $conn->error;
    }
} else {
    $_SESSION['error'] = "No booking ID provided.";
}

// Redirect back to booking history if something went wrong
header("Location: booking.php");
exit();
?>



header("Location:login.php");

?>