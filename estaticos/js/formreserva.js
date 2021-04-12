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
	$("#estadia").change(llenarHoras);
	$("#fecha").change(llenarHoras);
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

function llenarHoras(){
	$("#hora").empty();
	$("#hora").append("<option value='' disabled selected>Seleccione un horario</option>");
	duracion = $("#estadia").val(); //ejemplo -- "1-Estetica dental"

	if(duracion != null){
		for(var i=0; i<duracion.length; i++){
			if(duracion.charAt(i) == "-"){
				duracion = duracion.substring(0, i);
				break;
			}
		}
	}else{
		duracion = 0;		
	}


	fecha = $("#fecha").val(); //ejemplo -- "2020-10-25"
	anioListo = true;
	index = 0;
	anio  = 0;
	mes   = 0;
	dia   = 0;

	if(fecha != null){

		for(var i=0; i<fecha.length; i++){

			if(fecha.charAt(i) == "-"){

				if(anioListo){
					anio = fecha.substring(0, i);
					anioListo = false;
					index = i + 1;
				}else{
					mes = fecha.substring(index, i);
					dia = fecha.substring(i+1, fecha.length);
					break;
				}
			}
		}		
	}

	$.ajax({
		url: "../plantillas/ajax/llenarHoras.php",
		type: "post",
		dataType: "json",
		data: {'anio': anio, 'mes': mes, 'dia':dia, 'duracion': duracion},
		success: function(data){
			if(data){

				if (data.length > 0) {
					for (var i=0 ; i < data.length; i++) {

						hora = parseInt(data[i]);
						minuto = parseInt((data [i]-hora)*60);
						if(minuto == 0){
							minuto = minuto + "0";
						}
						$("#hora").append("<option value="+data[i]+">"+hora+":"+minuto+"</option>");
					}
				}else{
					$("#hora").append("<option value='' disabled>Horarios no disponibles</option>");
				}
			}
		}

	}); 
}
