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
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div>
                    <h3 style="font-size:25px; margin:12px 0">
                        Bill Information <span class="badge"></span>
                    </h3>
                </div>
                <div>
                    <div style="line-height: 1.5; display:flex; flex-direction: column; margin-left:12px; ">
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
                    <div style="line-height: 1.5; display:flex; flex-direction: column; margin-left:12px; ">
                        <div>
                            <label style="margin-right:3px">Bill Id:
                            </label><?php echo $billid ?>
                        </div>
                        <div>
                            <label style="margin-right:3px">Payment
                                Date:</label><?php echo date("Y/m/d") ?>
                        </div>
                        <div>
                            <label style="margin-right:3px">Staff:</label><?php echo $_SESSION['user'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-collapse in" style="height: auto;">
                <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive  col-md-12">
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
                                    <tbody>
                                        <?php 
                                            $room_infor = "SELECT roomregistration.roomID, room.price, registrationform.checkIn, registrationform.checkOut, registrationform.days FROM registrationform, roomregistration,room WHERE registrationform.registerID ='$id' AND registrationform.registerID = roomregistration.registerID AND roomregistration.roomID = room.roomID";
                                            $room_infor_result = mysqli_query($conn,$room_infor);
                                            $room_total=0;
                                            while($room_infor_row = mysqli_fetch_array($room_infor_result) )
                                            {
                                                $room_total += $room_infor_row['price'] * $room_infor_row['days']; 
                                                $roomID = $room_infor_row['roomID'];
                                                $room_price = $room_infor_row['price'];
                                                $checkIn = $room_infor_row['checkIn'];
                                                $checkOut = $room_infor_row['checkOut'];
                                                $days = $room_infor_row['days'];
                                                                                
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
                                </table>
                            </div>
                            <div class="table-responsive  col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
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
                                </table>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; margin: 0 20px 10px 0; text-align: right">
                            <div style="flex:6; padding-left:46%; content: auto">Room Total:
                                <?php echo $room_total ?></div>
                            <div style="flex:4; padding-left: 21%">Service Total:
                                <?php echo $sum_service_total ?></div>
                        </div>
                        <div style="border-top: dashed; margin-left: 46%"></div>
                        <div style="text-align: right; margin:0 20px 20px 0; line-height: 1.8">
                            <div>Total pre VAT:
                                <?php echo ($sum_service_total + $room_total) ?></div>
                            <div>VAT (10%):
                                <?php echo ($sum_service_total + $room_total)*0.1 ?>
                            </div>
                            <div>Total:
                                <?php echo ($sum_service_total + $room_total)*1.1 ?>
                            </div>
                            <div>Prepay: <?php echo $prepay ?></div>
                            <div>Total Due:
                                <?php echo ($sum_service_total + $room_total)*1.1 - $prepay ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>