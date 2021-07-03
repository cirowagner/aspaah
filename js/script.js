//----- Efecto Parallax -> Libreria
new universalParallax().init({
	speed: 8.0
});

//--- Menu Fixed
var altura = $('.menu').offset().top;
$(window).on('scroll', function(){

	if ($(window).scrollTop() > altura){
		$('.menu').addClass('menu-fixed');		
	} else {
		$('.menu').removeClass('menu-fixed');		
	}
})

//----- Pestaña activa
$("ul.tabs li a:first").addClass('active-tab');
$(".tab").hide();
$(".tab:first").show();

$("ul.tabs li a").on("click", function(){
	$("ul.tabs li a").removeClass("active-tab");
	$(this).addClass("active-tab");

	$(".tab").hide();
	let activeTab = $(this).attr('href');
	$(activeTab).show();
	return false;
});

// Slide - Glide <- Libreria
const config = {
	type: 'carousel',
	startAt: 1,
	perView: 4,
	breakpoints: {
		600: {
			perView: 1
		},
		840: {
			perView: 2
		},
		1024: {
			perView: 3
		}
	}
}
new Glide('.glide', config).mount();