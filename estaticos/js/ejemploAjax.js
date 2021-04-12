$(document).ready(function(){
	$(".tag").click(cargar);
});


function cargar(){
	$.ajax({
		url: "../plantillas/ajax/ejemploAjax.php",
		type: "get",
		dataType: "json",
		success: function(data){
			if(data){
				//para un array ("clave" => (a, b, c), "clave2" => (d, e, f)) 
				for (var i=0 ; i < data["titulo"].length; i++) {
					$(".lista").append("<li>"+data["titulo"][i]+"</li>");
					$(".lista2").append("<li>"+data["imagen"][i]+"</li>");
				}
				/*para un array (a, b, c, d)
				for (var i=0 ; i < data.length; i++) {
					$(".lista").append("<li>"+data[i]+"</li>");
				}
				*/

				/*para un array ("clave" => valor, "clave2" => valor2)
					$(".lista").append("<li>"+data["clave"]+"</li>");
					$(".lista2").append("<li>"+data["clave2"]+"</li>");
				*/
			}
		}
	}); 
}