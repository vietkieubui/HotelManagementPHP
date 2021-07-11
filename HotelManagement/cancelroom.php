<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$newsql ="UPDATE `room` SET `status`='ready' WHERE roomID ='$id'";
	$delete_room_registration = "DELETE FROM `roomregistration` WHERE roomID='$id'";
	if(mysqli_query($conn,$newsql))
	{
		if(mysqli_query($conn,$delete_room_registration)){

		}
	}
	if(mysqli_query($conn,$delete_room_registration)){

	}
	header("Location: home.php");
		
?>