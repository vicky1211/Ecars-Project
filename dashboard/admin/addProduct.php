<?php
include('../dbconnect.php');
include('checklogin.php');
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard | ECARS</title>
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
    <link href="../assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	<style>

.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.activedot, .dot:hover {
  background-color: #717171;
}





	
	</style>
</head>
<body>


       <?php include('sidebar.php'); ?>

    <div id="right-panel" class="right-panel">

        <?php include('header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Products</h1>
                    </div>
                </div>
            </div>
            <!--<div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Admin Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>-->
        </div>

        <div class="content mt-3">
			<div class="row">
				<div class="col-md-9">
					<form id="proUpload">
						<div class="row">
							<div class="col-md-5 text-right" >
								<div class="form-group">
									<label for="img"  style="padding:.375rem .75rem;">Upload Image</label>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="file"  name="img0" id="img0"  class="img form-control" style="background-color:transparent; padding-left:0;  border:none;">
								</div>
								<p id='addImage' data-id="1" style="color:blue; cursor:pointer;">Add More Image</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5"></div>
							<div class="col-md-4" >
								<div id="img123" class="slideshow-container">
								</div>
								<div id="dotbox" style="text-align:center">
								</div>
							</div>
							<div id="productImg">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-5 text-right" >
								<div class="form-group">
									<label for="pName"  style="padding:.375rem .75rem;">Product Name</label>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<input type="text" id="pName" name="pName" placeholder="Enter Product Name" class="form-control">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-5 text-right" >
								<div class="form-group">
									<label for="pDesc"  style="padding:.375rem .75rem;">Description</label>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<textarea id="pDesc" name="pDesc" placeholder="Enter Product Description" class="form-control"></textarea>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-5 text-right" >
								<div class="form-group">
									<label for="price"  style="padding:.375rem .75rem;">Price</label>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group input-group">
									<div class="input-group-btn">
										<a class="btn btn-primary" href="javascript:void(0)"><i class="fa fa-rupee"></i></a>
									</div>
									<input type="text" id="price" name="price" pattern="[0-9]+(\\.[0-9][0-9]?)?" placeholder="Enter Product Price" class="form-control">
								</div>
							</div>
						</div>
						
						<center><button type="submit" class="btn btn-primary"  name="productsubmit">Add Product</button</center>
					</form>
				</div>
				<div class="col-md-3">
				bb
				</div>
			</div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
	<script>
	var slideIndex = 0;
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" activedot", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " activedot";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
	</script>
	
	<script>
	
		var imgarr = [];
		$("input[type=file]").change(function(){
			$("#img123").append('<div class="mySlides"><img src="'+URL.createObjectURL(event.target.files[0])+'" style="width:100%"></div>');
			$("#dotbox").append('<span class="dot"></span> ');
			showSlides();
		});
		
		function fileChange()
		{
			$("#img123").append('<div class="mySlides"><img src="'+URL.createObjectURL(event.target.files[0])+'" style="width:100%"></div>');
			$("#dotbox").append('<span class="dot"></span> ');
			showSlides();
		}
		
		$("form#proUpload").submit(function(e) {
			e.preventDefault();    
			var formData = new FormData(this);

			$.ajax({
				url: "uploadProduct.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					alert(data);
					location.reload();
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
		
		$("#addImage").click(function(){
			var index = $(this).attr('data-id');
			$(this).prev().append('<input type="file" onchange="fileChange();"  name="img'+index+'"  class="img form-control" style="background-color:transparent; padding-left:0;  border:none;">');
			index++;
			$(this).attr('data-id',index);
		});
		
	</script>

</body>
</html>
