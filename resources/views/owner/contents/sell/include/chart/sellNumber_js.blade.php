<script>
(function ()
{

    axios.get('/owner/contents/{!!$content->id!!}/sell/ajaxGetSellNumberMonth')
    .then(function (response) {
        result = response.data;
        var month = moment().format("YYYY/MM ~");
        monthSellNumber = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : month, //key  - the name of the series.
                color : '#1E88E5'  //color - optional: choose your own line color.
            }
        ];

        // month sell
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
    
            var chartd3 = d3.select('#month-sell-number svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = monthSellNumber;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })
    
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });







    axios.get('/owner/contents/{!!$content->id!!}/sell/ajaxGetSellNumberWeek')
    .then(function (response) {
        result = response.data;
        var week = moment().weekday(1).format("MM/DD") + '~' + moment().weekday(7).format("MM/DD");
        weekSellNumber = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : week, //key  - the name of the series.
                color : '#1E88E5'  //color - optional: choose your own line color.
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
    
            var chartd3 = d3.select('#week-sell-number svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = weekSellNumber;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

})();





function changeSeelNumberMonthToWeek(){
    $('#month-sell-number-btn').removeClass('btn-outline-info-active');
    $('#month-sell-number').hide('slow');
    $('#week-sell-number-btn').addClass('btn-outline-info-active');
    $('#week-sell-number').show('slow');
}
function changeSeelNumberWeekToMonth(){
    $('#week-sell-number-btn').removeClass('btn-outline-info-active');
    $('#week-sell-number').hide('slow');
    $('#month-sell-number-btn').addClass('btn-outline-info-active');
    $('#month-sell-number').show('slow');
}

$(document).ready(function () {
    setTimeout(function(){
        $('#month-sell-number-btn').addClass('btn-outline-info-active');
        $('#week-sell-number').hide('');
    },3000);
});
</script>