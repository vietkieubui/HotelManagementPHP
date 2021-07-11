<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$newsql ="UPDATE `room` SET `status`='using' WHERE roomID ='$id'";
	if(mysqli_query($conn,$newsql))
	{}
	header("Location: home.php");
		
?>