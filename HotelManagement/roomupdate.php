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
	$selectsql ="SELECT* FROM room WHERE roomID ='$id' ";
    $tresult=mysqli_query($conn,$selectsql);
    while($trow=mysqli_fetch_array($tresult) ){									
        $roomType = $trow['type'];
        $roomBedding = $trow['bedding'];
        $roomPrice = $trow['price'];
        $roomStatus = $trow['status'];
        $roomNote = $trow['note'];
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

<body onload="loadData()">
    
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
                            <label>Room ID</label>
                            <input class="form-control" value="<?php echo $id ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Type of Room</label>
                            <select id="type" name="type" class="form-control">
                                <option value="Normal Room">Normal Room</option>
                                <option value="VIP Room">VIP Room</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bedding Type</label>
                            <select id="bed" name="bed" class="form-control">
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Price/day</label>
                            <input type="float" name="price" class="form-control" value="<?php echo $roomPrice ?>">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="ready">Ready</option>
                                <option value="booked">Booked</option>
                                <option value="using">Using</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Note</label>
                            <input name="note" class="form-control" value="<?php echo $roomNote ?>"
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
            header("Location: room.php");
        }
        if(isset($_POST['update']))
        {                
            $newType = $_POST['type'];                            
            $newBed = $_POST['bed'];
            $newPrice = $_POST['price'];
            $newStatus = $_POST['status'];
            $newNote = $_POST['note'];

            $newsql ="UPDATE room SET type = '$newType', bedding = '$newBed', price= '$newPrice', status = '$newStatus', note = '$newNote' WHERE roomID='$id'";
            
                
            if(mysqli_query($conn,$newsql))
            {
                echo' <script language="javascript" type="text/javascript"> alert("Update success!") </script>';
            }
            header("Location: room.php"); 
            
        }
    ?>
    <script>
    function loadData() {
        var rType = document.getElementById("type").options;
        for (var i = 0; i < rType.length; i++) {
            if (rType[i].text == "<?php echo $roomType ?>") {
                rType[i].selected = true;
                break;
            }
        }
        var rBed = document.getElementById("bed").options;
        for (var i = 0; i < rBed.length; i++) {
            if (rBed[i].text == "<?php echo $roomBedding ?>") {
                rBed[i].selected = true;
                break;
            }
        }        
        var rStatus = document.getElementById("status").options;
        var status = "<?php echo $roomStatus ?>";
        for (var i = 0; i < rStatus.length; i++) {
            if (rStatus[i].text.toUpperCase() == status.toUpperCase()) {
                rStatus[i].selected = true;
                break;
            }
        }
    }
    </script>
</body>

</html>