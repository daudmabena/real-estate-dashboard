$(document).ready(function() {
    $.ajax({
        url: "getJsonFormat",
        type: 'POST',
        data:  {},
        dataType: 'json',
        success: function (json) {
            if(json){
                var obj =eval(json);
                //for(var i=0;i<obj.groupByMonthAndYearForMedian.length;i++){}
                generateChart(obj.groupByMonthAndYearForMedian['monthlytotal'], obj.groupByMonthAndYearForMedian['monthYear']);
                $('.saleMedianZipValue').html("$"+obj.saleMedianZip['lastYear']);
                generateGuage(obj.saleMedianZip['lastYear'], obj.saleMedianCity['lastYear']);
            }
        }
    });
});

function generateChart(monthlyTotal,year){
    $(function () {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'chart-render',
                    type: 'line',
                    marginBottom: 35,
                    backgroundColor: '#363636'
                },
                title: {
                    text: '',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: year
                },
                yAxis: {
                  lineColor: '#ccc',
                  lineWidth: 1,
                    title: {
                        text: ''
                    },
                    labels: {
                        formatter: function() {
                            return '$'+this.value;
                        }
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#F8AE33'
                    }]
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
                plotOptions: {
                line: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    shadow: false,
                    marker:{
                      symbol:'circle',
                          radius:5,
                    states: {
                     hover:{
                      radius:7	
                       }
                     }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: false
                }},
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: [{
                    name: 'Dashboard',
                    data: monthlyTotal,
                    color: '#F8AE33'
                }],
                exporting: {
                    enabled: false
                }
            });
        });
    });
}



// DEMOGAUGE1 - A very basic 'bare-bones' example...
var demoGauge1 = new jGauge(); // Create a new jGauge.
demoGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.


// DEMOGAUGE2 - Using the new binary prefixing...
var demoGauge2 = new jGauge(); // Create a new jGauge.
demoGauge2.id = 'jGaugeDemo2'; // Link the new jGauge to the placeholder DIV.
//demoGauge2.label.suffix = 'B'; // Make the value label bytes.
//demoGauge2.autoPrefix = autoPrefix.binary; // Use binary prefixing (i.e. 1k = 1024).
//demoGauge2.ticks.count = 5;
//demoGauge2.ticks.end = 8;


/*
// DEMOGAUGE3 - This gauge is more complex to show a completely different style and is updated with random values...
var demoGauge3 = new jGauge(); // Create a new jGauge.
demoGauge3.id = 'jGaugeDemo3'; // Link the new jGauge to the placeholder DIV.
demoGauge3.autoPrefix = autoPrefix.si; // Use SI prefixing (i.e. 1k = 1000).
demoGauge3.imagePath = '../img/jgauge_face_taco.png';
demoGauge3.segmentStart = -225
demoGauge3.segmentEnd = 45
demoGauge3.width = 170;
demoGauge3.height = 170;
demoGauge3.needle.imagePath = '../img/jgauge_needle_taco.png';
demoGauge3.needle.xOffset = 0;
demoGauge3.needle.yOffset = 0;
demoGauge3.label.yOffset = 55;
demoGauge3.label.color = '#fff';
demoGauge3.label.precision = 0; // 0 decimals (whole numbers).
demoGauge3.label.suffix = 'W'; // Make the value label watts.
demoGauge3.ticks.labelRadius = 45;
demoGauge3.ticks.labelColor = '#0ce';
demoGauge3.ticks.start = 200;
demoGauge3.ticks.end = 800;
demoGauge3.ticks.count = 7;
demoGauge3.ticks.color = 'rgba(0, 0, 0, 0)';
demoGauge3.range.color = 'rgba(0, 0, 0, 0)';
*/
                
// This function is called by jQuery once the page has finished loading.
function generateGuage(saleMedianZip, saleMedianCity){
    demoGauge1.init(); // Put the jGauge on the page by initializing it.
    demoGauge2.init(); // Put the jGauge on the page by initializing it.
    //demoGauge3.init(); // Put the jGauge on the page by initializing it.
    
    // Configure demoGauge3 for random value updates.
    demoGauge1.setValue(saleMedianZip);
    demoGauge2.setValue(saleMedianCity);
    //setInterval('randVal()', 100);
}

// That's all folks! We've created a jGauge and put it on the page! :-D
// The following JavaScript functions are for the demonstration.
// ----------------------------------------------------------------------

// This is a test function that changes the gauge value.
function setVal(value)
{
    demoGauge1.setValue(value);
    demoGauge2.setValue(value);
}

/*
// This is another test function that changes the gauge value.
function bumpVal(value)
{
    demoGauge1.setValue(demoGauge1.value + value);
    demoGauge2.setValue(demoGauge2.value + value);
}
*/

// This is a test function that changes the number of ticks.
function setTickCount(value)
{
    demoGauge1.ticks.count = value;
    demoGauge1.updateTicks();
    
    demoGauge2.ticks.count = value;
    demoGauge2.updateTicks();
}

// This is a test function that changes the range styling.
function setRange(radius, thickness, start, end, color)
{
    demoGauge1.range.radius = radius;
    demoGauge1.range.thickness = thickness;
    demoGauge1.range.start = start;
    demoGauge1.range.end = end;
    demoGauge1.range.color = color;
    demoGauge1.updateRange();
    
    demoGauge2.range.radius = radius;
    demoGauge2.range.thickness = thickness;
    demoGauge2.range.start = start;
    demoGauge2.range.end = end;
    demoGauge2.range.color = color;
    demoGauge2.updateRange();
}

// This is our random value function for gauge 3.
function randVal()
{
        var newValue;
        
        if (Math.random() > 0.8) // Allow needle to randomly pause.
        {
                newValue = demoGauge1.value + (Math.random() * 10000 - 5000);
                
                if (newValue >= demoGauge1.ticks.start && newValue <= demoGauge1.ticks.end)
                {
                        // newValue is within range, so update.
                        demoGauge1.setValue(newValue);
                }
        }
}


