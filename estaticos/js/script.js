document.addEventListener('DOMContentLoaded',function(e){
	var numero = Math.round(Math.random()*20);
	if(numero == 0){
		var numero = Math.round(Math.random()*20);
	}
	document.getElementById('fondoInicioImg').style.backgroundImage = 'url(estaticos/img/inicio/'+numero+'.jpg)';

	$.fn.scrollf = function(k){
		var u = $(this);

		$(window).on('scroll', function(){
			/*estadoTop = window.top;
			alturaDOM = document.height;
			alturaVentana = window.height;
			alturaFinal = alturaDOM - alturaVentana;*/
			estadoTop = $(window).scrollTop();
			alturaDOM = $(document).height();
			alturaVentana = $(window).height();
			alturaFinal = alturaDOM - alturaVentana;

			if(estadoTop >= alturaFinal){
				url = k.url;
				$.get(url,function(datos){
					var u = $('#contenedorPub');
					console.log(u);
					//document.getElementById('contenedorPub').innerHTML = datos;
					$('#contenedorPub').append(datos);
				});
				
			}
		});
	}

	$('#contenedorPub').scrollf({
		url: 'mas.php'
	});
});

$(document).ready(function(){

	$.fn.scrollf = function(k){
		var u = $(this);

		$(window).on('scroll', function(){
			/*estadoTop = window.top;
			alturaDOM = document.height;
			alturaVentana = window.height;
			alturaFinal = alturaDOM - alturaVentana;*/
			estadoTop = $(window).scrollTop();
			alturaDOM = $(document).height();
			alturaVentana = $(window).height();
			alturaFinal = alturaDOM - alturaVentana;

			if(estadoTop >= alturaFinal){
				url = k.url;
				$.get(url,function(datos){
					document.getElementById('contenedorPub').innerHTML = datos;
				});
			}
		});
	}
});