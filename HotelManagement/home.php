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
</head>

<body>
    <!-- wrapper -->
    <div id="wrapper">
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
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="home.php"><i class="fas fa-tachometer-alt"></i> Status</a>
                    </li>
                    <li>
                        <a href="roombooking.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
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
        <!-- từ đây trở lên là phần chung tất cả các trang chú ý class active-menu-->
        <!-- /. NAV SIDE  -->
        <!-- đây là phần body chính -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Room Booking </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <!-- count row booked -->
                <div class="row">
                    <?php
                        include('db.php');
                        $select_room_booked = "SELECT registrationform.registerID, customer.customerID, customer.customerName, customer.idCard, customer.phoneNumber, registrationform.checkIn,registrationform.checkOut,room.roomID, room.status, registrationform.note FROM registrationform, customer, room, roomregistration WHERE registrationform.registerID = roomregistration.registerID AND room.roomID = roomregistration.roomID AND registrationform.customerID = customer.customerID AND room.status='booked' AND registrationform.note!='paid'";
                        $result_booked = mysqli_query($conn,$select_room_booked);
                        $c_booked = 0;                                    
                        while($row_booked = mysqli_fetch_array($result_booked)){
                            $c_booked+=1;
                        }
                    ?>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">

                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    <button class="btn btn-default" type="button">
                                                        Room Bookings <span class="badge"><?php echo $c_booked?></span>
                                                    </button>
                                                </a>
                                                <a href="roombooking.php">
                                                    <button class="btn btn-success" type="button">
                                                        New Room Bookings
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>registerID</th>
                                                                        <th>customerID</th>
                                                                        <th>customerName</th>
                                                                        <th>IDCard</th>
                                                                        <th>PhoneNumber</th>
                                                                        <th>CheckIn</th>
                                                                        <th>CheckOut</th>
                                                                        <th>RoomID</th>
                                                                        <th>Status</th>
                                                                        <th>Note</th>
                                                                        <th>Action</th>
                                                                        <th>Cancel</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                        include('db.php');
                                                                        $select_room_booked = "SELECT registrationform.registerID, customer.customerID, customer.customerName, customer.idCard, customer.phoneNumber, registrationform.checkIn,registrationform.checkOut,room.roomID, room.status, registrationform.note FROM registrationform, customer, room, roomregistration WHERE registrationform.registerID = roomregistration.registerID AND room.roomID = roomregistration.roomID AND registrationform.customerID = customer.customerID AND room.status='booked' AND registrationform.note!='paid'";
                                                                        $result_booked = mysqli_query($conn,$select_room_booked);                                  
                                                                        while($row_booked = mysqli_fetch_array($result_booked)){
                                                                            $registerID_booked = $row_booked['registerID'];
                                                                            $customerID_booked = $row_booked['customerID'];
                                                                            $customerName_booked = $row_booked['customerName'];
                                                                            $idCard_booked = $row_booked['idCard'];
                                                                            $phoneNumber_booked = $row_booked['phoneNumber'];
                                                                            $checkIn_booked = $row_booked['checkIn'];
                                                                            $checkOut_booked = $row_booked['checkOut'];
                                                                            $roomID_booked = $row_booked['roomID'];
                                                                            $status_booked = $row_booked['status'];
                                                                            $note_booked = $row_booked['note'];
                                                                            echo "<tr>
                                                                                <th>".$registerID_booked."</th>
                                                                                <th>".$customerID_booked."</th>
                                                                                <th>".$customerName_booked."</th>
                                                                                <th>".$idCard_booked."</th>
                                                                                <th>".$phoneNumber_booked."</th>
                                                                                <th>".$checkIn_booked."</th>	
                                                                                <th>".$checkOut_booked."</th>
                                                                                <th>".$roomID_booked."</th>
                                                                                <th>".$status_booked."</th>
                                                                                <th>".$note_booked."</th>
                                                                                <td><a href='checkin.php?id=$roomID_booked'><button class='btn btn-primary'> <i class='fas fa-check' ></i> CheckIn</button></a></td>	
                                                                                <td><a href='cancelroom.php?id=$roomID_booked'><button class='btn btn-danger'> <i class='fas fa-times'></i> Cancel</button></a></td>										
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
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <?php
                                                include('db.php');
                                                $select_room_using = "SELECT registrationform.registerID, customer.customerName, customer.idCard, customer.phoneNumber, room.roomID, registrationform.note FROM registrationform, customer,room,roomregistration WHERE registrationform.registerID = roomregistration.registerID AND room.roomID = roomregistration.roomID AND  registrationform.customerID = customer.customerID AND room.status='using' AND registrationform.note!='paid'" ;
                                                $result_using = mysqli_query($conn,$select_room_using);
                                                $c_using = 0;                                    
                                                while($row_booked = mysqli_fetch_array($result_using)){
                                                    $c_using+=1;
                                                }
                                            ?>

                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    <button class="btn btn-primary" type="button">
                                                        Using Rooms <span class="badge"><?php echo $c_using?></span>
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>registerID</th>
                                                                        <th>customerName</th>
                                                                        <th>IDCard</th>
                                                                        <th>PhoneNumber</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>RoomID</th>
                                                                        <th>Note</th>
                                                                        <th>Use Service</th>
                                                                        <th>Payment</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                        include('db.php');
                                                                        $select_room_using = "SELECT registrationform.registerID, customer.customerName, customer.idCard, customer.phoneNumber,registrationform.checkIn, registrationform.checkOut, room.roomID, registrationform.note FROM registrationform, customer,room,roomregistration WHERE registrationform.registerID = roomregistration.registerID AND room.roomID = roomregistration.roomID AND registrationform.customerID = customer.customerID AND room.status='using' AND registrationform.note!='paid'";
                                                                        $result_using = mysqli_query($conn,$select_room_using);                                  
                                                                        while($row_using = mysqli_fetch_array($result_using)){
                                                                            $registerID_using = $row_using['registerID'];
                                                                            $customerName_using = $row_using['customerName'];
                                                                            $idCard_using = $row_using['idCard'];
                                                                            $phoneNumber_using = $row_using['phoneNumber'];
                                                                            $checkin_using = $row_using['checkIn'];
                                                                            $checkout_using = $row_using['checkOut'];
                                                                            $roomID_using = $row_using['roomID'];
                                                                            $note_using = $row_using['note'];
                                                                            echo "<tr>
                                                                                <th>".$registerID_using."</th>
                                                                                <th>".$customerName_using."</th>
                                                                                <th>".$idCard_using."</th>
                                                                                <th>".$phoneNumber_using."</th>
                                                                                <th>".$checkin_using."</th>
                                                                                <th>".$checkout_using."</th>
                                                                                <th>".$roomID_using."</th>
                                                                                <th>".$note_using."</th>
                                                                                <td><a href='usingservice.php?id=$registerID_using'><button class='btn btn-primary'> <i class='fas fa-concierge-bell'></i> Use Service</button></a></td>	
                                                                                <td><a href='payment.php?id=$registerID_using'><button class='btn btn-danger'><i class='far fa-credit-card'></i> Payment</button></a></td>										
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
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>