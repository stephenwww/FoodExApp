$(document).ready(function() {
	
    get_order_charts(); 
    get_income_charts();


    $("#order-num-chart-type").click(function(){
    	get_order_charts();
    });

    $("#income-chart-type").click(function(){
        get_income_charts();
    })
});



function get_income_charts(){
    var type = $('#income-chart-type option:selected').attr("value");
	var res_id = $("#hiden-res-id").attr('value');
	$.get( "../order/restaurant-income/"+type+"/"+res_id, function( data ) {
//        alert(data);
        if (type == "day"){
            var title = "Daily Income Report (within 30 days)";
        } else if (type == "week"){
            var title = "Weekly Income Report (within a year)";
        } else {
            var title = "Monthly Income Report (within two years)";
        }
        show_order_bar_charts("incomechartdiv",data,title, type);
	});
}


function get_order_charts(){
    var type = $('#order-num-chart-type option:selected').attr("value");
	var res_id = $("#hiden-res-id").attr('value');
	$.get( "../order/restaurant-orders/"+type+"/"+res_id, function( data ) {
//        alert(data);        
		if (type == "day"){
	  		var title = "Daily Order Number Report (within 30 days)";
	  	} else if (type == "week"){
	  		var title = "Weekly Order Number Report (within a year)";
	  	} else {
	  		var title = "Monthly Order Number Report (within two years)";
	  	}
	  	show_order_line_charts("orderchartdiv", data, title, type);
	});
}

/* based on the amchart docs */
function show_order_bar_charts(div_id, data, title, type) {
    if (type == "day"){
        minPeriod = "DD";
    } else if (type == "week"){
        minPeriod = "WW";
    } else {
        minPeriod = "MM";
    }
    var chart = AmCharts.makeChart(div_id, {
        "type": "serial",
        "theme": "none",
        "dataProvider": data,
        "valueAxes": [{
            "gridColor":"#FFFFFF",
    		"gridAlpha": 0.2,
    		"dashLength": 0
        }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "income"		
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "dataDateFormat": "YYYY-MM-DD",
        "categoryField": "time",
        "categoryAxis": {
            "parseDates": true,
            "minPeriod" : minPeriod
        },
    	"exportConfig":{
    	  "menuTop": 0,
    	  "menuItems": [{
          "icon": '/lib/3/images/export.png',
          "format": 'png'	  
          }]  
    	},
    	"titles": [{
    		"size": 25,
    		"text": title
    	}]
    });
}

function show_order_line_charts(div_id, data, title, type) {
    if (type == "day"){
        minPeriod = "DD";
    } else if (type == "week"){
        minPeriod = "WW";
    } else {
        minPeriod = "MM";
    }
	AmCharts.makeChart( div_id, {
	    "type": "serial",
	    "theme": "none",
	    "pathToImages": "../js/amcharts/images/",
	    "dataProvider": data,
	    "valueAxes": [{
	        "logarithmic": true,
	        "dashLength": 1,
	        "guides": [{
	            "dashLength": 6,
	            "inside": true,
	            "label": "average",
	            "lineAlpha": 1,
	            "value": 90.4
	        }],
	        "position": "left"
	    }],
	    "graphs": [{
	        "bullet": "round",
	        "id": "g1",
	        "bulletBorderAlpha": 1,
	        "bulletColor": "#FFFFFF",
	        "bulletSize": 7,
	        "lineThickness": 2,
	        "title": "Number of Orders",
	        "type": "smoothedLine",
	        "useLineColorForBulletBorder": true,
	        "valueField": "order_num"
	    }],
	    "chartScrollbar": {},
	    "chartCursor": {
	        "cursorPosition": "mouse"
	    },
	    "dataDateFormat": "YYYY-MM-DD",
	    "categoryField": "time",
	    "categoryAxis": {
	        "parseDates": true,
            "minPeriod" : minPeriod
	    },
	    "titles": [
		{
			"size": 25,
			"text": title
		}]
	});
}