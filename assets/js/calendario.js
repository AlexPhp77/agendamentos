    
    document.addEventListener('DOMContentLoaded', function() {   

    /*Fullcalendar*/ 
    var initialTimeZone = 'local';
    var timeZoneSelectorEl = document.getElementById('time-zone-selector');
    var loadingEl = document.getElementById('loading');
    var calendarEl = document.getElementById('calendar');   

    var calendar = new FullCalendar.Calendar(calendarEl, {
     // themeSystem: 'bootstrap', 
      
      height: '100%',
      aspectRatio: 2,
      expandRows: true,
      //height: 'auto',   
      windowResize: function(arg) {/*responsivo*/    
      },  
      hiddenDays: [ 0 ],/*bloquear dias da semana - domingo*/
      locale: 'pt-br',
      contentHeight: 500,
      expandRows: true,      
      //eventResizableFromStart: true,
      //slotMinTime: '08:00',
      //slotMaxTime: '20:00',
      initialView: 'timeGridWeek',      
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      //nowIndicator: true,
      dayMaxEvents: 4, // allow "more" link when too many events   
      

      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek custom1',
       
      },  

      customButtons: {

        custom1: {
          text: 'Horário personalizado',
          click: function() {

            $('#marcarhoras').modal('show');
          }
        },

      },

      businessHours: [

        { /*especifica horários de trabalho */
          daysOfWeek: [ 1, 2, 3, 4, 5 ], /*dias da semana*/
          startTime: '09:30', 
          endTime: '19:00' 
        }, 

        {
          daysOfWeek: [ 6 ], 
          startTime: '09:30', 
          endTime: '12:00' 
        }

      ],
      
      events: {

        url: BASE_URL+'home/listar_datas', 
         

        failure: function() {         

          if (document.querySelector('#script-warning')){
     
   document.getElementById('script-warning').style.display = 'inline'; // show
 
}

           
        }
      },
      eventColor: 'red',
    
    eventDrop: function(info) {
        //alert(info.event.title + " Nova data " + info.event.start.toISOString());

      if (!confirm("Tem certeza que deseja atualizar?")) {
        info.revert();
      } else{
        var title = info.event.title
        var id = info.event.id;
        var start = info.event.start.toISOString();
        var end = info.event.end.toISOString(); 
        $.ajax({
          type:"POST",
          url: BASE_URL+'home/atualizar_datas', 
          data:{id:id,start:start,end:end,title:title},   
          success:function(msg){
            console.log(msg);
          },
          error:function(msg){
            console.log(msg);
            alert('Erro');
          }
        })

        calendar.refetchEvents()
      }  
    },   

     eventResize: function(info) {
       // alert(info.event.title + " was dropped on " + info.event.start.toISOString());

      if (!confirm("Tem certeza que deseja atualizar?")) {
        info.revert();
      } else{
        var title = info.event.title
        var id = info.event.id;
        var start = info.event.start.toISOString();
        var end = info.event.end.toISOString(); 
        $.ajax({
          type:"POST",
          url: BASE_URL+'home/atualizar_datas', 
          data:{id:id,start:start,end:end,title:title},   
          success:function(msg){
            alert("Atualizado com sucesso!");
            //console.log(msg);
          },
          error:function(msg){
            console.log(msg);
            alert('Erro');
          }
        })
      }  
    },   




    select: function(arg) {
      var title = prompt('Breve Descrição:');
      if (title) {
          /*calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,                       
      })*/
             
      var start = arg.start.toISOString();
      var end = arg.end.toISOString(); 
      var allDay = arg.allDay;       
     
      $.ajax({
        type:"POST",
        url: BASE_URL+'home/inserir_datas',
        data:{start:start,end:end,allDay:allDay,title:title},   
        success:function(msg){

          calendar.refetchEvents();
        },
        error:function(msg){
          console.log(msg);
          alert('Erro');
        }

        })
      
      }
    
      },       

        eventClick: function(arg) {
        if (confirm('Tem certeza que deseja deletar?')) {
          arg.event.remove()
            var id = arg.event.id;
           $.ajax({
            type:"POST",
            url: BASE_URL+"home/excluir_datas",
            data:{id:id},   
            success:function(msg){
              console.log(msg);
            },
            error:function(msg){
              console.log(msg);
              alert('Erro');
            }

          })
        }
      },

    });   

    if ($("#calendar").length){ 
 
        calendar.render();      
    }    
     
  });