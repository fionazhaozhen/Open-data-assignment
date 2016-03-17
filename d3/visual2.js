var projectset=new Array();
var contentset=new Array();
var lifeset=new Array();
var domainset=new Array();
var sumset=new Array();
var pro_index=0;
var h=20;

//In this file, bar chart and pie chart need to be implemented

/*--added for bar chart--*/
//define the size of canvas
var margin = {top: 20, right: 20, bottom: 30, left: 80};
var width = 960 - margin.left - margin.right;
var height = 570 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");
    //.ticks(10, "%");

//tips of bar, can display when mouse move on the bar
var tip=d3.tip()
.attr("class","d3-tip")
.offset([-10,0])
.html(function(d){
	return "<strong>Agency: </strong><span style='color:white'>"+ d.values.agency_name+"</span><br/><strong>Total Actual Cost:</strong> <span style='color:white'>" + d.values.total_cost.toFixed(2) + "($ M)</span>";
})
//
var circletip=d3.tip()
.attr("class", "d3-tip")
.offset([-10,0])
.html(function(d){
	return "<strong>Agency: </strong>"
})
//drawing bar
var barsvg=d3.select("#visual1")
.append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + 0 + "," + margin.top + ")");

barsvg.call(tip); //bindle tips

//get data from csv file
d3.csv("data/Assignment1.csv", function(error, data){
	if(error)//failed to access data
	{
		console.log(error);
	}
	else//can access successfully
	{
		//data processing to the format *should be improved by using nested_data later
		for(var i=0;i<data.length;i++)
		{
			contentset[i]=new Array();
			contentset[i][0]=data[i].Agency_Code;
			contentset[i][1]=data[i].Project_Name+" [Project ID: "+data[i].Project_ID+"]";
			contentset[i][2]=data[i].Actual_Cost;
		}
		for(var i=1,j=1;i<contentset.length;i++)
		{
			if(i==1 && pro_index==0)
			{
				projectset[0]=new Array();
				lifeset[0]=new Array();
				projectset[0][0]=contentset[0][1];
				lifeset[0][0]=contentset[0][2];
			}

			if(contentset[i-1][0]==contentset[i][0] && (contentset.length!=1))
			{
				projectset[pro_index][j]=contentset[i][1];
				lifeset[pro_index][j]=contentset[i][2];
				j++;
			}
			else
			{
				++pro_index;
				j=1;
				projectset[pro_index]=new Array();
				lifeset[pro_index]=new Array();
				projectset[pro_index][0]=contentset[i][1];
				lifeset[pro_index][0]=contentset[i][2];
			}
		}
		pro_index=0;
		
		for(var i=0;i<projectset.length;i++)
		{
			domainset[i]=new Array();
			for(var j=0;j<7;j++)
			{
				domainset[i][j]=projectset[i][j];
			}
			sumset[i]=0;
			for(var k=0;k<projectset[i].length-1;k++)
			{
				sumset[i]=parseFloat(lifeset[i][k])+sumset[i];
			}
		}
		var nested_data=d3.nest()
		.key(function(d){return d.Agency_Code;}) 
		.rollup(function(leaves){
			return {
				"total_cost": d3.sum(leaves, function (d){return parseFloat(d["Actual_Cost"]);}),
				"agency_name": leaves.map(function (d){return d["Agency"];})[0]
			} 
		})
		.entries(data);

		console.log(nested_data);	//print data	

		var svg=d3.select("#visual2")
		.append("svg")
		.append("g")

		svg.append("g")
		.attr("class","slices");
		svg.append("g")
		.attr("class","labels")
		.attr("transform", "translate(" + -270 + "," + 250 + ")");
		/**************************************************/
		svg.call(circletip);
		
		var code_index=nested_data.map(function(d){return d.key;});
		//set x asix -> agency number, y axis ->Total actual cost of angencies
		 x.domain(nested_data.map(function(d){return d.key;}));
		 y.domain([0,d3.max(nested_data, function(d){return d.values.total_cost;})]);
		 
		 //append x axis
		 barsvg.append("g")
		 .attr("class","x axis")
		 .attr("transform", "translate(0," + height + ")")
		 .call(xAxis);

		  //append y axis
		barsvg.append("g")
	      .attr("class", "y axis")
	      .call(yAxis)
	    .append("text")
	      .attr("transform", "rotate(-90)")
	      .attr("y", 6)
	      .attr("dy", ".71em")
	      .style("text-anchor", "end")
	      .text("Total Actual Cost");

		//bundle data, set x, y axis value
		barsvg.selectAll(".bar")
		  .data(nested_data)
		.enter().append("rect")
		  .attr("class", "bar")
		  .attr("x", function(d){return x(d.key);})
		  .attr("width", x.rangeBand())
		  .attr("y", function(d){return y(d.values.total_cost);})
		  .attr("height", function(d) { return height - y(d.values.total_cost); })
		  .on('mouseout', tip.hide)
		  
		  .on("mouseover", function(d){ //call mouse over function
		  	for(var i=0;i<code_index.length;i++)
		  	{
		  		if(code_index[i]==d.key)
		  		{
		  			pro_index=i;
		  			break;
		  		}
		  	}
			changeCircle(randomData());
			tip.show(d); //display tip
		  });

	  	d3.select("input").on("change",change);

	  	//the animation to sort bars from low value of agency cost to high cost
	  	var sortTimeout=setTimeout(function (){
	  		d3.select("input").property("checked", true).each(change);
	  	}, 2000);
	  	function change()
	  	{
	  		clearTimeout(sortTimeout);
	  		//sorting algorithm
	  		var x0=x.domain(nested_data.sort(this.checked 
	  			? function (a,b) {return b.values.total_cost - a.values.total_cost;}
	  			: function (a,b) {return d3.ascending(a.key, b.key);})
	  			.map(function (d) {return d.key;})).copy();
  			var transition =barsvg.transition().duration(750),
  				delay=function(d,i){return i*50;};
			transition.selectAll(".bar")
	        .delay(delay)
	        .attr("x", function(d) { return x0(d.key); });

	    transition.select(".x.axis")
	        .call(xAxis)
	      .selectAll("g")
	        .delay(delay);
	  	}

		//drawing pie chart
		var width2=450,
		height2=450,
		radius=Math.min(width2,height2)/2;
		var pie=d3.layout.pie()
		.sort(null)
		.value(function(d)
		{
			return d.value;
		});
		var arc=d3.svg.arc()
		.outerRadius(radius*0.8)
		.innerRadius(radius * 0.4);

		var outerArc = d3.svg.arc()
			.innerRadius(radius * 0.9)
			.outerRadius(radius * 0.9);

		svg.attr("transform", "translate(" + width2 / 2 + "," + height2 / 2 + ")");

		 //the index of contentset
		var key=function(d){
			return d.data.label;
		}
		var color;
		color=d3.scale.ordinal()
			.range(["#f80096","#ff6600", "#fcbd00", "#8dbb01", "#00bada","#0d66aa","#8f039d"]);
		var x_index=0;
		function randomData(){
			color.domain(domainset[pro_index]);
			var labels=color.domain();
			return labels.map(function(label){        							
				for(var i=0;i<domainset[pro_index].length;i++)
				{

					if(domainset[pro_index][i].toString()==label.toString())
					{
						x_index=i;
						break;
					}
				}
				return {label: label, value: lifeset[pro_index][x_index]}
			});
		}
		
		changeCircle(randomData());

		function labelchange(){
			var table = svg.select(".tables").data(pie(data)).enter().append("g");
    
	        // create one row per segment.
	        var tr = table.append("tr");
	            
	        // create the first column for each segment.
	        tr.append("td").attr("width", '20').attr("height", '20').append("button")
	            .attr("width", 20)
	            .attr("height", 20)
	            .style("background-color", function(d){ return color(d.data.label); })
	            .text("qncisnc")
	            .style("color", function(d){ return color(d.data.label); });
				//.attr("fill",function(d){ return color(d.data.label); });
	            
	        // create the second column for each segment.
	        tr.append("td")
	        .text(function (d){ return d.data.label;});
		}

		function changeCircle(data) {

			/* ------- PIE SLICES -------*/
			var slice = svg.select(".slices").selectAll("path.slice")
				.data(pie(data), key);

			slice.enter()
				.insert("path")
				.style("fill", function(d) { return color(d.data.label); })
				.attr("class", "slice");


			slice.transition().duration(1000)
			.attrTween("d", function(d) {
				this._current = this._current || d;
				var interpolate = d3.interpolate(this._current, d);
				this._current = interpolate(0);
				return function(t) {
					return arc(interpolate(t));
				};
			})
			slice.exit()
			.remove();

			/* ------- TEXT LABELS -------*/
			var text = svg.selectAll(".labels").selectAll("text")
				.data(pie(data), key);
			//h=h+20;
			text.enter()
			.append("rect")
			.attr("width",18)
			.attr("height",18)
			.attr("y", function (d,i){return i*23;})
			.style("fill", function (d){return color(d.data.label);});
			text.enter()
			.append("text")
			.attr("y",function(d, i){return i*23+13;})
			.attr("x",function(d, i){return 30;})
			.text(function(d) {
				return d.data.label;
			});

			text.exit()
			.remove();
		};
	}
});