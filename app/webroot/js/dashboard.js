$(document).ready(function() {
  jQuery(document).ajaxStart(function(){
        $('#initialContainerMask').show();
        $('#loader').show();
    });
    jQuery(document).ajaxStop(function(){
        $('#loader').hide();
        $('#initialContainerMask').hide();
    });    
});

var MinRange,MaxRange,MinRange1,MaxRange1,urldata;

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}



function getSearchData(urldata){
    $(document).ready(function() {
    
            var fromDate,toDate = new Date();
            
                fromDate = $('#range1').val();
                toDate   = $('#range2').val();
            var city     = $('#city').val();
            var state    = $('#state').val();
            var zip      = $('#zipcode').val();
            
            function parseDate(str) {
              var mdy = str.split('/')
              return new Date(mdy[2], mdy[0]-1, mdy[1]);
            }
            
            function daydiff(first, second) {
              return (second-first)/(1000*60*60*24)
            }
            
            function getMonthName(monthVal){
              var MonthName;
              if(monthVal == 1){MonthName = 'January';}else if(monthVal == 2){MonthName = 'February';}else if(monthVal == 3){MonthName = 'March';}
              else if(monthVal == 4){MonthName = 'April'}else if(monthVal == 5){MonthName = 'May'}else if(monthVal == 6){MonthName = 'June'}
              else if(monthVal == 7){MonthName = 'July'}else if(monthVal == 8){MonthName = 'August'}else if(monthVal == 9){MonthName = 'September'}
              else if(monthVal == 10){MonthName = 'October'}else if(monthVal == 11){MonthName = 'November'}else if(monthVal == 12){MonthName = 'December'};
              
              return MonthName;
            }
            
            var days = daydiff(parseDate(fromDate), parseDate(toDate));
            
            var monthName = getMonthName(fromDate.split("/")[0])
            
            if((days == 365) || (days == 366)){
              $('#guage_description_panel1').html('Average $ Per Foot Last 12 Months From '+monthName+' '+fromDate.split("/")[2]);
            }
            else{
              $('#guage_description_panel1').html('Average $ Per Foot Last 6 Months From '+monthName+' '+fromDate.split("/")[2]);
            }
            
            //alert(toDate.split("/")[0]);
            var undefined = false;  // Shockingly, this is completely legal!
            if(monthVal === undefined) {
              alert("You have been mislead. Run away!");
            }
            else{
              var monthVal = toDate.split("/")[0];
              //alert(monthVal);
              var MonthName = getMonthName(monthVal);
              
              $('#guage_description_panel2').html('Number of Sold Homes in '+MonthName+'-'+toDate.split("/")[2]);
            }
            //$('#ZipLabel').html(zip+" Median Price");
            //$('#CityValue').html(city+" Median Price");      
            
            
            $.ajax({
                url: urldata,
                type: 'POST',
                data: "fromdate="+fromDate+"&todate="+toDate+"&city="+city+"&state="+state+"&zip="+zip,
                dataType: 'json',
                success: function (json) {
                    if(json){
                        var obj =eval(json);
                        MinRange = obj.saleMedianZip['MINLastYear'];
                        MaxRange = obj.saleMedianZip['MAXLastYear'];
                        
                        MinRange1 = obj.saleMedianCity['MINLastYear'];
                        MaxRange1 = obj.saleMedianCity['MAXLastYear'];
                        //for(var i=0;i<obj.groupByMonthAndYearForMedian.length;i++){}

                        if(obj.groupByMonthAndYearForMedian != null){
                        generateChart(obj.groupByMonthAndYearForMedian['monthlytotal'], obj.groupByMonthAndYearForMedian['monthYear']);  
                        }
                        
                        generateGuage(obj.saleMedianZip['lastYear'], obj.saleMedianCity['lastYear']);
                        
                        if(obj.saleMedianZip['MINLastYear'] != null){
                          $('.firstGuageGroup .guage-div .min-max .min-max-left').html(obj.saleMedianZip['MINLastYear']);
                          $('.firstGuageGroup .guage-div .min-max .min-max-left').formatCurrency({useHtml:true});
                          $('.firstGuageGroup .guage-div .min-max .min-max-left').html("Min -"+$('.firstGuageGroup .guage-div .min-max .min-max-left').html())
                        }
                        else{
                          $('.firstGuageGroup .guage-div .min-max .min-max-left').html("Min - $0");
                        }
                        
                        if(obj.saleMedianZip['MAXLastYear'] != null){
                          $('.firstGuageGroup .guage-div .min-max .min-max-right').html(obj.saleMedianZip['MAXLastYear']);
                          $('.firstGuageGroup .guage-div .min-max .min-max-right').formatCurrency({useHtml:true});
                          $('.firstGuageGroup .guage-div .min-max .min-max-right').html("Max -"+$('.firstGuageGroup .guage-div .min-max .min-max-right').html())
                        }
                        else{
                          $('.firstGuageGroup .guage-div .min-max .min-max-right').html("Max - $10");
                        }
                        
                        /*Second Gadget Min and Max*/
                        
                        if(obj.saleMedianCity['MINLastYear'] != null){
                          $('.secondGuageGroup .guage-div .min-max .min-max-left').html(obj.saleMedianCity['MINLastYear']);
                          $('.secondGuageGroup .guage-div .min-max .min-max-left').formatCurrency({useHtml:true});
                          $('.secondGuageGroup .guage-div .min-max .min-max-left').html("Min -"+$('.secondGuageGroup .guage-div .min-max .min-max-left').html())
                        }
                        else{
                          $('.secondGuageGroup .guage-div .min-max .min-max-left').html("Min - $0");
                        }
                        
                        if(obj.saleMedianCity['MAXLastYear'] != null){
                          $('.secondGuageGroup .guage-div .min-max .min-max-right').html(obj.saleMedianCity['MAXLastYear']);
                          $('.secondGuageGroup .guage-div .min-max .min-max-right').formatCurrency({useHtml:true});
                          $('.secondGuageGroup .guage-div .min-max .min-max-right').html("Max -"+$('.secondGuageGroup .guage-div .min-max .min-max-right').html())
                        }
                        else{
                          $('.secondGuageGroup .guage-div .min-max .min-max-right').html("Max - $10");
                        }
                        
                        if(obj.saleMedianZip['lastYear']!='$NaN.undefined'){
                            $('.saleMedianZipValue').html(obj.saleMedianZip['lastYear']);
                            $('.saleMedianZipValue').formatCurrency({useHtml:true});
                            var str = $('.saleMedianZipValue').html();
                            var n=str.split(".");
                            $('.saleMedianZipValue').html(n[0]);
                        }else{
                            $('.saleMedianZipValue').html('$0');
                            $('.saleMedianZipValue').formatCurrency({useHtml:true});
                        }
                        
                        var avg_of_lastYear_and_previousLastYear = Math.round(obj.saleMedianZip['avg_of_lastYear_and_previousLastYear']*100)/100;
                        $('.strategyPercentageZip').html(avg_of_lastYear_and_previousLastYear+"%");
                        if(avg_of_lastYear_and_previousLastYear < 0){
                           $('#firstgauageStrategy').attr('class','downStratergy');
                           $('#firstgauageStrategyLabel').html('Down');
                        }
                        $('.prev12MonStrategy').html("$"+Math.floor(obj.saleMedianZip['previousLastYear']));
                        $('.prev12MonStrategy').formatCurrency({useHtml:true});
                        
                        $('.prev12MonStrategyCity').html("$"+Math.floor(obj.saleMedianCity['previousLastYear']));
                        $('.prev12MonStrategyCity').formatCurrency({useHtml:true});
                        
                        if(obj.saleMedianCity['lastYear']!='$NaN.undefined'){
                            $('.saleMedianCityValue').html(obj.saleMedianCity['lastYear']);
                            $('.saleMedianCityValue').formatCurrency({useHtml:true});
                            var str = $('.saleMedianCityValue').html();
                            var n=str.split(".");
                            $('.saleMedianCityValue').html(n[0]);
                        }else{
                            $('.saleMedianCityValue').html('$0');
                            $('.saleMedianCityValue').formatCurrency({useHtml:true});
                        }
                        var avg_of_lastYear_city = Math.round(obj.saleMedianCity['avg_of_lastYear_and_previousLastYear']*100)/100;
                        $('.strategyPercentageCity').html(avg_of_lastYear_city+"%");
                        
                        if(avg_of_lastYear_city < 0){
                          $('#secondgauageStrategy').attr('class','downStratergy');
                          $('#secondgauageStrategyLabel').html('Down');
                        }
                        
             
                        if(obj.soldSqft['lastYear']!=false){
                            $('#perFootLast12Months').text(obj.soldSqft['lastYear']).formatCurrency();
                            if(obj.soldSqft['lastYear'] < 0){
                              $('#firstStrategyOuter').attr('class','downStratergyOuter');
                            }
                            
                        }else{
                            $('#perFootLast12Months').html("$0");
                        }
                        $('#soldHomeInDate').html(obj.soldDifferenceWithLastYearAndCurrentYear['currentYear']);
                        $('#soldDifferenceWithLastYear').html(obj.soldDifferenceWithLastYearAndCurrentYear['lastYear']);
                        
                        
                        //if(obj.soldDifferenceWithLastYearAndCurrentYear['currentYear'] < 0){
                        //  $('#soldHomeInDate').attr('class','downStratergyOuter');
                        //}
                        
                        
                        if(obj.soldDifferenceWithLastYearAndCurrentYear['lastYear'] < 0){
                          $('#firstsubStrategyOuter').attr('class','downStratergyOuter');
                        }
                        
                        $('#avgDifferenceWithLastYearAndCurrentYear').html(obj.avgDifferenceWithLastYearAndCurrentYear['currentYear']);
                        $('#avg_difference').html(obj.avgDifferenceWithLastYearAndCurrentYear['difference']);
                        
                        if(obj.avgDifferenceWithLastYearAndCurrentYear['difference'] < 0){
                          $('#thirdStrategyOuter').attr('class','downStratergyOuter');
                        }
                        
                        $('#soldAvgSqft').html(Math.floor(obj.soldAvgSqft['lastYear']));
                        $('#soldAvgSqft').html(addCommas($('#soldAvgSqft').html()));
                    }
                }
            });
            //return false;
    });
}
    


//function formatDollar(num) {
//    var p = parseFloat(num).toFixed(2).split(".");
//    return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
//        return  num + (i && !(i % 3) ? "," : "") + acc;
//    }, "") + "." + p[1];
//}


function generateChart(monthlyTotal,year){
    $(function () {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'chart-render',
                    type: 'line',
                    marginBottom: 35,
                    backgroundColor: '#363636',
                    color:'#000',
                    width: 645
                },  
                title: {
                    text: 'Median Price Over Time',
                    x: -20,
                    style:{
                      color: '#fff',
                    }
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
                            return this.value;
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
    //$('tspan').formatCurrency({useHtml:true});
}


function generateGuage(saleMedianZip, saleMedianCity){
// DEMOGAUGE1 - A very basic 'bare-bones' example...
var demoGauge1 = new jGauge(); // Create a new jGauge.
demoGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.

if((MinRange != null)||(MaxRange != null)){
demoGauge1.ticks.start = parseFloat(MinRange);
demoGauge1.ticks.end = parseFloat(MaxRange);
}


// DEMOGAUGE2 - Using the new binary prefixing...
var demoGauge2 = new jGauge(); // Create a new jGauge.
demoGauge2.id = 'jGaugeDemo2';

// Link the new jGauge to the placeholder DIV.

if((MinRange1 != null)||(MaxRange1 != null)){
demoGauge2.ticks.start = parseFloat(MinRange1);
demoGauge2.ticks.end = parseFloat(MaxRange1);
}
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

    demoGauge1.init(); // Put the jGauge on the page by initializing it.
    demoGauge2.init(); // Put the jGauge on the page by initializing it.
    //demoGauge3.init(); // Put the jGauge on the page by initializing it.
    
    // Configure demoGauge3 for random value updates.
    demoGauge1.setValue(saleMedianZip);
    
    //alert(MinRange);
    //alert(MaxRange);
    
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


