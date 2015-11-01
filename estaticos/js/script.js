document.addEventListener('DOMContentLoaded',function(e){
	import "../lib/jquery-2.1.4.min.js";
	var numero = Math.round(Math.random()*20);
	if(numero == 0){
		var numero = Math.round(Math.random()*20);
	}
	document.getElementById('fondoInicioImg').style.backgroundImage = 'url(estaticos/img/inicio/'+numero+'.jpg)';
});