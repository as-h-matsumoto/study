<script>
(function ()
{

    axios.get('/owner/contents/{!!$content->id!!}/sell/ajaxGetSellMonth')
    .then(function (response) {
        result = response.data;
        var month = moment().format("YYYY/MM ~");
        monthSell = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : month, //key  - the name of the series.
                color : '#ff7f0e'  //color - optional: choose your own line color.
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
    
            var chartd3 = d3.select('#month-sell svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = monthSell;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })
    
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });







    axios.get('/owner/contents/{!!$content->id!!}/sell/ajaxGetSellWeek')
    .then(function (response) {
        result = response.data;
        var week = moment().weekday(1).format("MM/DD") + '~' + moment().weekday(7).format("MM/DD");
        weekSell = [
            {
                values: result,      //values - represents the array of {x,y} data points
                key   : week, //key  - the name of the series.
                color : '#ff7f0e'  //color - optional: choose your own line color.
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
    
            var chartd3 = d3.select('#week-sell svg')
            var chartData;
    
            initChart();
    
            nv.utils.windowResize(chart.update);
    
            function initChart()
            {
                chartData = weekSell;
                chartd3.datum(chartData).call(chart);
            }
    
            return chart;
        })

    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });

})();




function changeSeelMonthToWeek(){
    $('#month-sell-btn').removeClass('btn-outline-info-active');
    $('#month-sell').hide('slow');
    $('#week-sell-btn').addClass('btn-outline-info-active');
    $('#week-sell').show('slow');
}
function changeSeelWeekToMonth(){
    $('#week-sell-btn').removeClass('btn-outline-info-active');
    $('#week-sell').hide('slow');
    $('#month-sell-btn').addClass('btn-outline-info-active');
    $('#month-sell').show('slow');
}
$(document).ready(function () {
    setTimeout(function(){
        $('#month-sell-btn').addClass('btn-outline-info-active');
        $('#week-sell').hide('');
    },3000);
});
</script>