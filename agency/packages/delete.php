<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
if(isset($_SESSION['a']))
{

}
else
{
   header("Location:login.php");
}
$conn = new mysqli("localhost","root","", "voyage");
if(isset($_GET['val']))
{
$id=$_GET['val'];
$sql = "SELECT * FROM packages where package_ID=$id";
 $result = $conn->query($sql);
if ($result->num_rows > 0)
     {
  $row = $result->fetch_assoc();
$image= $row['image'];
$deletefile = $root.'/voyage/images/'.$image;
if(unlink($deletefile) )
{
$sql = "DELETE FROM packages WHERE package_ID='$id'";
if ($conn->query($sql) === TRUE)
{
$_SESSION['msg'] = "Product Deleted Successfully";
header("Location:index.php");
}
else
{
$_SESSION['msg'] = "Product Deleted Unsuccessful";

}
}
}
}
?>