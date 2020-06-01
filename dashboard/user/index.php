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
    <title>User Dashboard | ECARS</title>
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


       <?php include('sidebar.php'); ?>

    <div id="right-panel" class="right-panel">

        <?php include('header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Your Orders</h1>
                    </div>
                </div>
            </div>
            <!--div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">User Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div-->
        </div>

        <div class="content mt-3">
			<div class="row">
                <div class="col-md-9">
                    <?php
                        $result = mysqli_query($conn,"select * from myorders where userId = '".$_SESSION['uid']."'");
                        while($row = mysqli_fetch_assoc($result))
                        {

                            $result1 = mysqli_query($conn, "select * from products where id='".$row['productId']."'");
                            $row1 = mysqli_fetch_assoc($result1);
                        
                    ?>
                    <div class="w3-card" style="margin-bottom: 15px;">
                        <header class="w3-container " style="background-color: #d9d9d9; color: #595959">
                            <div class="row">
                                <div class="col-6 ">
                                    <h6 style="text-transform: uppercase;">Order Placed</h6>
                                    <h6><?php echo date("d F Y", strtotime($row['date'])); ?></h6>
                                </div>
                                <div class="col-6 ">
                                    <h6 style="text-transform: uppercase;">Total</h6>
                                    <h6><i class="fa fa-rupee"></i> <?php echo money_format($row1['price']*$row['quantity']); ?></h6>
                                </div>
                            </div>
                        </header>
                        <div class="w3-container w3-white" >
                            <div class="row" >
                                <div class="col-md-3" style="">
                                    <?php 
                                        $result2 =  mysqli_query($conn, "select * from productimg where productId='".$row['productId']."'");
                                        $row2 = mysqli_fetch_assoc($result2);
                                    ?>
                                    <div style="margin: auto; height: 119px; width: fit-content;"><img style="max-width: 100%; max-height: 100%; " src="../admin/<?php echo $row2['url']; ?>"></div>
                                </div>
                                <div class="col-md-9" style="margin-bottom: 15px;">
                                    <h5 style="color:blue;"><?php echo $row1['pName'] ?></h5>
                                    <h6><i class="fa fa-rupee"></i> <?php echo money_format($row1['price']); ?></h6>
                                    <a class="btn btn-primary" href="product.php?p=<?php echo $row1['id']; ?>" style="color: white;">Buy it again</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
             </div>


          


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
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

</body>
</html>
