<?php
    include ('db.php'); 
	$id =$_GET['eid'];		
	$newsql ="DELETE FROM customer WHERE customerID ='$id' ";
	if(mysqli_query($conn,$newsql))	
	{}
	header("Location: customer.php");
		
?>