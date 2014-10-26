

var hell;
window.onload = function() {

	function linechart(data){
	graph=[];
	data=JSON.parse(data);
	for(i=0;i<data.length;i++)
	{
		graph.push({"label":'Post '+i,"value":data[i]});
	}
	FusionCharts.ready(function(){
			    var revenueChart = new FusionCharts({
			        "type": "line",
			        "renderAt": "charts",
			        "width": "400",
			        "height": "350",
			        "dataFormat": "json",
			        "dataSource":  {
			          "chart": {
			            "caption": "Facebook",
			            "subCaption": "Popularity of your Post",
			            "xAxisName": "Posts",
			            "yAxisName": "Hits",
			            "theme": "fint"
			         },
			         "data": graph
			      }

			  });
		revenueChart.render();

		});
}
	
	$('#statsbutt').on('click',function(){
		$('.top').css({"top":"-400px"}).css({"-webkit-transition":"all 0.5s","transition":"all 0.5s"});
		$('.bott').css({"top":"0px"}).css({"-webkit-transition":"all 0.5s","transition":"all 0.5s"});
		$.post("https://localhost/Ghost_Post/charts.php?userid="+uid,function(data){
				console.log(data);
				linechart(data);
		});

	});
	$('#poost').on('click',function(){
		$('.top').css({"top":"0px"}).css({"-webkit-transition":"all 0.5s","transition":"all 0.5s"});
		$('.bott').css({"top":"400px"}).css({"-webkit-transition":"all 0.5s","transition":"all 0.5s"});
	});


	
	$('#postcontainer').css({"display":"none"});
		

	
}