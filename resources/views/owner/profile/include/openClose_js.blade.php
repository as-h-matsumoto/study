<script type="text/javascript">
$(document).ready(function () {

  $('#start').change(function() {
    var data = $('#start').val();
    $('#mon-start').val(data);
    $('#tue-start').val(data);
    $('#wed-start').val(data);
    $('#thu-start').val(data);
    $('#fri-start').val(data);
    $('#sat-start').val(data);
    $('#sun-start').val(data);
    $('#public-holiday-start').val(data);
    $('#New-Year-Holiday-start').val(data);
  });

  $('#start-junbi').change(function() {
    var data = $('#start-junbi').val();
    $('#mon-start-junbi').val(data);
    $('#tue-start-junbi').val(data);
    $('#wed-start-junbi').val(data);
    $('#thu-start-junbi').val(data);
    $('#fri-start-junbi').val(data);
    $('#sat-start-junbi').val(data);
    $('#sun-start-junbi').val(data);
    $('#public-holiday-start-junbi').val(data);
    $('#New-Year-Holiday-start-junbi').val(data);
  });

  $('#end').change(function() {
    var data = $('#end').val();
    $('#mon-end').val(data);
    $('#tue-end').val(data);
    $('#wed-end').val(data);
    $('#thu-end').val(data);
    $('#fri-end').val(data);
    $('#sat-end').val(data);
    $('#sun-end').val(data);
    $('#public-holiday-end').val(data);
    $('#New-Year-Holiday-end').val(data);
  });

  $('#end-junbi').change(function() {
    var data = $('#end-junbi').val();
    $('#mon-end-junbi').val(data);
    $('#tue-end-junbi').val(data);
    $('#wed-end-junbi').val(data);
    $('#thu-end-junbi').val(data);
    $('#fri-end-junbi').val(data);
    $('#sat-end-junbi').val(data);
    $('#sun-end-junbi').val(data);
    $('#public-holiday-end-junbi').val(data);
    $('#New-Year-Holiday-end-junbi').val(data);
  });

  @if($company_calendar->mon_off)
  monOff();
  @endif
  $('input[name="mon-off"]').change(function() {
    monOff();
  });

  @if($company_calendar->tue_off)
  tueOff();
  @endif
  $('input[name="tue-off"]').change(function() {
    tueOff();
  });

  @if($company_calendar->wed_off)
  wedOff();
  @endif
  $('input[name="wed-off"]').change(function() {
    wedOff();    
  });

  @if($company_calendar->thu_off)
  thuOff();
  @endif
  $('input[name="thu-off"]').change(function() {
    thuOff();
  });

  @if($company_calendar->fri_off)
  friOff();
  @endif
  $('input[name="fri-off"]').change(function() {
    friOff();
  });

  @if($company_calendar->sat_off)
  satOff();
  @endif
  $('input[name="sat-off"]').change(function() {
    satOff();
  });

  @if($company_calendar->sun_off)
  sunOff();
  @endif
  $('input[name="sun-off"]').change(function() {
    sunOff();
  });

  @if($company_calendar->public_holiday_off)
  publicHolidayOff();
  @endif
  $('input[name="public-holiday-off"]').change(function() {
    publicHolidayOff();
  });

  @if($company_calendar->New_Year_Holiday_off)
  NewYearHolidayOff();
  @endif
  $('input[name="New-Year-Holiday-off"]').change(function() {
    NewYearHolidayOff();
  });

  @if($company_calendar->non_off)
  nonOff();
  @endif
  $('input[name="non-off"]').change(function() {
    nonOff();
  });

  @if($company_calendar->open_24)
  open24();
  @endif
  $('input[name="open-24"]').change(function() {
    open24();
  });
  

  @if(isset($content) and $content->service===81)

    $('input[name="FirstContentDateFormcalendar"]').prop('checked',false);
    $('input[name="non-off"]').prop('checked',false);
    $('input[name="mon-off"]').prop('checked',false);
    $('input[name="tue-off"]').prop('checked',false);
    $('input[name="wed-off"]').prop('checked',false);
    $('input[name="thu-off"]').prop('checked',false);
    $('input[name="fri-off"]').prop('checked',false);
    $('input[name="sat-off"]').prop('checked',false);
    $('input[name="sun-off"]').prop('checked',false);
    $('input[name="public-holiday-off"]').prop('checked',false);
    $('input[name="New-Year-Holiday-off"]').prop('checked',false);
    
    $('input[name="mon-start"]').val('14:00');
    $('input[name="mon-end"]').val('10:00');
    $('input[name="mon-start-junbi"]').val('');
    $('input[name="mon-end-junbi"]').val('');
    $('input[name="mon-end-nextday"]').prop('checked',true);
    
    $('input[name="tue-start"]').val('14:00');
    $('input[name="tue-end"]').val('10:00');
    $('input[name="tue-start-junbi"]').val('');
    $('input[name="tue-end-junbi"]').val('');
    $('input[name="tue-end-nextday"]').prop('checked',true);

    $('input[name="wed-start"]').val('14:00');
    $('input[name="wed-end"]').val('10:00');
    $('input[name="wed-start-junbi"]').val('');
    $('input[name="wed-end-junbi"]').val('');
    $('input[name="wed-end-nextday"]').prop('checked',true);

    $('input[name="thu-start"]').val('14:00');
    $('input[name="thu-end"]').val('10:00');
    $('input[name="thu-start-junbi"]').val('');
    $('input[name="thu-end-junbi"]').val('');
    $('input[name="thu-end-nextday"]').prop('checked',true);

    $('input[name="fri-start"]').val('14:00');
    $('input[name="fri-end"]').val('10:00');
    $('input[name="fri-start-junbi"]').val('');
    $('input[name="fri-end-junbi"]').val('');
    $('input[name="fri-end-nextday"]').prop('checked',true);

    $('input[name="sat-start"]').val('14:00');
    $('input[name="sat-end"]').val('10:00');
    $('input[name="sat-start-junbi"]').val('');
    $('input[name="sat-end-junbi"]').val('');
    $('input[name="sat-end-nextday"]').prop('checked',true);

    $('input[name="sun-start"]').val('14:00');
    $('input[name="sun-end"]').val('10:00');
    $('input[name="sun-start-junbi"]').val('');
    $('input[name="sun-end-junbi"]').val('');
    $('input[name="sun-end-nextday"]').prop('checked',true);

    $('input[name="public-holiday-start"]').val('14:00');
    $('input[name="public-holiday-end"]').val('10:00');
    $('input[name="public-holiday-start-junbi"]').val('');
    $('input[name="public-holiday-end-junbi"]').val('');
    $('input[name="public-holiday-end-nextday"]').prop('checked',true);

    $('input[name="New-Year-Holiday-start"]').val('14:00');
    $('input[name="New-Year-Holiday-end"]').val('10:00');
    $('input[name="New-Year-Holiday-start-junbi"]').val('');
    $('input[name="New-Year-Holiday-end-junbi"]').val('');
    $('input[name="New-Year-Holiday-end-nextday"]').prop('checked',true);
    
    nonOff();
    monOff();
    tueOff();
    wedOff();
    thuOff();
    friOff();
    satOff();
    sunOff();
    publicHolidayOff();
    NewYearHolidayOff();

  @endif

});


function monOff(){
    var data = $('input[name="mon-off"]').prop('checked');
    $('input[name="mon-start"]').prop('disabled', data);
    $('input[name="mon-end"]').prop('disabled', data);
    $('input[name="mon-start-junbi"]').prop('disabled', data);
    $('input[name="mon-end-junbi"]').prop('disabled', data);
    $('input[name="mon-end-nextday"]').prop('disabled', data);
}
function tueOff(){
    var data = $('input[name="tue-off"]').prop('checked');
    $('input[name="tue-start"]').prop('disabled', data);
    $('input[name="tue-end"]').prop('disabled', data);
    $('input[name="tue-start-junbi"]').prop('disabled', data);
    $('input[name="tue-end-junbi"]').prop('disabled', data);
    $('input[name="tue-end-nextday"]').prop('disabled', data);
}
function wedOff(){
    var data = $('input[name="wed-off"]').prop('checked');
    $('input[name="wed-start"]').prop('disabled', data);
    $('input[name="wed-end"]').prop('disabled', data);
    $('input[name="wed-start-junbi"]').prop('disabled', data);
    $('input[name="wed-end-junbi"]').prop('disabled', data);
    $('input[name="wed-end-nextday"]').prop('disabled', data);
}
function thuOff(){
    var data = $('input[name="thu-off"]').prop('checked');
    $('input[name="thu-start"]').prop('disabled', data);
    $('input[name="thu-end"]').prop('disabled', data);
    $('input[name="thu-start-junbi"]').prop('disabled', data);
    $('input[name="thu-end-junbi"]').prop('disabled', data);
    $('input[name="thu-end-nextday"]').prop('disabled', data);
}
function friOff(){
    var data = $('input[name="fri-off"]').prop('checked');
    $('input[name="fri-start"]').prop('disabled', data);
    $('input[name="fri-end"]').prop('disabled', data);
    $('input[name="fri-start-junbi"]').prop('disabled', data);
    $('input[name="fri-end-junbi"]').prop('disabled', data);
    $('input[name="fri-end-nextday"]').prop('disabled', data);
}
function satOff(){
    var data = $('input[name="sat-off"]').prop('checked');
    $('input[name="sat-start"]').prop('disabled', data);
    $('input[name="sat-end"]').prop('disabled', data);
    $('input[name="sat-start-junbi"]').prop('disabled', data);
    $('input[name="sat-end-junbi"]').prop('disabled', data);
    $('input[name="sat-end-nextday"]').prop('disabled', data);
}
function sunOff(){
    var data = $('input[name="sun-off"]').prop('checked');
    $('input[name="sun-start"]').prop('disabled', data);
    $('input[name="sun-end"]').prop('disabled', data);
    $('input[name="sun-start-junbi"]').prop('disabled', data);
    $('input[name="sun-end-junbi"]').prop('disabled', data);
    $('input[name="sun-end-nextday"]').prop('disabled', data);
}
function publicHolidayOff(){
    var data = $('input[name="public-holiday-off"]').prop('checked');
    $('input[name="public-holiday-start"]').prop('disabled', data);
    $('input[name="public-holiday-end"]').prop('disabled', data);
    $('input[name="public-holiday-start-junbi"]').prop('disabled', data);
    $('input[name="public-holiday-end-junbi"]').prop('disabled', data);
    $('input[name="public-holiday-end-nextday"]').prop('disabled', data);
}
function NewYearHolidayOff(){
    var data = $('input[name="New-Year-Holiday-off"]').prop('checked');
    $('input[name="New-Year-Holiday-start"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-start-junbi"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end-junbi"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end-nextday"]').prop('disabled', data);
}
function nonOff(){
    var data = $('input[name="non-off"]').prop('checked');
    $('input[name="mon-off"]').prop('checked', data);
    $('input[name="tue-off"]').prop('checked', data);
    $('input[name="wed-off"]').prop('checked', data);
    $('input[name="thu-off"]').prop('checked', data);
    $('input[name="fri-off"]').prop('checked', data);
    $('input[name="sat-off"]').prop('checked', data);
    $('input[name="sun-off"]').prop('checked', data);
    $('input[name="public-holiday-off"]').prop('checked', data);
    $('input[name="New-Year-Holiday-off"]').prop('checked', data);
    $('input[name="mon-off"]').prop('disabled', data);
    $('input[name="tue-off"]').prop('disabled', data);
    $('input[name="wed-off"]').prop('disabled', data);
    $('input[name="thu-off"]').prop('disabled', data);
    $('input[name="fri-off"]').prop('disabled', data);
    $('input[name="sat-off"]').prop('disabled', data);
    $('input[name="sun-off"]').prop('disabled', data);
    $('input[name="public-holiday-off"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-off"]').prop('disabled', data);
}

function open24(){
    var data = $('input[name="open-24"]').prop('checked');
    $('input[name="start"]').prop('disabled', data);
    $('input[name="end"]').prop('disabled', data);

    $('input[name="start-junbi"]').prop('disabled', data);
    $('input[name="end-junbi"]').prop('disabled', data);

    $('input[name="mon-start"]').prop('disabled', data);
    $('input[name="tue-start"]').prop('disabled', data);
    $('input[name="wed-start"]').prop('disabled', data);
    $('input[name="thu-start"]').prop('disabled', data);
    $('input[name="fri-start"]').prop('disabled', data);
    $('input[name="sat-start"]').prop('disabled', data);
    $('input[name="sun-start"]').prop('disabled', data);
    $('input[name="public-holiday-start"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-start"]').prop('disabled', data);

    $('input[name="mon-start-junbi"]').prop('disabled', data);
    $('input[name="tue-start-junbi"]').prop('disabled', data);
    $('input[name="wed-start-junbi"]').prop('disabled', data);
    $('input[name="thu-start-junbi"]').prop('disabled', data);
    $('input[name="fri-start-junbi"]').prop('disabled', data);
    $('input[name="sat-start-junbi"]').prop('disabled', data);
    $('input[name="sun-start-junbi"]').prop('disabled', data);
    $('input[name="public-holiday-start-junbi"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-start-junbi"]').prop('disabled', data);

    $('input[name="mon-end"]').prop('disabled', data);
    $('input[name="tue-end"]').prop('disabled', data);
    $('input[name="wed-end"]').prop('disabled', data);
    $('input[name="thu-end"]').prop('disabled', data);
    $('input[name="fri-end"]').prop('disabled', data);
    $('input[name="sat-end"]').prop('disabled', data);
    $('input[name="sun-end"]').prop('disabled', data);
    $('input[name="public-holiday-end"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end"]').prop('disabled', data);

    $('input[name="mon-end-junbi"]').prop('disabled', data);
    $('input[name="tue-end-junbi"]').prop('disabled', data);
    $('input[name="wed-end-junbi"]').prop('disabled', data);
    $('input[name="thu-end-junbi"]').prop('disabled', data);
    $('input[name="fri-end-junbi"]').prop('disabled', data);
    $('input[name="sat-end-junbi"]').prop('disabled', data);
    $('input[name="sun-end-junbi"]').prop('disabled', data);
    $('input[name="public-holiday-end-junbi"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end-junbi"]').prop('disabled', data);

    $('input[name="mon-end-nextday"]').prop('disabled', data);
    $('input[name="tue-end-nextday"]').prop('disabled', data);
    $('input[name="wed-end-nextday"]').prop('disabled', data);
    $('input[name="thu-end-nextday"]').prop('disabled', data);
    $('input[name="fri-end-nextday"]').prop('disabled', data);
    $('input[name="sat-end-nextday"]').prop('disabled', data);
    $('input[name="sun-end-nextday"]').prop('disabled', data);
    $('input[name="public-holiday-end-nextday"]').prop('disabled', data);
    $('input[name="New-Year-Holiday-end-nextday"]').prop('disabled', data);
}
</script>