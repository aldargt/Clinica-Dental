// Variables del dia actual
var today   = new Date();
var month     = today.getMonth();
var day       = today.getDate();
var weekday   = today.getDay();
var year      = today.getUTCFullYear();
var monthText = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];
var weekText = [
  "Domingo",
  "Lunes",
  "Martes",
  "Miercoles",
  "Jueves",
  "Viernes",
  "Sabado"
];
var yearSelected = year;
var monthSelected = month;
var dateSelected;
var lastDayTagSelected = $(".calendar__day.today");
var counterDay = 1;

$(document).ready(function(){

  /*------------------------load clock-------------------------------*/

  setTime();
  setInterval(setTime, 1000);

  /*-----------------------load calendar-----------------------------*/

  for (var i=-2; i<5; i++) {
    $(".dropdown-menu.years").append("<div class='dropdown-item' value='"+(year+i)+"'>"+(year+i)+"</div>");
  }

  fillCalendarToday();

  /*--------------------------events---------------------------------*/

  $(".months .dropdown-item").click(function(){
    $(".months .dropdown-item").removeClass("active");
    $(this).addClass("active");
    $(".title-bar__month").text($(this).text());
    monthSelected = $(this).attr("value");
    fillCalendar(yearSelected, monthSelected);
  });

  $(".years .dropdown-item").click(function(){
    $(".years .dropdown-item").removeClass("active");
    $(this).addClass("active");
    $(".title-bar__year").text($(this).text());
    yearSelected = $(this).attr("value");
    fillCalendar(yearSelected, monthSelected);
  });

  $(".btn-year").click(function(){
    yearSelected = $("#year").val();
    if(yearSelected > 2010 && yearSelected < 2030){
      fillCalendar(yearSelected, monthSelected);
      $(".years .dropdown-item").removeClass("active");
      if($(".dropdown-item[value='"+yearSelected+"']").length > 0){
        $(".dropdown-item[value='"+yearSelected+"']").addClass("active");
      }
    }
  });

  $(".icon.icons8-Up").click(function(){
    lastDayTagSelected.off(fillAppointments);
    lastDayTagSelected.click(fillAppointments);
    dateSelected = new Date(dateSelected.getUTCFullYear(), dateSelected.getMonth(), dateSelected.getDate()+1);
    getAppointments(dateSelected);
  });

  $(".icon.icons8-Down").click(function(){
    lastDayTagSelected.off(fillAppointments);
    lastDayTagSelected.click(fillAppointments);
    dateSelected = new Date(dateSelected.getUTCFullYear(), dateSelected.getMonth(), dateSelected.getDate()-1);
    getAppointments(dateSelected);
  });

  $(".icon.icons8-Share").click(function(){
    lastDayTagSelected.off(fillAppointments);
    lastDayTagSelected.click(fillAppointments);
    dateSelected = new Date(year, month, day);
    getAppointments(dateSelected);
  });

  $(".title-bar__today").click(fillCalendarToday);
  $(".calendar__day.today").click();
});

function fillCalendar(thisYear, thisMonth){
  //-----------------------------------------------------------------
  $(".calendar__day").off();
  $(".title-bar__month").text(monthText[thisMonth]);
  $(".title-bar__year").text(thisYear);
  //-----------------------------------------------------------------
  var days     = $(".calendar__week .calendar__day .calendar__date");
  var weeks    = $(".calendar__week");
  var numCells = 35;

  var previousThisDay = 1;
  var weekdayFirstDay = (new Date(thisYear, thisMonth, 1)).getDay();
  var counter         = -weekdayFirstDay;
  var thisDay  = new Date(thisYear, thisMonth, counter+1);


  if(weekdayFirstDay > 4){
    numCells = 42;
    $(weeks[5]).removeClass("hide");
  }else{
    $(weeks[5]).addClass("hide");
  }

  for (var i=0; i < numCells; i++) {

    $(days[i]).parent().removeClass("inactive");
    $(days[i]).parent().removeClass("today");
    $(days[i]).next().removeClass("calendar__task--today");
    $(days[i]).next().text("");

    counter = counter + 1;
    thisDay = new Date(thisYear, thisMonth, counter);

    if(previousThisDay > thisDay.getDate() || counter < 1){ 
      $(days[i]).parent().addClass("inactive"); 
    }else{ 
      previousThisDay = thisDay.getDate(); 
    }

    if (thisDay.getDate() == day && thisDay.getMonth() == month && thisDay.getUTCFullYear() == year){
      $(days[i]).parent().addClass("today");
      $(days[i]).next().addClass("calendar__task--today");
    }

    /*-------Esto llena el calendario con los dias------------------------*/
    $(days[i]).text(thisDay.getDate());
    $(days[i]).parent().attr("anio", thisDay.getUTCFullYear());
    $(days[i]).parent().attr("mes", thisDay.getMonth());
    $(days[i]).parent().attr("dia", thisDay.getDate());
    /*-------Esto llena el numero de citas de cada dia--------------------*/
    if(thisDay.getDay() != 0 || thisDay.getDay() != 6){
      countAppointments(thisDay.getDate(), thisDay.getMonth(), thisDay.getUTCFullYear(), days[i]);
    }
    /*--------------------------------------------------------------------*/
  }
  $(".calendar__day").click(fillAppointments);
}

function fillCalendarToday(){
  $(".years .dropdown-item").removeClass("active");
  $(".months .dropdown-item").removeClass("active");
  $(".dropdown-item[value='"+month+"']").addClass("active");
  $(".dropdown-item[value='"+year+"']").addClass("active");
  yearSelected  = year;
  monthSelected = month;
  fillCalendar(yearSelected, monthSelected);
}

function setTime(){
  thisHour   = (new Date()).getHours();
  thisMinute = (new Date()).getMinutes();
  thisSecond = (new Date()).getSeconds();
  if(thisMinute < 10){ thisMinute = "0" + thisMinute; }
  if(thisSecond < 10){ thisSecond = "0" + thisSecond; }
  $(".title-bar__controls").text(thisHour+":"+thisMinute+":"+thisSecond);
}

function countAppointments(thisDay, thisMonth, thisYear, selector){
  $.ajax({
    url: "../plantillas/ajax/countAppointments.php",
    type: "post",
    dataType: "json",
    data: {'anio': thisYear, 'mes': thisMonth, 'dia': thisDay},
    success: function(data){
      if(data){
        if(data[0] != 0){
          $(selector).next().text(data[0]);
        }
      }
    }
  });
}

function fillAppointments(){
  thisDate = new Date($(this).attr("anio"), $(this).attr("mes"), $(this).attr("dia"));
  dateSelected = thisDate;
  //--------------------------------------------------------
  lastDayTagSelected.click(fillAppointments);
  lastDayTagSelected = $(this);
  $(this).off();
  //--------------------------------------------------------
  getAppointments(thisDate);
}

function getAppointments(thisDate){
  $(".sidebar__list").empty();
  $(".sidebar__list").append("<div class='text-center'><div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div></div>");
  $(".sidebar__heading").empty();
  $(".sidebar__heading").append(weekText[thisDate.getDay()]+"<br>"+monthText[thisDate.getMonth()]+" "+thisDate.getDate());
  
  $.ajax({
    url: "../plantillas/ajax/llenarCitas.php",
    type: "post",
    dataType: "json",
    data: {'anio': thisDate.getUTCFullYear(), 'mes': thisDate.getMonth(), 'dia': thisDate.getDate()},
    success: function(data){
      if(data){
        if(data[0] != "error"){
          for (var i=0; i<data.length; i++) {
            if( data[i]["hora"] < 7 ){
              continue;
            }
            minuto = data[i]["minuto"];
            if(minuto == 0){ minuto = "00" }
            hora = data[i]["hora"]+":"+minuto;
            popover = "tabindex='"+i+"' data-toggle='popover' data-trigger='focus' title='"+data[i]["tratamiento"]+"' data-content=''";
            attr = "class='sidebar__list-item' value='"+data[i]["id"]+"' "+popover;
            $(".sidebar__list").append("<li "+attr+"><span class='list-item__time'>"+hora+"</span>"+data[i]["tratamiento"]+"</li>");            
          }
        }else{
          $(".sidebar__list").append("<li class='sidebar__list-item nothing' value='0'>No hay citas Registradas</li>");            
        }
      }
      $(".spinner-border").remove();
      $('[data-toggle="popover"]').popover();
      $(".sidebar__list-item").click(showInfo);
    }
  });
}

function showInfo(){
  $(".popover-body").empty();
  var id = $(this).attr("value");
  $(".popover-body").append("<div class='text-center'><div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div></div>");
  $.ajax({
    url: "../plantillas/ajax/informacionCita.php",
    type: "post",
    dataType: "json",
    data: {'id': id},
    success: function(data){
      if(data){
        $(".popover-body").append("<label>Paciente: </label>" + data["nombres"] + " " + data["apellidos"] + "<br>");
        $(".popover-body").append("<label>Correo: </label>" + data["correo"] + "<br>");
        $(".popover-body").append("<label>Numero: </label>" + data["numero"] + "<br>");
      }
      $(".spinner-border").remove();
    }
  });
}
