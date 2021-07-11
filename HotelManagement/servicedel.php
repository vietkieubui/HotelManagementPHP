<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$newsql ="DELETE FROM service WHERE serviceID ='$id' ";
	if(mysqli_query($conn,$newsql))
	{}
	header("Location: service.php");
		
?>