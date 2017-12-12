$(document).ready(function(){
	$('.contenedor-menu ul li a:first').addClass('activo');
	$('.contenedor-secciones > div').hide();
	$('.contenedor-secciones > div:first').show();

	$('.contenedor-menu ul li a').click(function(){
		$('.contenedor-menu ul li a').removeClass('activo');
		$(this).addClass('activo');
		$('.contenedor-secciones > div').hide();

		var tabActiva = $(this).attr('id');
		$('#seccion-'+tabActiva).show();
	});
});