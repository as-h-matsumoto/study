<script>
(function ()
{

    axios.get('/owner/ajaxGetCustomerMonth')
    .then(function (response) {
        result = response.data;
        //console.log(result);
        var month = moment().format("YYYY/MM ~");
        monthCustomer = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : month, //key  - the name of the series.
                color : '#FFEB3B '  //color - optional: choose your own line color.
            }
        ];

        nv.addGraph(function ()
        {
            var chart = nv.models.lineChart()
                .options({
                    type                   : 'lineChart',
                    height                 : 450,
                    margin                 : {
                        top   : 20,
                        right : 20,
                        bottom: 40,
                        left  : 55
                    },
                    x                      : function (d)
                    {
                        return d.x;
                    },
                    y                      : function (d)
                    {
                        return d.y;
                    },
                    useInteractiveGuideline: true
                });
    
            chart.xAxis     //Chart x-axis settings
                .axisLabel('Time (day/month)');
    
            chart.yAxis     //Chart y-axis settings
                .axisLabel('Voltage (v)')
                .axisLabelDistance(30)
                .tickFormat(function (d)
                {
                    return d3.format('f')(d);
                });
    
            var chartd3 = d3.select('#month-customer svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = monthCustomer;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })
    
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });







    axios.get('/owner/ajaxGetCustomerWeek')
    .then(function (response) {
        result = response.data;
        var week = moment().weekday(1).format("MM/DD") + '~' + moment().weekday(7).format("MM/DD");
        weekCustomer = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : week, //key  - the name of the series.
                color : '#FFEB3B '  //color - optional: choose your own line color.
            }
        ];

        nv.addGraph(function ()
        {
            var chart = nv.models.lineChart()
                .options({
                    type                   : 'lineChart',
                    height                 : 450,
                    margin                 : {
                        top   : 20,
                        right : 20,
                        bottom: 40,
                        left  : 55
                    },
                    x                      : function (d)
                    {
                        return d.x;
                    },
                    y                      : function (d)
                    {
                        return d.y;
                    },
                    useInteractiveGuideline: true
                });
    
            chart.xAxis     //Chart x-axis settings
                .axisLabel('Time (day/week)');
    
            chart.yAxis     //Chart y-axis settings
                .axisLabel('Voltage (v)')
                .axisLabelDistance(30)
                .tickFormat(function (d)
                {
                    return d3.format('f')(d);
                });
    
            var chartd3 = d3.select('#week-customer svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = weekCustomer;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

})();





function changeCustomerMonthToWeek(){
    $('#month-customer-btn').removeClass('btn-outline-info-active');
    $('#month-customer').hide('slow');
    $('#week-customer-btn').addClass('btn-outline-info-active');
    $('#week-customer').show('slow');
}
function changeCustomerWeekToMonth(){
    $('#week-customer-btn').removeClass('btn-outline-info-active');
    $('#week-customer').hide('slow');
    $('#month-customer-btn').addClass('btn-outline-info-active');
    $('#month-customer').show('slow');
}
$(document).ready(function () {
    setTimeout(function(){
        $('#month-customer-btn').addClass('btn-outline-info-active');
        $('#week-customer').hide('');
    },3000);
});
</script>