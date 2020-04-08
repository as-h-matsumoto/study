<?php
$eventUrl = '';
$ownerEdit = null;
if($GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][4]==='date'){
    $eventUrl = '/owner/contents/' . $content->id . '/date/';
    $eventUrl .= ($GLOBALS['urls'][5]==='edit') ? 'getDateEdit' : 'getDateYoyaku';
    if($GLOBALS['urls'][5]==='edit') $ownerEdit = true;
    if($GLOBALS['urls'][5]==='adduser') $eventUrl = '/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTen($content->service).'/contents/' . $content->id . '/getDate';
}elseif(
    ($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='contents' and $GLOBALS['urls'][5]==='desc') or
    ($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='contents' and $GLOBALS['urls'][5]==='iframeCalendar')
){
    $eventUrl = '/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTen($content->service).'/contents/' . $content->id . '/getDate';
}elseif($GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='contents' and $GLOBALS['urls'][5]==='menu'and $GLOBALS['urls'][7]==='desc'){
    $eventUrl = '/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTen($content->service).'/contents/' . $content->id . '/menu/' . $menu->id . '/getDateMenu';
}

?>

<link type="text/css" rel="stylesheet" href="/storage/assets/vendor/fullcalendar/dist/fullcalendar.min.css"/>
<link type="text/css" rel="stylesheet" href="/storage/assets/vendor/fullcalendar/dist/fullcalendar.print.min.css" media="print"/>
<style>
.fc-minor{display:none;}
</style>
<script type="text/javascript" src="/storage/assets/vendor/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript">

(function ()
{
    var calendarView,
        calendar,
        currentMonthShort;

    // Data
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar-view').fullCalendar({
        events            : '{!!$eventUrl!!}',
        dayNames          : ['日曜日:Sunday', '月曜日:Monday', '火曜日:Tuesday', '水曜日:Wednesday', '木曜日:Thursday', '金曜日:Friday', '土曜日:Saturday'],
        dayNamesShort     : ['日', '月', '火', '水', '木', '金', '土'],
        editable          : true,
        eventLimit        : true,
        header            : '',
        handleWindowResize: false,
        aspectRatio       : 1,
        nowIndicator      : true,
        defaultView       : '@if($GLOBALS['urls'][1]==='SENSEN'){!!'agendaWeek'!!}@else{!!'month'!!}@endif',
        /*
        defaultView: 'agenda',
        visibleRange: {
          start: '{!!date('Y-m-d', strtotime('-2 day'))!!}',
          end: '{!!date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')))!!}'
        },
        */
        /*
        defaultView: 'agenda',
        duration: { days: 4 },
        */
        viewRender        : function (view)
        {
            //console.log(view);
            calendarView = view;
            calendar = view.calendar;
    
            $('#calendar-view-title').text(titleFormat(view.title, view.name));
    
            $('#calendar > .page-header').removeClass(currentMonthShort);
            currentMonthShort = calendar.getDate().format('MMM');
            $('#calendar > .page-header').addClass(currentMonthShort);

        },
        eventAfterAllRender: function(view) {
          $('.fc-axis').each(function() {
            $(this).css({'cssText':'width:14px !important;'});
            $(this).children('span').css({'cssText':'position:absolute !important; left:0; padding-left:4px !important;'});
          })
        },
        eventClick        : eventClick,
        selectable        : true,
        selectHelper      : true,
        dayClick          : dayClick,
        eventResize: function(calEvent, jsEvent, view) {

            @if($ownerEdit) eventStartEndSave(calEvent); @endif

        },
        eventDrop: function(calEvent, jsEvent, view) {

            @if($ownerEdit) eventStartEndSave(calEvent); @endif

        }
    });

    function eventClick(event, jsEvent, view)
    {

        @if($GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][4]==='date') //owner 共通利用
            @if($GLOBALS['urls'][5]==='edit')
              @include('owner/contents/date/include/edit_eventClick_js')
            @elseif($GLOBALS['urls'][5]==='yoyaku')
              @include('owner/contents/date/include/yoyaku_eventClick_js')
            @elseif($GLOBALS['urls'][5]==='adduser')
              eventClickFunc(event);
            @endif
        @elseif( $GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='contents' )
            eventClickFunc(event);
        @endif

    }

    function dayClick(date, jsEvent, view)
    {
        @if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
            @if($ownerEdit) @include('owner/contents/date/include/create_event_js') @endif
        @else
            @if($ownerEdit) @include('owner/contents/date/include/edit_first_dayClick_js') @endif
        @endif

        @if($GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][5]==='yoyaku')
            @if($content->service===62 or $content->service===69 or $content->service===101)
                @include('owner/contents/date/include/yoyaku_first_dayClick_lesson_js')
            @else
                @include('owner/contents/date/include/yoyaku_first_dayClick_js')
            @endif
        @endif
    }

    function selecTable(date, jsEvent, view)
    {
        //console.log('selecTable');
    }

    $('#calendar-next-button').click(function ()
    {
        calendar.next();
    });

    $('#calendar-previous-button').click(function ()
    {
        calendar.prev();
    });

    $('#calendar-today-button').click(function ()
    {
        calendar.today();
    });

    $('#calendar .page-header .change-view').click(function ()
    {
        calendar.changeView($(this).data('view'));
    });

    @include('include/calendar_title_format') //全体利用

    @if($GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][4]==='date')
        
        @if($GLOBALS['urls'][5]==='edit') //owner 共通利用
            @if($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91)
                @include('owner/contents/date/include/create_event_post_js')
                document.getElementById('postCreateEvent').addEventListener('click', postCreateEvent, false);
            @else
                @include('owner/contents/date/include/public_edit_calendar_js')
                @include('owner/contents/date/include/edit_first_post_js')
                document.getElementById('postFirstContentDate').addEventListener('click', postFirstContentDate, false);
            @endif
            @include('owner/contents/date/include/edit_event_js')
            document.getElementById('postModalEvent').addEventListener('click', postModalEvent, false);
            document.getElementById('deleteModalEvent').addEventListener('click', deleteModalEvent, false);
            document.getElementById('postDeleteEventRelation').addEventListener('click', postDeleteEventRelation, false);
            
        @elseif($GLOBALS['urls'][5]==='yoyaku')
            @include('owner/contents/date/include/yoyaku_event_js')
        @endif

        @if($content->service===15) //飲食でしか利用できないJS
            @if($GLOBALS['urls'][5]==='edit')
                document.getElementById('FirstContentDateFormMenuTypeSelect').addEventListener('change', menuChange, false);
            @endif
        @endif
    @endif

})();
</script>
@if( 
    ( $GLOBALS['urls'][1]==='SenMonTen' and $GLOBALS['urls'][3]==='contents' ) or
    ( $GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][5]==='adduser' )
)
    @include('SenMonTen/contents/date/include/yoyakuComfirm_js')
    @include('SenMonTen/contents/date/include/eventClick_js')
    @include('SenMonTen/contents/date/include/insertMenus_js')
    @include('SenMonTen/contents/date/include/insertCapacities_js')
@endif

@if( $GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][5]==='yoyaku' )
    @include('owner/contents/date/include/yoyaku_first_js')
    @include('owner/contents/date/include/yoyaku_first_insertMenus_js')
    @include('owner/contents/date/include/yoyaku_first_insertCapacities_js')
    @include('owner/contents/date/include/yoyaku_first_insertUsers_js')
@endif


<script>
$(document).ready(function () {
    //$('[data-time="00:00:00"]').hide();
    //$('[data-time="00:30:00"]').hide();
    //$('[data-time="01:00:00"]').hide();
    //$('[data-time="01:30:00"]').hide();
    //$('[data-time="02:00:00"]').hide();
    //$('[data-time="02:30:00"]').hide();
    //$('[data-time="03:00:00"]').hide();
    //$('[data-time="03:30:00"]').hide();
    //$('[data-time="04:00:00"]').hide();
    //$('[data-time="04:30:00"]').hide();
    //$('[data-time="05:00:00"]').hide();
    //$('[data-time="05:30:00"]').hide();
    //$('[data-time="06:00:00"]').hide();
    //$('[data-time="06:30:00"]').hide();
    //$('[data-time="07:00:00"]').hide();
    //$('[data-time="07:30:00"]').hide();
    //$('[data-time="08:00:00"]').hide();
    //$('[data-time="08:30:00"]').hide();
    //$('[data-time="09:00:00"]').hide();
    //$('[data-time="09:30:00"]').hide();
});
</script>
