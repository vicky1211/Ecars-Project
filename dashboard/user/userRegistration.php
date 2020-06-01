

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ECARS | User Registration</title>
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
                        <h1 style="color:white; text-shadow: 2px 2px 5px black;">ECARS User Registration</h1>
                    </a>
                </div>
                <div class="login-form">
				
						
							<div class="col-sm-12" id="error">
							
							</div>
						
					
				
				
                    <form id="regForm"> 
                        <div class="form-group">
                            <label>Full Name: <sup style="color:red;">* </sup></label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter Full Name" required>
                        </div>
                        <div class="form-group">
                            <label>Email address: <sup style="color:red;">* </sup></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                        </div>
						<div class="form-group">
                            <label>Mobile No.: <sup style="color:red;">* </sup></label>
                            <input type="text" name="mobno" id="mobno" class="form-control" placeholder="Enter Mobile Number" required>
                        </div>
						<div class="form-group">
                            <label>Address: <sup style="color:red;">* </sup></label>
                            <textarea type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required></textarea>
                        </div>
						<div class="form-group">
                            <label>Profile: </label>
                            <input type="file" name="profile" id="profile" class="form-control" placeholder="Profile" >
                        </div>
                        
						<div class="form-group">
							<label>Password<sup style="color:red">*</sup></label>
							<input type="password" name="pass" id="pass" class="form-control" placeholder="Enter Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
						</div>
						<div class="form-group">
							<label>Confirm Password<sup style="color:red">*</sup></label>
							<input type="password" name="conpass" id="conpass"  class="form-control" placeholder="Enter Password Again" required>
							<span id="message"></span>
						</div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Agree the terms and policy
                            </label>
                        </div>
                        <button type="submit" id="submitform" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="login.php"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

	<script>
	$('#error').hide();
		$('#pass, #conpass').on('keyup', function () {
		  if ($('#pass').val() == $('#conpass').val()) {
			$('#message').html('Matching').css('color', 'green');
			document.getElementById("submitform").disabled = false;
		  } else 
			$('#message').html('Not Matching').css('color', 'red');
			document.getElementById("submitform").disabled = true;
		});
		$('#pass, #conpass').on('keyup', function () {
		  if ($('#pass').val() == $('#conpass').val()) {
			
			document.getElementById("submitform").disabled = false;
		  } else 
			
			document.getElementById("submitform").disabled = true;
		});
		
		
		$("form#regForm").submit(function(e) {
			e.preventDefault();    
			var formData = new FormData(this);

			$.ajax({
				url: "insertUserRegistration.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					window.scrollTo(0, 0);
					$('#error').html(data);
					$('#error').show();
					
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});

      

	</script>
</body>
</html>
