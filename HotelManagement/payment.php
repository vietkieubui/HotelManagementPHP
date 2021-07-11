<?php  
    session_start();  
    if(!isset($_SESSION["user"]))
    {
     header("location:index.php");
    }
    ob_start();

    include ('db.php'); 
	$id =$_GET['id'];
    // get Customer Information
    $get_customer_info = "SELECT customer.customerID, customer.customerName,customer.phoneNumber FROM customer, registrationform WHERE registrationform.registerID ='$id' AND registrationform.customerID = customer.customerID";
    $get_customer_info_result = mysqli_query($conn,$get_customer_info);
    while($customer_row = mysqli_fetch_array($get_customer_info_result)){
        $customerid = $customer_row['customerID'];
        $customername = $customer_row['customerName'];
        $customerphonenumber = $customer_row['phoneNumber'];
    }
    // get prepay
    $get_prepay = "SELECT * FROM registrationform WHERE registerID='$id'";
    $get_prepay_result = mysqli_query($conn,$get_prepay);
    while($get_prepay_row = mysqli_fetch_array($get_prepay_result)){
        $prepay = $get_prepay_row['prepay'];
    }
    // get bill ID
    $get_billid = "SELECT * FROM `bill` WHERE registerID = '$id'";
    $get_billid_result = mysqli_query($conn,$get_billid);
    while($get_billid_row = mysqli_fetch_array($get_billid_result)){
        $billid = $get_billid_row['billID'];
    }
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
                    <span class="sr-only">Toggle navigatio n</span>
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
                        <a href="home.php"><i class="fas fa-tachometer-alt"></i> Status</a>
                    </li>
                    <li>
                        <a href="roombooking.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>
                    <li>
                        <a class="active-menu" href="payment.php"><i class='far fa-credit-card'></i> Payment</a>
                    </li>
                    <li>
                        <a href=""><i class="fas fa-users"></i> Customer</a>
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
                            Payment
                        </h1>
                    </div>

                </div>
                <!-- /. ROW  -->

                <!-- in ra bảng -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                            </div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div>
                                                <h3 style="font-size:25px; margin:12px 0">
                                                    Payment Information <span class="badge"></span>
                                                </h3>
                                            </div>
                                            <div style="display: flex">
                                                <div
                                                    style="flex:8; line-height: 1.5; display:flex; flex-direction: column; margin-left:12px; ">
                                                    <div>
                                                        <label style="margin-right:3px">Customer ID:
                                                        </label><?php echo $customerid ?>
                                                    </div>
                                                    <div>
                                                        <label style="margin-right:3px">Customer
                                                            Name:</label><?php echo $customername ?>
                                                    </div>
                                                    <div>
                                                        <label style="margin-right:3px">Phone
                                                            Number:</label><?php echo $customerphonenumber ?>
                                                    </div>
                                                </div>
                                                <div
                                                    style="flex: 5.5; line-height: 1.5; display:flex; flex-direction: column; margin-left:12px; ">
                                                    <div>
                                                        <label style="margin-right:3px">Bill Id:
                                                        </label><?php echo $billid ?>
                                                    </div>
                                                    <div>
                                                        <label style="margin-right:3px">Payment
                                                            Date:</label><?php echo date("Y/m/d") ?>
                                                    </div>
                                                    <div>
                                                        <label
                                                            style="margin-right:3px">Staff:</label><?php echo $_SESSION['user'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-collapse in" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive  col-md-7">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>RoomID</th>
                                                                        <th>Price</th>
                                                                        <th>CheckIn</th>
                                                                        <th>CheckOut</th>
                                                                        <th>Day(s)</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <!-- start thân bảng -->
                                                                <tbody>
                                                                    <?php 
                                                                    $room_infor = "SELECT roomregistration.roomID, room.price, registrationform.checkIn, registrationform.checkOut, registrationform.days FROM registrationform, roomregistration,room WHERE registrationform.registerID ='$id' AND registrationform.registerID = roomregistration.registerID AND roomregistration.roomID = room.roomID";
                                                                    $room_infor_result = mysqli_query($conn,$room_infor);
                                                                    $sum_room_total = 0;
                                                                    while($room_infor_row = mysqli_fetch_array($room_infor_result) )
                                                                    {
                                                                        $room_total = $room_infor_row['price'] * $room_infor_row['days']; 
                                                                        $roomID = $room_infor_row['roomID'];
                                                                        $room_price = $room_infor_row['price'];
                                                                        $checkIn = $room_infor_row['checkIn'];
                                                                        $checkOut = $room_infor_row['checkOut'];
                                                                        $days = $room_infor_row['days'];
                                                                        $sum_room_total += $room_total;						
                                                                        echo"<tr>
                                                                            <td>".$roomID."</td>
                                                                            <td>".$room_price."</td>
                                                                            <td>".$checkIn."</td>
                                                                            <td>".$checkOut."</td>
                                                                            <td>".$days."</td>
                                                                            <td>".$room_total."</td>
                                                                            </tr>";
                                                                    }
                                                                ?>
                                                                </tbody>
                                                                <!-- end THân bảng -->
                                                            </table>
                                                        </div><!-- Kết thúc in ra bảng 1-->
                                                        <div class="table-responsive  col-md-5">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Service Name</th>
                                                                        <th>Price</th>
                                                                        <th>Amount</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <!-- start thân bảng -->
                                                                <tbody>
                                                                    <?php 
                                                                    $service_info = "SELECT service.serviceName, service.price, serviceregistration.amount, serviceregistration.total FROM serviceregistration, registrationform, service WHERE registrationform.registerID ='$id' AND registrationform.registerID = serviceregistration.registerID AND service.serviceID = serviceregistration.serviceID";
                                                                    $service_infor_result = mysqli_query($conn,$service_info);
                                                                    $sum_service_total = 0;
                                                                    while($service_infor_row = mysqli_fetch_array($service_infor_result) )
                                                                    {
                                                                        
                                                                        $servicename = $service_infor_row['serviceName'];
                                                                        $service_price = $service_infor_row['price'];
                                                                        $amount = $service_infor_row['amount'];
                                                                        $service_total = $service_infor_row['total'];
                                                                        $sum_service_total += $service_total;
                                                                        								
                                                                        echo"<tr>
                                                                            <td>".$servicename."</td>
                                                                            <td>".$service_price."</td>
                                                                            <td>".$amount."</td>
                                                                            <td>".$service_total."</td>
                                                                            </tr>";                                                                   }
                                                                ?>
                                                                </tbody>
                                                                <!-- end THân bảng -->
                                                            </table>
                                                        </div><!-- Kết thúc in ra bảng 2-->
                                                    </div>
                                                    <div style="display: flex">
                                                        <div style="flex:6; padding-left:46%; content: auto">Total:
                                                            <?php echo $sum_room_total ?></div>
                                                        <div style="flex:4; padding-left: 21%">Total:
                                                            <?php echo $sum_service_total ?></div>
                                                    </div>
                                                    <div style="border-top: dashed; margin-left: 46%"></div>
                                                    <div
                                                        style="text-align: right; margin:0 20px 20px 0; line-height: 1.8">
                                                        <div>Total pre VAT:
                                                            <?php echo ($sum_service_total + $sum_room_total) ?></div>
                                                        <div>VAT (10%):
                                                            <?php echo ($sum_service_total + $sum_room_total)*0.1 ?>
                                                        </div>
                                                        <div>Total:
                                                            <?php echo ($sum_service_total + $sum_room_total)*1.1 ?>
                                                        </div>
                                                        <div>Prepay: <?php echo $prepay ?></div>
                                                        <div>Total Due:
                                                            <?php echo ($sum_service_total + $sum_room_total)*1.1 - $prepay ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post">
                                            <div class="modal-footer">
                                                <button type="submit" name="print" class="btn btn-primary"
                                                    data-dismiss="modal"><i class="fa fa-print"></i> Print</button>

                                                <button type="submit" name="payment" class="btn btn-success"
                                                    data-dismiss="modal"><i class='far fa-credit-card'></i>
                                                    Payment</button>

                                            </div>
                                        </form>
                                    </div>
                                    <!-- /. PAGE INNER  -->
                                </div>
                                <!-- /. PAGE WRAPPER  -->
                            </div>


                            <?php 
                                include('db.php');
                                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['payment'])){                                 
                                    $date = date("Y-m-d");                                    
                                    $staff = $_SESSION['user'];
                                    $subtotal = $sum_service_total + $sum_room_total;
                                    $vat = ($sum_service_total + $sum_room_total)*0.1;
                                    $total = ($sum_service_total + $sum_room_total)*1.1;
                                    $profit = $total*0.2;
                                    $update_bill = "UPDATE `bill` SET `paymentDate`='$date',`staff`='$staff',`roomcharge`='$sum_room_total',`servicecharge`='$sum_service_total',`subTotal`='$subtotal',`vat`='$vat',`total`='$total', `profit`='$profit' WHERE billID='$billid'";
                                    if(mysqli_query($conn,$update_bill)){
                                        $update_registrationform = "UPDATE `registrationform` SET `note`='paid' WHERE registerID = '$id'";
                                        if(mysqli_query($conn,$update_registrationform)) { 
                                            $select_room_id_to_update = "SELECT * FROM roomregistration WHERE registerID = '$id'";
                                            $select_room_id_to_update_result = mysqli_query($conn,$select_room_id_to_update);
                                            while($room_id_update_row = mysqli_fetch_array($select_room_id_to_update_result)){
                                                $roomID_update = $room_id_update_row['roomID'];
                                                $update_room_status = "UPDATE `room` SET `status` = 'ready' WHERE roomID ='$roomID_update' ";
                                                if(mysqli_query($conn,$update_room_status)){
                                                    
                                                } 
                                            }                                 
                                            echo' <script language="javascript" type="text/javascript"> alert("Payment success!") </script>';                                      
                                        }
                                    }                                    
                                }
                                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['print'])){
                                    header("location: print.php?id=".$id);
                                }
                            ?>
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