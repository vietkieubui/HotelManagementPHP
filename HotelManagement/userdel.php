<?php
    include ('db.php');			
    $id =$_GET['id'];		
    $newsql ="DELETE FROM `login` WHERE id ='$id' ";
    if(mysqli_query($conn,$newsql))
    {}
    header("Location: usersetting.php");		
?>