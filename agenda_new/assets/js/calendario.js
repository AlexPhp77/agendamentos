    
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      height: '85%',
      locale: 'pt-br',
      expandRows: true,  
      //slotMinTime: '08:00',
      //slotMaxTime: '20:00',
      initialView: 'dayGridMonth',      
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      //nowIndicator: true,
      dayMaxEvents: 4, // allow "more" link when too many events   

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },

      businessHours: {
      startTime: '08:00', // a start time (10am in this example)
      endTime: '18:00', // an end time (6pm in this example)
      },
      
      events: {

        url: BASE_URL+'home/listar_datas', 

        failure: function() {
          document.getElementById('script-warning').style.display = 'inline'; // show
        }

      },

    select: function(arg) {
      var title = prompt('Título do evento:');
      if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,           
      })
             
      var start = arg.start.toISOString();
      var end = arg.end.toISOString(); 
      var allDay = arg.allDay; 
      $.ajax({
        type:"POST",
        url: BASE_URL+'home/inserir_datas',
        data:{start:start,end:end,allDay:allDay},   
        success:function(msg){
          console.log(msg);
        },
        error:function(msg){
          console.log(msg);
          alert('Erro');
        }

        })
      }
      calendar.unselect()
      }, 
    });

    calendar.render();    
  });