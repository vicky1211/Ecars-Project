<?php


error_reporting(0);
$error = '';
if(isset($_POST['login']))
{
include("../dbconnect.php");
$email =  mysqli_real_escape_string($conn,trim($_POST['email']));
$password =  mysqli_real_escape_string($conn,$_POST['pass']);



if($email=='' || $password=='')
{
$error='All fields are required';
}
else{




$sql = "select * from user where email='".$email."' and pass = '".$password."'";

$q = $conn->query($sql);
if($q->num_rows==1)
{
$res = $q->fetch_assoc();
$_SESSION['email']=$res['email'];
$_SESSION['uid']=$res['id'];
$_SESSION['fname']=$res['fname'];
$_SESSION['mobNo']=$res['mobNo'];
$_SESSION['address']=$res['address'];
$_SESSION['profile']=$res['profile'];


echo '<script type="text/javascript">window.location="index.php"; </script>';


}else
{
$error = 'Invalid Username or Password';
}
}
}




?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <h1 style="color:white; text-shadow: 2px 2px 5px black;">ECARS User Login</h1>
                    </a>
                </div>
                <div class="login-form">
				
						<?php if ($error!='') {
                        
                          ?> 
							<div class="col-sm-12">
							<div class="alert  alert-danger alert-dismissible fade show" role="alert">
							<span class="badge badge-pill badge-danger">X</span><?php echo $error; ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							</div>
							</div>
						<?php
                        }
                        ?>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required >
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <button name="login" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        
                       
                    </form>
						<div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="userRegistration.php"> Sign Up Here</a></p>
                        </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


</body>
</html>