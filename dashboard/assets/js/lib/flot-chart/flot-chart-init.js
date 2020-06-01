
(function($){

 "use strict"; // Start of use strict

 var SufeeAdmin = {

  barFlot: function(){
        

        // second chart
         var data = [[0, 11],[1, 15],[2, 25],[3, 24],[4, 13],[5, 18]];
        var dataset = [{ label: "2012 Average Temperature", data: data, color: "#5482FF" }];
        var ticks = [[0, "London test data data data data"], [1, "New York"], [2, "New Delhi"], [3, "Taipei"],[4, "Beijing"], [5, "Sydney"]];
 
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

    }
};

$(document).ready(function() {
    
    SufeeAdmin.barFlot();
    
});

})(jQuery);
