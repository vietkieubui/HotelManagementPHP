<?php
include('db.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVATION SALA LAND HOTEL</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="./index.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>
                </ul>

            </div>

        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            RESERVATION <small></small>
                        </h1>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-5 col-sm-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                CUSTOMER INFORMATION
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input name="newCustomerName" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Card / Passport</label>
                                        <input name="newIDCard" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="male" checked="">Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="female">Female
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="newAddress" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input name="newPhoneNumber" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input name="newNationality" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="newEmail" type="email" class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    RESERVATION INFORMATION
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Type Of Room *</label>
                                        <select name="type" class="form-control" required>
                                            <option value="Normal Room">NORMAL ROOM</option>
                                            <option value="VIP Room">VIP ROOM</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bedding Type</label>
                                        <select name="bed" class="form-control" required>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Room(s)</label>
                                        <input name="numroom" type="number" class="form-control" value="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Check-In</label>
                                        <input name="newCheckin" type="date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Check-Out</label>
                                        <input name="newCheckout" type="date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input name="newNote" type="text" class="form-control"
                                            placeholder="Note somethings for Receptionist">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">

                            <div class="well">
                                <h4>HUMAN VERIFICATION</h4>
                                <p>Type Below this code</p>
                                <p><span oncopy="return false" oncut="return false"
                                        onselectstart="return false"><?php $Random_code=rand(100000,999999); echo$Random_code; ?>
                                    </span></p>
                                <p>Enter the random code</p>
                                <input type="text" name="code1" title="random code" />
                                <input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
                                <input type="submit" name="submit" class="btn btn-primary">
                                <?php
							if(isset($_POST['submit'])){
                                $code1=$_POST['code1'];
                                $code=$_POST['code']; 
                                if($code1!="$code"){
                                    $msg="Invalide code";
                                    echo $msg;                             
                                }else{                                        
                                        
                                        // get information
                                        $customerName = $_POST['newCustomerName'];
                                        $idcard = $_POST['newIDCard'];
                                        $gender = $_POST['gender'];
                                        $phoneNumber = $_POST['newPhoneNumber'];
                                        $address = $_POST['newAddress'];
                                        $email = $_POST['newEmail'];
                                        $nationality = $_POST['newNationality'];
                                        $roomType = $_POST['type'];                                        
                                        $roomBed = $_POST['bed'];
                                        $numRoom = $_POST['numroom'];
                                        $checkIn = $_POST['newCheckin'];
                                        $checkOut = $_POST['newCheckout'];
                                        $note = $_POST['newNote'];

                                        // check id card
                                        $check_id_card = "SELECT * FROM customer WHERE idCard='$idcard'";
                                        $check_id_card_result = mysqli_query($conn,$check_id_card);
                                        $numrow_id = mysqli_num_rows($check_id_card_result);
                                        if($numrow_id > 0) {
                                            // nếu có
                                            $get_customer_id = "SELECT * FROM customer WHERE idCard='$idcard'";
                                            $get_customer_id_result = mysqli_query($conn, $get_customer_id);
                                            while($cusrow = mysqli_fetch_array($get_customer_id_result)){
                                                $customerid = $cusrow['customerID'];
                                            }
                                            $insert_into_prebook = "INSERT INTO `prebook`(`customerID`,`phoneNumber`, `type`, `bedding`, `numroom`, `checkIn`, `checkOut`, `note`,`status`) 
                                                                    VALUES ('$customerid','$phoneNumber','$roomType','$roomBed','$numRoom','$checkIn','$checkOut','$note','not check')";
                                            if(mysqli_query($conn,$insert_into_prebook)){
                                                echo "<script type='text/javascript'> alert('Your Booking application has been sent. We will call back to you soon to confirm.')</script>";
                                            }                                            
                                        }else{
                                            // Nếu không
                                            // insert into customer
                                            $insert_into_customer = "INSERT INTO `customer`(`customerName`, `idCard`, `gender`, `address`, `phoneNumber`, `nationality`, `email`) 
                                                                                VALUES ('$customerName','$idcard','$gender','$address','$phoneNumber','$nationality','$email')";
                                            if (mysqli_query($conn,$insert_into_customer)){
                                                $get_customer_id = "SELECT * FROM customer WHERE idCard='$idcard'";
                                                $get_customer_id_result = mysqli_query($conn, $get_customer_id);
                                                while($cusrow = mysqli_fetch_array($get_customer_id_result)){
                                                    $customerid = $cusrow['customerID'];
                                                }
                                                $insert_into_prebook = "INSERT INTO `prebook`(`customerID`,`phoneNumber`, `type`, `bedding`, `numroom`, `checkIn`, `checkOut`, `note`,`status`) 
                                                                        VALUES ('$customerid','$phoneNumber','$roomType','$roomBed','$numRoom','$checkIn','$checkOut','$note','not check')";
                                                if(mysqli_query($conn,$insert_into_prebook)){
                                                    echo "<script type='text/javascript'> alert('Your Booking application has been sent. We will call back to you soon to confirm.')</script>";
                                                } 
                                            }
                                            else
                                            {
                                                echo "<script type='text/javascript'> alert('Error adding user in database')</script>";
                                            }
                                        }
                                }
							}
					    ?>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>