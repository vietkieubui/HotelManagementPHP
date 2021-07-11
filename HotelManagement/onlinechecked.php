<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$newsql ="UPDATE `prebook` SET `status`='checked' WHERE customerID ='$id' AND status != 'checked'";
	if(mysqli_query($conn,$newsql))
	{}
	header("Location: checkonlinebooking.php");
		
?>