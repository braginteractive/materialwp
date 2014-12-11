jQuery(document).ready(function ( $ ) {
	$('#Container').mixItUp();
	$('.wrapp-categories-portfolio .categories-item a').click(function (e) {
		e.preventDefault();
	});

	$('.portfolio-categories a').first().addClass("active");
});