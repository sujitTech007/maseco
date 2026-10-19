window.onload = function () {
	// Pie Chart (growthContainer)
	var chart = new CanvasJS.Chart("chartContainer2", {
		animationEnabled: true,
		title:{
			text: "Registerd Users"
		},
		axisY :{
			includeZero: false,
			prefix: ""
		},
		toolTip: {
			shared: true
		},
		legend: {
			fontSize: 13
		},
		data: [
			{
			  type: "splineArea",
			  showInLegend: true,
			  name: "Buyers",
			  yValueFormatString: "#,##0",
			  xValueFormatString: "MMM YYYY",
			  dataPoints: [
				{ x: new Date(2025, 0), y: 30000 }, // Jan
				{ x: new Date(2025, 1), y: 35000 }, // Feb
				{ x: new Date(2025, 2), y: 30000 }, // Mar
				{ x: new Date(2025, 3), y: 30400 }  // Apr
			  ]
			},
			{
			  type: "splineArea", 
			  showInLegend: true,
			  name: "Sellers",
			  yValueFormatString: "#,##0",
			  dataPoints: [
				{ x: new Date(2025, 0), y: 20100 }, // Jan (added, based on your request)
				{ x: new Date(2025, 1), y: 16000 }, // Feb
				{ x: new Date(2025, 2), y: 14000 }, // Mar
				{ x: new Date(2025, 3), y: 18000 }  // Apr
			  ]
			}
		  ]
		  
	});
	chart.render();
	

	// Bar Chart (chartContainer)
   
        var chart = new CanvasJS.Chart("chartContainer",
        {
            
         
          data: [
    
          {
            dataPoints: [
				{ x: 1, y: 297571, label: "Jan", color: "#f5a623", }, // Golden Yellow
                { x: 2, y: 267017, label: "Feb", color: "#f76b1c" }, // Orange
                { x: 3, y: 175200, label: "Mar", color: "#d94a8c" }, // Magenta-Pink
                { x: 4, y: 154580, label: "Apr", color: "#8e44ad" }  // Purple
           
            ]
          }
          ]
        });
    
        chart.render();
      }

