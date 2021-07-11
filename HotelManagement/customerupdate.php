<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$selectsql ="SELECT* FROM customer WHERE customerID ='$id' ";
    $tresult=mysqli_query($conn,$selectsql);
    while($trow=mysqli_fetch_array($tresult) ){									
        $customerID = $trow['customerID'];
        $customerName = $trow['customerName'];
        $idCard = $trow['idCard'];
        $gender = $trow['gender'];
        $address = $trow['address'];
        $phoneNumber = $trow['phoneNumber']; 
        $nationality = $trow['nationality'];
        $email = $trow['email'];
        $note = $trow['note'];	
    }		
?>
    <div class="" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Update Customer Information</h4>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input name="newcn" class="form-control" value="<?php echo $customerName ?>"
                                placeholder="Enter Customer Name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Card</label>
                            <input name="newidc" class="form-control" value="<?php echo $idCard ?>"
                                placeholder="Enter ID Card">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="newgd" class="form-control">
                                <option value="<?php echo $gender ?>"> <?php echo $gender ?></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Address</label>
                            <input name="newad" class="form-control" value="<?php echo $address ?>"
                                placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="newpn" class="form-control" value="<?php echo $phoneNumber ?>"
                                placeholder="Enter Phone Number">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nationality</label>
                            <input name="newna" class="form-control" value="<?php echo $nationality ?>"
                                placeholder="Enter Nationality">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="newem" class="form-control" value="<?php echo $email ?>"
                                placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Note</label>
                            <input name="newnote" class="form-control" value="<?php echo $note ?>"
                                placeholder="Enter Note">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="close" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="update" value="Update" class="btn btn-primary">
                    </div>

            </div>
        </div>
    </div>
    <?php
            
                    if(isset($_POST['close'])){
                        header("Location: customer.php");
                    }
					if(isset($_POST['update']))
					{
                           
						$newcname = $_POST['newcn'];                            
						$newcidcard = $_POST['newidc'];
                        $newcgender = $_POST['newgd'];
                        $newcaddress = $_POST['newad'];
                        $newcphonenumber = $_POST['newpn'];
                        $newcnationality = $_POST['newna'];
                        $newcemail = $_POST['newem'];
						$newcnote = $_POST['newnote'];

						$newsql ="UPDATE customer SET customerName = '$newcname', idCard = '$newcidcard', gender= '$newcgender', address = '$newcaddress', phoneNumber = '$newcphonenumber', nationality= '$newcnationality', email= '$newcemail', note= '$newcnote' WHERE customerID='$customerID'";
						
                            
                        if(mysqli_query($conn,$newsql))
						{
						    echo' <script language="javascript" type="text/javascript"> alert("Update thành công") </script>';
                        }
                        header("Location: customer.php"); 
                        
					}
		    	?>
</body>

</html>