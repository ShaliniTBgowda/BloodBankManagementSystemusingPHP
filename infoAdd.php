<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['hid']))
{
	header('location:login.php');
}
else {
	if(isset($_POST['add'])){
		$hid=$_SESSION['hid'];
		$bg=$_POST['bg'];
		$bavailable=$_POST['bavailable'];
		$check_data = mysqli_query($conn, "SELECT hid FROM bloodinfo where hid='$hid' && bg='$bg' && bavailable='$bavailable'  ");
		if(mysqli_num_rows($check_data) > 0){
			$error= 'You have already added this blood sample.';
			header( "location:../bloodinfo.php?error=".$error );
}else{
		$sql = "INSERT INTO bloodinfo (bg, hid, bavailable) VALUES ('$bg', '$hid', '$bavailable')";
		if ($conn->query($sql) === TRUE) {
			$msg = "You have added record successfully.";
			header( "location:../bloodinfo.php?msg=".$msg );
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
            header( "location:../bloodinfo.php?error=".$error );
		}
		$conn->close();
	}
}
}
?>