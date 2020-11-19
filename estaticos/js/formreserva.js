var arrayMeses = [
	  "En",
	  "Febr",
	  "Mzo",
	  "Abr",
	  "My",
	  "Jun",
	  "Jul",
	  "Agt",
	  "Sept",
	  "Oct",
	  "Nov",
	  "Dic"
];

$(document).ready(function(){
	llenarFechas();
});
			
function llenarFechas(){
	var fecha = new Date();
	var mes       = fecha.getMonth();
	var dia       = fecha.getDate() + 2;//dos dias despues de hoy
	var agno      = fecha.getUTCFullYear();

	var contadorFechas = 0; //contador para el numero de dias a cargar
	var contadorDias = 0; //contador que incrementa la fecha
	
		while(contadorFechas < 10){
			sigtFecha = new Date(agno, mes, dia+contadorDias);
			diaSemana      = sigtFecha.getDay();
			if(diaSemana != 0 && diaSemana != 6){
				//si dia es diferente de 0(domingo) y 6(sabado)
				sigtDia  = sigtFecha.getDate();
				sigtMes  = sigtFecha.getMonth();
				sigtAgno = sigtFecha.getUTCFullYear();
				$(".fecha").append("<option value="+sigtAgno+"-"+sigtMes+"-"+sigtDia+">"+sigtDia+" "+arrayMeses[sigtMes]+"</option");
				contadorFechas = contadorFechas + 1;
			}
			contadorDias = contadorDias + 1;
		}
}
