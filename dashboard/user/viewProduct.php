<?php
include('../dbconnect.php');
include('checklogin.php');
error_reporting(0);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Dashboard | ECARS</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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



.card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
}

.card-product .img-wrap {
    max-height: 100%;
    width: 100%;
    object-fit: cover;
}
.card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee;
}
.card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee;
}

.label-rating { margin-right:10px;
    color: #333;
    display: inline-block;
    vertical-align: middle;
}

.card-product .price-old {
    color: #999;
}

.star-ratings-sprite {
  background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
  font-size: 0;
  height: 21px;
  line-height: 0;
  overflow: hidden;
  text-indent: -999em;
  width: 110px;
  margin: 0 auto;
  
  
  
}
.star-ratings-sprite-rating {
    background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
    background-position: 0 100%;
    float: left;
    height: 21px;
    display:block;
  }

  .rating {
  display: inline-block;
  position: relative;
  height: 40px;
  line-height: 40px;
  font-size: 40px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color: #ffb100;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #ffb100;
}



	
	</style>
	<link rel="stylesheet" href="css/site.css">
	
</head>
<body>


       <?php include('sidebar.php'); ?>

    <div id="right-panel" class="right-panel">

        <?php include('header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>View Products</h1>
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
			<?php
				$result = mysqli_query($conn,"select * from products" );
				if (mysqli_num_rows($result) > 0) 
				{	
					$i = 1;
					while($row = mysqli_fetch_assoc($result)) 
					{
					?>
						<div class="col-md-4">
							<figure class="card card-product">
								<div class="img-wrap " style="padding:10px;">
									<?php
										$result1 = mysqli_query($conn,"select * from productimg where productId='".$row['id']."'" );
										while($row1 = mysqli_fetch_assoc($result1)) 
										{
									?>
									<img class="mySlides<?php echo $i; ?>" src="../admin/<?php echo $row1['url']; ?>" style="max-width:100%; max-height:100%; margin:auto;" />
									<?php 
										}
									?>
									<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1, <?php echo $i-1; ?>)">&#10094;</button>
									<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1, <?php echo $i-1; ?>)">&#10095;</button>
								</div>
								<figcaption class="info-wrap">
										<h4 class="title" ><?php echo $row['pName']; ?></h4>
										<!--p class="desc" style="width:300px; white-space: nowrap; overflow:hidden; text-overflow: ellipsis;"><?php //echo $row['pDesc']; ?></p-->
										<div class="rating-wrap">
											<?php
												$result1 = mysqli_query($conn, "select * from rating where productId = '".$row['id']."'");
												$total = 0;
												while($row1 = mysqli_fetch_assoc($result1))
												{
													$total = $total + $row1['rating'];
												}
												$ratingBar = ($total * 100) / (mysqli_num_rows($result1) * 5);
											?>
										
											<div class="sub-row text-warning" style='margin:10px 0;'>
												<div class="star-ratings-sprite" style="margin:0;"><span style="width:<?php echo $ratingBar; ?>%" class="star-ratings-sprite-rating"></span></div>
											</div>
										</div>
										<div class="rating-wrap">
											<div class="label-rating"><?php echo mysqli_num_rows($result1); ?> reviews</div>
											<?php
											$result1 = mysqli_query($conn, "select * from myorders where productId = '".$row['id']."'");
											?>
											<div class="label-rating"><?php echo mysqli_num_rows($result1); ?> orders </div>
										</div> <!-- rating-wrap.// -->
								</figcaption>
								<div class="bottom-wrap">
									<a href="product.php?p=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary float-right">Order Now</a>	
									<div class="price-wrap h5">
										<span class="price-new"><i class="fa fa-rupee"></i> <?php echo money_format($row['price']); ?></span> 
									</div> <!-- price-wrap.// -->
								</div> <!-- bottom-wrap.// -->
							</figure>
						</div>
					<?php
					$i++;
					
					}
				} else {
					echo "<h3>No Products Found.</h3>";
				}
			?>
				<span id="imgNo" data-id="<?php echo $i-1; ?>"></span>
			</div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
	

    
    
    <script>
	var imgNo = $("#imgNo").attr('data-id');
	var slideIndex = [];
	var slideId = [];
	for(var i=1; i <= imgNo ; i++)
	{
		slideIndex.push(1);
		slideId.push("mySlides"+i);
		showDivs(1, i-1);
	}
	
	function plusDivs(n, no) {
	  showDivs(slideIndex[no] += n, no);
	}

	function showDivs(n, no) {
	  var i;
	  var x = document.getElementsByClassName(slideId[no]);
	  if (n > x.length) {slideIndex[no] = 1}
	  if (n < 1) {slideIndex[no] = x.length}
	  for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	  }
	  x[slideIndex[no]-1].style.display = "block";  
	}
	
	
    </script>
	
	

</body>
</html>
