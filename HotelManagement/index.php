<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:home.php");  
 }  
 
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
</head>

<body>
    <div class="container">
        <div id="login">
            <form method="post">
                <fieldset class="clearfix">
                    <p><span class="fontawesome-user"></span><input type="text" name="user" placeholder="Username">
                    <p><span class="fontawesome-lock"></span><input type="password" name="pass" placeholder="Password">
                    <p><input type="submit" name="sub" value="Login"></p>
                </fieldset>
            </form>
        </div>
    </div>


</body>

</html>

<?php
  include('db.php');   
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    
    $myusername = $_POST['user'];
    $mypassword = $_POST['pass'];

    
    $sql = "SELECT * FROM login WHERE user = '$myusername' and pass = '$mypassword'";
    $result = mysqli_query($conn,$sql);    
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
         
      $_SESSION['user'] = $myusername;
      
      header("Location: home.php");
    }else {
      echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
    }
 }
?>