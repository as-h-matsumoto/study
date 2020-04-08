function eventStartEndSave(calEvent)
{
    loading();
    var form_data = new FormData();
    form_data.append("start", calEvent.start.format());
    form_data.append("end", calEvent.end.format());
    form_data.append("content_date_id", calEvent.id);
    
    axios.post('/owner/contents/{!!$content->id!!}/date/edit/resizeDate', form_data)
    .then(function (response) {
        result = response.data;
        if(!ajaxCheckPublic(result)){$("#calendar-view").fullCalendar("refetchEvents");return;}
        $('#loading').hide();
        successNotify('変更しました。');
        $("#calendar-view").fullCalendar("refetchEvents");
    })
    .catch(function (error) {
        ajaxCheckError(error); return;
    });
    
}