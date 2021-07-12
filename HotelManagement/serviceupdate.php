<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
?>
<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$selectsql ="SELECT* FROM service WHERE serviceID ='$id' ";
    $tresult=mysqli_query($conn,$selectsql);
    while($trow=mysqli_fetch_array($tresult) ){									
        $serviceName = $trow['serviceName'];
        $servicePrice = $trow['price'];
        $serviceNote = $trow['note'];
    }		
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
    
    <div class="" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Update Room Information</h4>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Service ID</label>
                            <input class="form-control" value="<?php echo $id ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Service Name</label>
                            <input name="name" class="form-control" value="<?php echo $serviceName ?>"
                                placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="float" name="price" class="form-control" value="<?php echo $servicePrice ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Note</label>
                            <input name="note" class="form-control" value="<?php echo $serviceNote ?>"
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
            header("Location: service.php");
        }
        if(isset($_POST['update']))
        {                
            $newName = $_POST['name'];                            
            $newPrice = $_POST['price'];
            $newNote = $_POST['note'];

            $newsql ="UPDATE service SET serviceName = '$newName', price = '$newPrice', note= '$newNote' WHERE serviceID='$id'";
            
                
            if(mysqli_query($conn,$newsql))
            {
                echo' <script language="javascript" type="text/javascript"> alert("Update success!") </script>';
            }
            header("Location: service.php"); 
            
        }
    ?>
</body>

</html>