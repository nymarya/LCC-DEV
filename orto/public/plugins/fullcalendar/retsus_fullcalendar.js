/**
 * Created by mayra on 16/11/16.
 */
$(function () {
    var date = new Date();
    var events;
    $("#calendar").fullCalendar({
        height: 650,
        axisFormat: 'HH:mm',
        timeFormat: 'H(:mm)',
        header: {
            left: '',
            center: '',
            right: ''
        },
        editable: true,
        views: {
            semana: {
                type: 'agendaWeek',
                duration: {
                    days: 7
                },
                title: 'Horários',
                columnFormat: 'ddd',
                hiddenDays: [0, 7]
            }
        },
        defaultView: 'semana',
        lang: 'pt-br',
        aspecRatio: 1,
        minTime: "07:00:00",
        maxTime: "23:00:00",
        slotDuration: '00:15:00',
        allDaySlot:false,
        selectable:true,
        forceEventDuration:true,
        disableDragging : true,
        eventDurationEditable: false,
        eventStartEditable: true,
        defaultTimedEventDuration:'00:45:00',
        select: function(date)
        {
            var evento = new Object();
            evento.start = date.format();
            evento.title = $("select[name='componente_id'] option:selected").text();
            evento.allDay = false;
            $('#calendar').fullCalendar('renderEvent', evento);
        },
        eventClick: function(event) {
            if(event.title == '' || event.title === $("select[name='componente_id'] option:selected").text() ){
                $('#calendar').fullCalendar('removeEvents',event._id);
            } else{
                if(event.selectable){
                    $('#calendar').fullCalendar('removeEvents', function (event) {
                        return ($("#filter > option:selected").attr("id") === event.id);
                    });

                    var evento = new Object();
                    event.color = evento.color;
                    event.edited = true;
                    $('#calendar').fullCalendar('updateEvent', event);
                }

            }

        }
    });

    $('form').submit(function(e) {
        var events = [];

        $($('#calendar').fullCalendar('clientEvents')).each(function (_, event) {
            events.push({
                id: event.id,
                title: event.title,
                start: event.start._d,
                end: event.end._d,
                edited: event.edited
            });
        });

        var horarios = document.getElementsByName('horarios');
        for(var i=0; i<horarios.length; ++i){
            horarios[i].value = JSON.stringify(events);
        }
    });
});
