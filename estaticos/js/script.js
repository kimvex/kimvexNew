document.addEventListener('DOMContentLoaded',function(e){
	var numero = Math.round(Math.random()*20);
	if(numero == 0){
		var numero = Math.round(Math.random()*20);
	}
	document.getElementById('fondoInicioImg').style.backgroundImage = 'url(estaticos/img/inicio/'+numero+'.jpg)';

	$.fn.scrollf = function(k){
		var u = this;

		window.addEventListener('scroll', function(){
			estadoTop = window.top;
			alturaDOM = document.height;
			alturaVentana = window.height;
			alturaFinal = alturaDOM - alturaVentana;

			url = k.url;
			$.get(url,function(datos){
				document.getElementById('contenedorPub').innerHTML = datos;
			});
		});
	}

	$('#contenedorPub').scrollf({
		url: 'mas.php'
	});
});