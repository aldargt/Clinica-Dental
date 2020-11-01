var imagen = "";
var tipo = "";
$(document).ready(function(){
	$("[name='imagen']").change(function(){
		imagen = $("[name='imagen']").val();
		len = imagen.length;
		tipo3 = imagen.substr(len-4, len);
		tipo4 = imagen.substr(len-5, len);
		tipo4 = imagen.substr(len-6, len);

		if(tipo3.charAt(0) == "."){
			tipo = tipo3;
		}else if(tipo4.charAt(0) == "."){
			tipo = tipo4;
		}else if(tipo5.charAt(0) == "."){
			tipo = tipo5;
		}

		$(".bad").remove();
		if(!((tipo == ".png") || (tipo == ".jpg") || (tipo == ".jpeg") || (tipo == ".bmp"))){
			$("form").after("<h3 class='bad'>¡La extension de la imagen es incorrecta!</h3>");
		}
		

	});
});