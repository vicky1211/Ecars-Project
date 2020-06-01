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
		.gallery-wrap .img-big-wrap img {
			height: 450px;
			width: auto;
			display: inline-block;
			cursor: zoom-in;
		}


		.gallery-wrap .img-small-wrap .item-gallery {
			width: 60px;
			height: 60px;
			border: 1px solid #ddd;
			margin: 7px 2px;
			display: inline-block;
			overflow: hidden;
		}

		.gallery-wrap .img-small-wrap {
			text-align: center;
		}
		.gallery-wrap .img-small-wrap img {
			max-width: 100%;
			max-height: 100%;
			object-fit: cover;
			border-radius: 4px;
			cursor: zoom-in;
		}
		.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}



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
</head>
<body>


       <?php include('sidebar.php'); ?>

    <div id="right-panel" class="right-panel">

        <?php include('header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Product</h1>
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

        <div class="content mt-3" style="margin-bottom: 20px;">
			<div class="w3-card w3-white">
			<?php
				$result = mysqli_query($conn, "select * from products where id='".$_GET['p']."'");
				if(mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_assoc($result);
					$result2 = mysqli_query($conn, "SELECT * FROM(SELECT * FROM search where userId = '".$_SESSION['uid']."'   ORDER BY id DESC LIMIT 3 ) id where productId = '".$row['id']."'  ORDER BY id ASC");
					
					if(mysqli_num_rows($result2) == 1)
					{
						//mysqli_query($conn, "update search set ");
					}
					else
					{
						mysqli_query($conn, "insert into search (keyword, productId, userId) values('".$row['pName']."','".$row['id']."', '".$_SESSION['uid']."' )");
					}
			?>
				<div class="row">
					<div class="col-sm-5 " style="height:320px; margin-top:60px;">
						<article class="gallery-wrap" style="padding:20px; height:90%;"> 
						<?php
							$result1 = mysqli_query($conn, "select * from productimg where productId='".$row['id']."'");
							$i = 0;
							while($row1 = mysqli_fetch_assoc($result1))
							{
						?>
						  <img class="mySlides" src="../admin/<?php echo $row1['url']; ?>" style="max-width:100%; max-height:100%; margin:auto;">
						<?php
							$i++;
							}
						?>
						  
						  <div class="w3-center w3-display-bottommiddle" style="width:100%; padding:20px;">
							<div class="w3-button w3-black w3-display-left" style="margin-left:15px;" onclick="plusDivs(-1)">&#10094;</div>
							<div class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</div>
						<?php 
						for($j=0;$j<$i;$j++)
						{
						?>
							<span class="w3-badge demo w3-border" onclick="currentDiv(<?php echo $j+1; ?>)"></span>
						<?php
						}
						?>
						  </div>
						</article> <!-- gallery-wrap .end// -->
					</div>
					<div class="col-sm-7">
						<article class="card-body p-5">
							<h3 class="title mb-3"><?php echo $row['pName']; ?></h3>

						<p class="price-detail-wrap"> 
							<span class="price h3 text-warning"> 
								<span  class="currency"><i class="fa fa-rupee"></i> </span>
								<span class="num"><?php echo money_format($row['price']); ?></span>
							</span> 
							 
						</p> <!-- price-detail-wrap .// -->
						<dl class="item-property">
						  <dt>Description</dt>
						  <dd><p ><?php echo $row['pDesc']; ?></p></dd>
						</dl>
						

						<hr>
							<div class="row">
								<div class="col-sm-5">
									<dl class="param param-inline">
									  <dt>Quantity: </dt>
									  <dd>
										<select id="quantity" class="form-control form-control-sm" style="width:70px;">
											<option value="1"> 1 </option>
											<option value="2"> 2 </option>
											<option value="3"> 3 </option>
										</select>
									  </dd>
									</dl>  <!-- item-property .// -->
								</div> <!-- col.// -->
								 <!-- col.// -->
							</div> <!-- row.// -->
							<hr>
							<a href="javascript:void(0)"  onclick="buyProduct();" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
						</article> <!-- card-body.// -->
					</div> <!-- col.// -->
				</div> <!-- row.// -->

			    <div class="row ">
				    <div class="col-md-4 border text-center">
				        <div class="card-body">
				        	<?php
				        		$result1 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."'");
				        		$total = 0;
								while($row1 = mysqli_fetch_assoc($result1))
								{
									$total = $total + $row1['rating'];
								}
								$ratingBar = ($total * 100) / (mysqli_num_rows($result1) * 5);
							?>
				            <h1 class="text-danger">
				            	<?php 
				            	if(mysqli_num_rows($result1) == 0)
				            		{
				            			echo '0.0';
				            		}
				            		else
				            		{
				            			echo number_format($total/mysqli_num_rows($result1),1); 
				            		}
				            	?>
				            </h1>
				            <div class="sub-row text-warning" style='margin: 0 0 10px 0;'>
				                <div class="star-ratings-sprite"><span style="width:<?php echo $ratingBar; ?>%" class="star-ratings-sprite-rating"></span></div>
				            </div>
				            <p><?php echo mysqli_num_rows($result1); ?> ratings</p>
				        </div>
				    </div>
				    <div class="col-md-4 border">
				        <div class="card-body">
				            <div class="row">
				                <div class="col-md-3">
				                    <h6>5 Stars</h6>
				                </div>
				                <div class="col-md-7 pt-1">
				                	<?php 
			                    		$result2 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and rating = '5'");
			                    		$ratingBar = (mysqli_num_rows($result2) * 100) / mysqli_num_rows($result1);
			                    	?>
				                    <div class="progress">
				                    	<div class="progress-bar bg-success" style="width:<?php echo $ratingBar; ?>%"></div>
		                            </div>
				                </div>
				                <div class="col-md-2">
				                    <h6>(<?php echo mysqli_num_rows($result2); ?>)</h6>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3">
				                    <h6>4 Stars</h6>
				                </div>
				                <div class="col-md-7 pt-1">
				                	<?php 
			                    		$result2 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and rating = '4'");
			                    		$ratingBar = (mysqli_num_rows($result2) * 100) / mysqli_num_rows($result1);
			                    	?>
				                    <div class="progress">
		                              <div class="progress-bar bg-success" style="width:<?php echo $ratingBar; ?>%"></div>
		                            </div>
				                </div>
				                <div class="col-md-2">
				                     <h6>(<?php echo mysqli_num_rows($result2); ?>)</h6>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3">
				                    <h6>3 Stars</h6>
				                </div>
				                <div class="col-md-7 pt-1">
				                	<?php 
			                    		$result2 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and rating = '3'");
			                    		$ratingBar = (mysqli_num_rows($result2) * 100) / mysqli_num_rows($result1);
			                    	?>
				                    <div class="progress">
		                              <div class="progress-bar bg-warning" style="width:<?php echo $ratingBar; ?>%"></div>
		                            </div>
				                </div>
				                <div class="col-md-2">
				                     <h6>(<?php echo mysqli_num_rows($result2); ?>)</h6>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3">
				                    <h6>2 Stars</h6>
				                </div>
				                <div class="col-md-7 pt-1">
				                	<?php 
			                    		$result2 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and rating = '2'");
			                    		$ratingBar = (mysqli_num_rows($result2) * 100) / mysqli_num_rows($result1);
			                    	?>
				                    <div class="progress">
		                              <div class="progress-bar bg-danger" style="width:<?php echo $ratingBar; ?>%"></div>
		                            </div>
				                </div>
				                <div class="col-md-2">
				                     <h6>(<?php echo mysqli_num_rows($result2); ?>)</h6>
				                </div>
				            </div>
				            <div class="row">
				                <div class="col-md-3">
				                    <h6>1 Star</h6>
				                </div>
				                <div class="col-md-7 pt-1">
				                	<?php 
			                    		$result2 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and rating = '1'");
			                    		$ratingBar = (mysqli_num_rows($result2) * 100) / mysqli_num_rows($result1);
			                    	?>
				                    <div class="progress">
		                              <div class="progress-bar bg-danger" style="width:<?php echo $ratingBar; ?>%"></div>
		                            </div>
				                </div>
				                <div class="col-md-2">
				                     <h6>(<?php echo mysqli_num_rows($result2); ?>)</h6>
				                </div>
				            </div>
				        </div>
				    </div>

				    <div class="col-md-4 border text-center" style="cursor:pointer;" id="writeReview" >
				       <div class="card-body">
				            <a href="javascript:void(0)"><h3>Rate The Product</h3></a>
				            <?php
				            	$result1 = mysqli_query($conn, "select * from rating where productId = '".$_GET['p']."' and userId = '".$_SESSION['uid']."'");
								$row1 = mysqli_fetch_assoc($result1);
								//echo $row1['rating'];
				            ?>
				            <form class="rating">
							  <label>
							    <input type="radio" name="stars" value="1" <?php if($row1['rating'] == 1){ echo "checked";} ?>/>
							    <span class="icon">★</span>
							  </label>
							  <label>
							    <input type="radio" name="stars" value="2" <?php if($row1['rating'] == 2){ echo "checked";} ?>/>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							  </label>
							  <label>
							    <input type="radio" name="stars" value="3" <?php if($row1['rating'] == 3){ echo "checked";} ?>/>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>   
							  </label>
							  <label>
							    <input type="radio" name="stars" value="4"  <?php if($row1['rating'] == 4){ echo "checked";} ?>/>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							  </label>
							  <label>
							    <input type="radio" name="stars" value="5" <?php if($row1['rating'] == 5){ echo "checked";} ?>/>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							    <span class="icon">★</span>
							  </label>
							</form>
					            
				       </div>
				        				        	
				        
					
				    </div>

			    </div>
			<?php
				}
				else
				{
					echo "<div style='padding:10px;'>No Product Found. Please Check Product Id and then Try Again.</div>";
				}
			?>
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
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		  showDivs(slideIndex += n);
		}

		function currentDiv(n) {
		  showDivs(slideIndex = n);
		}

		function showDivs(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("demo");
		  if (n > x.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = x.length}
		  for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";  
		  }
		  for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" w3-grey", "");
		  }
		  x[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " w3-grey";
		}

		var getUrlParameter = function getUrlParameter(sParam) {
		    var sPageURL = window.location.search.substring(1),
		        sURLVariables = sPageURL.split('&'),
		        sParameterName,
		        i;

		    for (i = 0; i < sURLVariables.length; i++) {
		        sParameterName = sURLVariables[i].split('=');

		        if (sParameterName[0] === sParam) {
		            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		        }
		    }
		};

		function buyProduct()
		{
			var quantity = $('#quantity').val();
			var productId = getUrlParameter('p');
			$.ajax({
				url: "buyProduct.php",
				type: 'POST',
				data: {quantity:quantity, productId:productId},
				success: function (data) {
					alert(data);
				}
			});
			
		}

		//function writeReviewForm()
		//{
		//	alert('hi');
		//	$('#writeReview').html("");
		//}

		$(':radio').change(function() {
		 // alert(this.value);
		  var rating = this.value;
		  var productId = getUrlParameter('p');
		  $.ajax({
				url: "updateRating.php",
				type: 'POST',
				data: {rating:rating, productId:productId},
				success: function (data) {
					alert(data);
					location.reload();
				}
			});
		});
	</script>

</body>
</html>
