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

</head>
<body>


       <?php include('sidebar.php'); ?>

    <div id="right-panel" class="right-panel">

        <?php include('header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Admin Dashboard</h1>
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
                <div class="col-md-6">
                    <?php
                        $result = mysqli_query($conn,"SELECT productId,userId,quantity, count(*) FROM myorders GROUP BY productId order by count(*) DESC limit 5");
                         $orders = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                             $result1 = mysqli_query($conn,"SELECT pName from products where id ='".$row['productId']."'");
                             $row1 = mysqli_fetch_assoc($result1);

                            $orders[$row1['pName'].''] = $row['count(*)'];
                        }
                        //print_r($orders);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Most Sold Products</h4>
                            <div class="flot-container">
                                <div id="flotBar" ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                        $result = mysqli_query($conn,"SELECT productId, keyword, count(*) FROM search GROUP BY productId order by count(*) DESC limit 5");
                         $search = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $search[$row['keyword'].''] = $row['count(*)'];
                        }
                        //print_r($orders);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Most Viewed / Searched  Products</h4>
                            <div class="flot-container">
                                <div id="flotBarA" class="flot-container" ></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6" id='takeHeight'>
                     <?php
                        $review = array();
                        $newreview = array();
                        $result = mysqli_query($conn,"SELECT distinct productId FROM rating ");
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                             /*$result1 = mysqli_query($conn,"SELECT pName from products where id ='".$row['productId']."'");
                             $row1 = mysqli_fetch_assoc($result1);

                            $review[$row1['pName'].''] = $row['count(*)'];
                            $result1 = mysqli_query($conn,"SELECT * from rating where productId ='".$row['productId']."' ");
                            while($row1 = mysqli_fetch_assoc($result1))
                            {
                                print_r($row1);
                                echo "<br>";
                            }*/
                            $result1 = mysqli_query($conn, "select * from rating where productId = '".$row['productId']."'");
                                $total = 0;
                                while($row1 = mysqli_fetch_assoc($result1))
                                {
                                    $total = $total + $row1['rating'];
                                }
                                //echo $row['productId']." ".number_format($total/mysqli_num_rows($result1),1)."<br> ";
                                $result2 = mysqli_query($conn,"SELECT pName from products where id ='".$row['productId']."'");
                                 $row2 = mysqli_fetch_assoc($result2);

                                $review[$row2['pName'].''] = number_format($total/mysqli_num_rows($result1),1);
                        }
                        
                        arsort($review);
                        $kahitari = 0;
                        foreach ($review as $key => $value) {
                            if($kahitari < 5)
                            {
                                $newreview[$key.''] = $value;
                                $kahitari++;
                            }
                            else
                            {
                                echo $kahitari;
                                break;
                            }

                        }
                        //print_r($newreview);
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Highest Rated Products</h4>
                            <div class="flot-container">
                                <div id="flot-pie" class="flot-pie-container"></div>

                            </div>
                            <div id="piechartLegend"></div>
                        </div>
                    </div><!-- /# card -->
                </div>


                <div class="col-md-6">
                    <?php
                        $result = mysqli_query($conn,"SELECT productId, count(*) FROM rating GROUP BY productId order by count(*) DESC limit 5");
                        $searchMain = array();
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $result1 = mysqli_query($conn,"SELECT rating, count(*) FROM rating where productId = '".$row['productId']."' GROUP BY rating order by rating ASC ");
                            $search1 = array();
                            while ($row1 = mysqli_fetch_assoc($result1)) 
                            {
                                //echo $row['productId']." ";
                                //print_r($row1);
                                //echo "<br>";
                                $search1[$row1['rating'].''] = $row1['count(*)'];
                            }
                             
                            $result2 = mysqli_query($conn, "select pName from products where id = '".$row['productId']."'");
                            $row2 = mysqli_fetch_assoc($result2);
                            $searchMain[$row2['pName'].''] = $search1;
                            //array_push($searchMain, var);
                            //$search[$row['keyword'].''] = $row['count(*)'];
                        }
                        //print_r($searchMain);
                                //echo "<br>";
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Most Reviewed Products </h4>
                            <canvas id="sales-chart"></canvas>
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
            </div>


          


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

     <!--  chart js -->
    <script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>

    <!--  flot-chart js -->
    <script src="../assets/js/lib/flot-chart/excanvas.min.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.pie.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.time.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.stack.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.resize.js"></script>
    <script src="../assets/js/lib/flot-chart/jquery.flot.crosshair.js"></script>
    <script src="../assets/js/lib/flot-chart/curvedLines.js"></script>
    <script src="../assets/js/lib/flot-chart/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <!--script src="../assets/js/lib/flot-chart/flot-chart-init.js"></script-->
    
   
    <script>
       /* var ctx = document.getElementById( "barChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                   /* foreach ($orders as $key => $value) {
                        
                        if (next($orders) === false) 
                        {
                            echo "'".$key."'";
                        }
                        else
                        {
                            echo "'".$key."',";
                        }
                        
                    }*/
                ?>
             ],
            datasets: [
                {
                    label: "My First dataset",
                    data: [ 
                    <?php
                        
                       /* foreach ($orders as $key => $value) {
                            if (next($orders) === false) 
                            {
                                echo "'".$value."'";
                            }
                            else
                            {
                                echo "'".$value."',";
                            }
                                
                        }*/
                    ?>

                     ],
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ],
                                xAxes: [{
                //type: 'linear',
                //position: 'bottom'
            }]


            }
        }
    } );*/
    (function($){

 "use strict"; // Start of use strict

 var SufeeAdmin = {

  barFlot: function(){
        

        // second chart
         var data = [
                    <?php
                        $i = 0;
                        foreach ($orders as $key => $value) 
                        {
                            if (next($orders) === false) 
                            {
                                echo "[".$i.",".$value."]";
                            }
                            else
                            {
                                echo "[".$i.",".$value."],";
                            }
                        $i++;  
                        }
                    ?>
         ];
        var dataset = [{ data: data, color: "#5482FF" }];
        var ticks = [
                    <?php
                         $i = 0;
                       foreach ($orders as $key => $value) 
                       {
                       
                            if (next($orders) === false) 
                            {
                                echo "[".$i.",\"".$key."\"]";
                            }
                            else
                            {
                                echo "[".$i.",\"".$key."\"],";
                            }
                         $i++;  
                        }
                    ?>
        ];
 
        var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.5
            },
            xaxis: {
                axisLabel: "World Cities",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks
            },
            yaxis: {
                axisLabel: "Average Temperature",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };
        $.plot( $( "#flotBar" ),  dataset , options );

    },



    barFlotA: function(){
        

        // second chart
         var data = [
                    <?php
                        $i = 0;
                        foreach ($search as $key => $value) 
                        {
                            if (next($search) === false) 
                            {
                                echo "[".$i.",".$value."]";
                            }
                            else
                            {
                                echo "[".$i.",".$value."],";
                            }
                        $i++;  
                        }
                    ?>
         ];
        var dataset = [{ data: data, color: "#5482FF" }];
        var ticks = [
                    <?php
                         $i = 0;
                       foreach ($search as $key => $value) 
                       {
                       
                            if (next($search) === false) 
                            {
                                echo "[".$i.",\"".$key."\"]";
                            }
                            else
                            {
                                echo "[".$i.",\"".$key."\"],";
                            }
                         $i++;  
                        }
                    ?>
        ];
 
        var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.5
            },
            xaxis: {
                axisLabel: "World Cities",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks
            },
            yaxis: {
                axisLabel: "Average Temperature",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };
        $.plot( $( "#flotBarA" ),  dataset , options );

    },


    pieFlot: function(){

        var data = [

                <?php
                        //$i = 0;
                        foreach ($newreview as $key => $value) 
                        {
                            if (next($newreview) === false) 
                            {
                                echo "{ label: \"".$key."\", data: ".$value." }";
                            }
                            else
                            {
                                echo "{ label: \"".$key."\", data: ".$value." },";
                            }
                       // $i++;  
                        }
                    ?>
            /*{
                label: "Primary",
                data: 10
            },
            {
                label: "Success",
                data: 3
            },
            {
                label: "Danger",
                data: 9
            },
            {
                label: "Warning",
                data: 20
            }*/
        ];

        var plotObj = $.plot( $( "#flot-pie" ), data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: false,

                    }
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: {
                show: true,
                content: "%s: %n", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
            legend: {
                container: $("#piechartLegend")

            }
        } );
    }
};

$(document).ready(function() {
    
    SufeeAdmin.barFlot();

    SufeeAdmin.pieFlot();
    SufeeAdmin.barFlotA();
    
});

})(jQuery);

var ctx = document.getElementById( "sales-chart" );
    ctx.height = 250  ;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ "0", "1", "2", "3", "4", "5" ],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [ 
                    <?php
                        $i = 0;
                        foreach ($searchMain as $keyMain => $valueMain) {
                          $print =    '{
                        label: "'.$keyMain.'",
                        data: [ 0,' ; 
                            foreach ($valueMain as $key => $value) {
                                if($key == 1)
                                {
                                    $print .= $value.',';
                                }
                                else 
                                {
                                    $print .= ' 0,';
                                }

                                if($key == 2)
                                {
                                    $print .= $value.',';
                                }
                                else 
                                {
                                    $print .= ' 0,';
                                }

                                if($key == 3)
                                {
                                    $print .= $value.',';
                                }
                                else 
                                {
                                    $print .= ' 0,';
                                }

                                if($key == 4)
                                {
                                    $print .= $value.',';
                                }
                                else 
                                {
                                    $print .= ' 0,';
                                }

                                if($key == 5)
                                {
                                    $print .= $value.',';
                                }
                                else 
                                {
                                    $print .= ' 0,';
                                }

                                
                                
                             } 
                        $print .= "],
                        backgroundColor: 'transparent',
                        borderColor: '";

                                if($i == 0)
                                {
                                    $print .= "rgb(57,106,177)";
                                }

                                if($i == 1)
                                {
                                    $print .= "rgb(218,214,48)";
                                }

                                if($i == 2)
                                {
                                    $print .= "rgb(62,150,81)";
                                }

                                if($i == 3)
                                {
                                    $print .= "rgb(240,37,41)";
                                }

                                if($i == 4)
                                {
                                    $print .= "rgb(107,76,154)";
                                }

                                

                        $print .="',
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: '";

                                if($i == 0)
                                {
                                    $print .= "rgb(57,106,177)";
                                }

                                if($i == 1)
                                {
                                    $print .= "rgb(218,214,48)";
                                }

                                if($i == 2)
                                {
                                    $print .= "rgb(62,150,81)";
                                }

                                if($i == 3)
                                {
                                    $print .= "rgb(240,37,41)";
                                }

                                if($i == 4)
                                {
                                    $print .= "rgb(107,76,154)";
                                }

                                

                        $print .="',
                            },";
                            echo $print;
                            $i++;
                        }

                    ?>
            /*{
                label: "Foods",
                data: [ 0, 30, 10, 120, 50, 63, 10 ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(220,53,69,0.75)',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(220,53,69,0.75)',
                    }, {
                label: "Electronics",
                data: [ 0, 50, 40, 80, 40, 79, 120 ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(40,167,69,0.75)',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                    }, {
                label: "Electronics",
                data: [ 0, 20, 60, 50, 40, 60, 120 ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(40,167,69,0.75)',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                    }, {
                label: "Electronics",
                data: [ 0, 30, 20, 60, 90, 60, 30 ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(40,167,69,0.75)',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                    }, {
                label: "Electronics",
                data: [ 0, 50, 40, 80, 40, 79, 120 ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(40,167,69,0.75)',
                borderWidth: 3,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                    }*/

                     ]
        },
        options: {
            responsive: true,

            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },
            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                        } ]
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    } );

    </script>

</body>
</html>
