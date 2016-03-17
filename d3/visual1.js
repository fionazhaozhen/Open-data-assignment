var data, csvData;
var svg;

initCSVData();

//the function of drawing Scatter / Bubble Chart
function initCanva(d)
{
	var data = JSON.parse(JSON.stringify(d));
    nv.addGraph(function () {
        var chart = nv.models.scatterChart()
            .x(function (d) {
                return parseInt(d.key);
            })
            .y(function (d) {
                return d.values.total_cost;
            })
            .size(function (d,i){
            	return i*2;
            })
            .margin({left: 100}) 
            //.color(d3.scale.category40().range())
            //.useInteractiveGuideline(false)
        ;

        chart.xAxis
            .axisLabel("Years")
            ;
        
        chart.yAxis
            .axisLabel("Annual Acutal Cost ($M)")
            .tickFormat(d3.format('.0f'));
            
        chart.options({
            showControls: false,
        });

        d3.select('#pageContent svg')
            .datum(data)
            .call(chart);

        nv.utils.windowResize(chart.update);

        return chart;
    });
}
//get data from csv file
function initCSVData() 
{
	data=new Array();
	d3.csv("data/Assignment1.csv", processData);
}

//data saving format process -> json type 

function processData(c) 
{
	csvData =c;
	for (var i = 0; i < csvData.length; i++) {
        var e = csvData[i];
        if (isValid([
            e["Agency"],
            e["Start_Date"],
            e["Planned_Cost"],
            e["Actual_Cost"]
        ])) {
            var format = d3.time.format("%Y-%m-%d");
            e["Start_Date"] = format.parse(e["Start_Date"].split("T")[0]);
            data.push(e);
            //console.log(e); print the format of data
        }
    }
	var nested_data=d3.nest()
		.key(function (c){
			return c.Agency; 
		})
        //angency activities in different years
		.key(function (c){
			return c.Start_Date.getFullYear(); 
		})
		.rollup(function (leaves){
			return {
                //total cost of some angency in some year
				"total_cost": d3.sum(leaves, function (d){
					return parseFloat(d["Actual_Cost"]);
				}),
                //total planned cost of some angency in some year
				"total_planned": d3.sum(leaves, function (d){
					return parseFloat(d["Planned_Cost"]);
				})
			}
		})
		.entries(data);
	for(var key in nested_data){
        // x axis -> years
		var x=nested_data[key];
		for(var key2 in x.values){
            //y axis -> total variance
			var y=x.values[key2].values;
			y["total_variance"]=y["total_cost"]/y["total_planned"];
		}
	}
	for (var key in nested_data) {
        nested_data[key].values.sort(function (a,b){
            return parseInt(b.key)-parseInt(a.key);
        });
    }
    initCanva(nested_data);
}

function isValid(arr) {
    for (var i = 0; i < arr.length; i++) {
        var e = arr[i];
        if (e == "" || e == "0" || e == undefined) {
            return false;
        }
    }
    return true;
}
