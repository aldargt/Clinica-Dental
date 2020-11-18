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
var yearSelected = year;
var monthSelected = month; 

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

  $(".title-bar__today").click(fillCalendarToday);
});

function fillCalendar(thisYear, thisMonth){
  var days     = $(".calendar__week .calendar__day .calendar__date");
  var weeks    = $(".calendar__week");
  var thisDay  = 0;
  var counter  = 1;
  var ready    = true;
  var numCells = 35;
  var previousThisDay      = 1;
  var weekdayFirstDay      = (new Date(thisYear, thisMonth, 1)).getDay();
  var lastDayPreviousMonth = new Date(thisYear, thisMonth, 0).getDate();

  $(".title-bar__month").text(monthText[thisMonth]);
  $(".title-bar__year").text(thisYear);

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

    if(weekdayFirstDay == 0){
      thisDay = new Date(thisYear, thisMonth, counter).getDate();
      counter = counter + 1;

      if(previousThisDay <= thisDay){ previousThisDay = thisDay; }
      else{ $(days[i]).parent().addClass("inactive"); }

      if (thisDay == day && thisMonth == month && thisYear == year && ready){
        $(days[i]).parent().addClass("today");
        $(days[i]).next().addClass("calendar__task--today");
        ready = false;
      }

    }else{
      thisDay         = lastDayPreviousMonth - weekdayFirstDay + 1;
      weekdayFirstDay = weekdayFirstDay - 1;
      $(days[i]).parent().addClass("inactive");
    }
    /*-------Esto llena el calendario con los dias------------------------*/
    $(days[i]).text(thisDay);
    //aqui codigo para el numero de citas por dia
    //$(days[i]).next().text("texto");
    /*--------------------------------------------------------------------*/
  }
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
  thisMinute = (new Date()).getMinutes();
  thisSecond = (new Date()).getSeconds();
  if(thisMinute < 10){ thisMinute = "0" + thisMinute; }
  if(thisSecond < 10){ thisSecond = "0" + thisSecond; }
  $(".title-bar__controls").text((new Date()).getHours()+":"+thisMinute+":"+thisSecond);
}