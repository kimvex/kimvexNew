document.addEventListener('DOMContentLoaded',function(e){
	var numero = Math.round(Math.random()*20);
	if(numero == 0){
		var numero = Math.round(Math.random()*20);
	}
	document.getElementById('fondoInicioImg').style.backgroundImage = 'url(estaticos/img/inicio/'+numero+'.jpg)';
});

$(document).ready(function(){

	$.fn.scrollf = function(k){
		var u = $(this);

		$(window).on('scroll', function(){
			estadoTop = $(window).scrollTop();
			alturaDOM = $(document).height();
			alturaVentana = $(window).height();
			alturaFinal = alturaDOM - alturaVentana;

			if(estadoTop >= alturaFinal){
				url = k.url;
				$.get(url,function(datos){
					$(u).append(datos);
				});
			}
		});
	}
});