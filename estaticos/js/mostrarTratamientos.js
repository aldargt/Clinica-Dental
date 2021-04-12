var scrollPosicion = 0;
$(document).ready(function(){
	scrollPosicion = $(document).scrollTop();
	$(".card").click(zoom);
	$(window).scroll(function(){
		scrollPosicion = $(document).scrollTop();
	});
	alturaHtml = $("html").height();
});

function zoom(){
	$(".tratamientos").after("<div class='cover'><div class='card zoom'>" + $(this).html() + "</div></div>");
	$(".cover").addClass("coverActive");
	$("body").css("overflow-y", "hidden");

	$(".zoom").click(function(){
		$(".cover").remove();
		$("body").removeAttr("style");
	});
}