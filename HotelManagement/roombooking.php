<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- New Style -->
    <link href="assets/css/new-style.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper" style="height: auto; content: auto">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="room.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>

                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="home.php"><i class="fas fa-tachometer-alt"></i> Status</a>
                    </li>
                    <li>
                        <a class="active-menu" href="roombooking.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>
                    <li>
                        <a href="customer.php"><i class="fas fa-users"></i> Customer</a>
                    </li>
                    <li>
                        <a href="checkonlinebooking.php"><i class="fas fa-check"></i> Online Booking</a>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fas fa-chart-line"></i> Profit</a>
                    </li>
                    <li>
                        <a href="billdetail.php"><i class="fas fa-money-bill"></i> Bill details</a>
                    </li>

                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Room Booking
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ADD NEW BOOKING ROOM
                            </div>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Customer ID<span class="notnull"> *</span></label>
                                        <input type="text" name="newcusid" class="form-control" id="customerID"
                                            placeholder="Enter Customer ID">
                                    </div>
                                    <div class="form-group">
                                        <label>Check In<span class="notnull"> *</span></label>
                                        <input type="date" id="checkin" onchange="dayCountandCheck()" name="newcheckin"
                                            value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"
                                            class="form-control" placeholder="Enter Date">
                                    </div>
                                    <div class="form-group">
                                        <label>Check Out<span class="notnull"> *</span></label>
                                        <input type="date" id="checkout" onchange="dayCountandCheck()"
                                            name="newcheckout" value="<?php echo date('Y-m-d'); ?>"
                                            min="<?php echo date('Y-m-d'); ?>" class="form-control"
                                            placeholder="Enter Date">
                                    </div>
                                    <div class="form-group">
                                        <label>Total Day(s)<span class="notnull"> *</span></label>
                                        <input type="number" id="newdays" name="newdays" value="1" class="form-control"
                                            placeholder="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount of people<span class="notnull"> *</span></label>
                                        <input type="number" name="newpeople" class="form-control"
                                            placeholder="Enter Amount of people" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label>Room ID<span class="notnull"> *</span></label>
                                        <input type="text" id="room" name="newroom" class="form-control"
                                            placeholder="Enter Room ID">
                                    </div>
                                    <div class="form-group">
                                        <label>Prepay</label>
                                        <input type="number" name="newprepay" class="form-control"
                                            placeholder="Enter Prepay" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text" name="newnote" class="form-control" placeholder="Enter Note">
                                    </div>

                                    <input type="submit" name="book" value="BOOK" class="btn btn-primary"
                                        style="margin-left: 40%;">
                                </form>
                                <?php
							    include('db.php');
                                if(isset($_POST['book']))
							    {
                                    $newcustomerID = $_POST['newcusid'];
                                    $newcheckin = $_POST['newcheckin'];
                                    $newcheckout = $_POST['newcheckout'];
                                    $newdays = $_POST['newdays'];
                                    $newpeople = $_POST['newpeople'];
                                    $newroom = $_POST['newroom'];
                                    $newprepay = $_POST['newprepay'];
                                    $newnote = $_POST['newnote'];
                                    $arr_room = explode(",",$newroom);
                                    if(empty($newcustomerID)||empty($newroom)){
                                        echo "<script type='text/javascript'> alert('You must fill information!')</script>";
                                    }else{
                                        $checkcusid = "SELECT * FROM customer WHERE customerID = '$newcustomerID'";
                                        // check customer id
                                        $resultcus = mysqli_query($conn, $checkcusid);
                                        $rowcountcus = mysqli_num_rows($resultcus);
                                        if($rowcountcus >0){    
                                            //check room ID
                                            $count_room = 0;  
                                            for($i = 0; $i < count($arr_room); $i++){
                                                $newroomid = $arr_room[$i];
                                                $check_roomid= "SELECT * FROM room WHERE roomid = '$newroomid' AND status='ready'";
                                                $check_roomid_result = mysqli_query($conn, $check_roomid);
                                                $row_count_room_id = mysqli_num_rows($check_roomid_result);
                                                if($row_count_room_id==0){
                                                    $count_room+=1;
                                                }
                                            }
                                            if($count_room==0){
                                                // insert in to registration form
                                                $insert_into_registration_form = "INSERT INTO `registrationform`(`customerID`, `checkIn`, `checkOut`, `days`, `amountOfPeople`, `prepay`, `note`) VALUES ('$newcustomerID','$newcheckin','$newcheckout','$newdays','$newpeople','$newprepay','$newnote')";
                                                //  $insert_to_registration_form -> OK
                                                if(mysqli_query($conn,$insert_into_registration_form)){
                                                    // insert into registrationform success
                                                    // get registerID
                                                    $get_registerID = "SELECT `registerID` FROM `registrationform` WHERE customerID ='$newcustomerID' ";
                                                    
                                                    $get_registerID_result = mysqli_query($conn, $get_registerID); 
                                                    while($row = mysqli_fetch_array($get_registerID_result)){
                                                        $newregisterID = $row['registerID'];
                                                    }
                                                    // get registerID success
                                                    // insert into roomregistration for loop
                                                    for($i = 0; $i < count($arr_room); $i++){
                                                        $newroomid = $arr_room[$i];
                                                        $insert_into_room_registration = "INSERT INTO `roomregistration`(`registerID`, `roomID`) VALUES ('$newregisterID','$newroomid')";
                                                        if(mysqli_query($conn,$insert_into_room_registration)){                                                                                                           
                                                        // update room status
                                                            $update_roomstatus = "UPDATE `room` SET `status`='booked' WHERE roomID ='$newroomid'";
                                                            if(mysqli_query($conn,$update_roomstatus)){
                                                                echo "<script>alert('Book room:".$newroomid." success!') </script>" ;
                                                            }else{
                                                                echo '<script>alert("Update room status failed") </script>' ;
                                                            }
                                                        }
                                                    }
                                                }
                                                $insert_into_bill = "INSERT INTO `bill`(`registerID`) VALUES ('$newregisterID')";
                                                if(mysqli_query($conn,$insert_into_bill)){                                                        
                                                
                                                }else{
                                                    echo '<script>alert("Insert into bill failed") </script>' ;
                                                }
                                            }else{
                                                echo "<script type='text/javascript'> alert('This room is booked or not ready!')</script>";
                                            }                           
                                            

                                        }else{
                                            echo "<script type='text/javascript'> alert('Customer is not exist!')</script>";
                                        }                                        
                                    }
                                    
                                }
							?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    CUSTOMERS INFORMATION<a href="customer.php">
                                        <button class="btn btn-success" type="button">
                                            New Customer
                                        </button>
                                    </a>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>ADD</th>
                                                        <th>ID</th>
                                                        <th>Customer Name</th>
                                                        <th>ID Card</th>
                                                        <th>Phone Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php                             
                                            $tsql = "SELECT `customerID`, `customerName`, `idCard`, `phoneNumber` FROM `customer`";
                                            $tresult = mysqli_query($conn,$tsql);
                                            while($trow=mysqli_fetch_array($tresult) )
                                            {
                                                $customerID = $trow['customerID'];
                                                $customerName = $trow['customerName'];
                                                $idCard = $trow['idCard'];
                                                $phoneNumber = $trow['phoneNumber'];									
                                                echo"<tr>
                                                    <th><i class='btn fas fa-arrow-left' style='padding: 0; font-size:20px;' onclick='add_customerID_to_form($customerID)'></i></th>
                                                    <td>".$customerID."</td>
                                                    <td>".$customerName."</td>
                                                    <td>".$idCard."</td>
                                                    <td>".$phoneNumber."</td>
                                                    </tr>";
                                            }
                                        
									?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" style="max-height:500px;min-height=300px">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    READY ROOMS INFORMATION
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example1">
                                                <thead>
                                                    <tr>
                                                        <th>ADD</th>
                                                        <th>ID</th>
                                                        <th>Type</th>
                                                        <th>Bedding</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php                                    
                                        $sql = "select * from room where status='ready'";
                                        $result = mysqli_query($conn,$sql);                                    
										while($row= mysqli_fetch_array($result))
										{
                                            $roomid = $row['roomID'];
											$roomtype = $row['type'];
											$roombed = $row['bedding'];
                                            $roomprice = $row['price'];
                                            $roomstatus = $row['status'];
                                            $roomnote = $row['note'];
                                            echo "<tr>
                                                <th><i class='btn fas fa-arrow-left' style='padding: 0; font-size:20px;' onclick='add_roomid_to_form($roomid)'></i></th>
											    <td>".$roomid."</td>
											    <td>".$roomtype."</td>
											    <td>".$roombed."</td>
											    <td>".$roomprice."</td>
											    <td>".$roomstatus."</td>
											    <td>".$roomnote."</td>	                                                		
											    </tr>";
										}
									?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- /. WRAPPER  -->
            <!-- JS Scripts-->
            <!-- jQuery Js -->
            <script src="assets/js/jquery-1.10.2.js"></script>
            <!-- Bootstrap Js -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- Metis Menu Js -->
            <script src="assets/js/jquery.metisMenu.js"></script>
            <!-- Morris Chart Js -->
            <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
            <script src="assets/js/morris/morris.js"></script>
            <!-- DATA TABLE SCRIPTS -->
            <script src="assets/js/dataTables/jquery.dataTables.js"></script>
            <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
            <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable({
                    "lengthMenu": [3, 10, 25, 50, 75, 100]
                });
            });
            </script>
            <script>
            $(document).ready(function() {
                $('#dataTables-example1').dataTable({
                    "lengthMenu": [5, 10, 25, 50, 75, 100],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json"
                    }
                });
            });
            </script>
            <!-- Custom Js -->
            <script src="assets/js/custom-scripts.js"></script>
            <!-- Custom Js -->
            <script src="assets/js/custom-scripts.js"></script>
            <!-- Date JS -->
            <script>
            function dayCountandCheck() {
                var d1 = document.getElementById('checkin').value;
                var d2 = document.getElementById('checkout').value;
                var date1 = new Date(d1);
                var date2 = new Date(d2);
                var count = (date2 - date1) / (1000 * 3600 * 24);
                if (count >= 0) {
                    if (count == 0) {
                        count = 1;
                    }
                    document.getElementById('newdays').value = count;
                } else {
                    alert("Check Out must be after Check In");
                    document.getElementById('checkin').value = "<?php echo date('Y-m-d'); ?>";
                    document.getElementById('checkout').value = "<?php echo date('Y-m-d'); ?>";
                }
            }

            function add_customerID_to_form(customerID) {
                document.getElementById('customerID').value = customerID;
            }

            function add_roomid_to_form(roomid) {
                var room_input = document.getElementById('room').value;
                if (room_input == "") {
                    document.getElementById('room').value = roomid;
                } else {
                    var room_input_array = room_input.split(",");
                    var c = 0;
                    for (var i = 0; i < room_input_array.length; i++) {

                        if (room_input_array[i] == roomid) {
                            c += 1;
                        }
                    }
                    if (c != 0) {
                        alert("This room already Added");
                    } else {
                        room_input += "," + roomid + "";
                    }
                    document.getElementById('room').value = room_input;
                }
            }
            </script>


</body>


</html>