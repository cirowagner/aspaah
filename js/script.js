window.onload = function(){
	$("#loader").removeClass("loader");	
	$("#loader").fadeOut();
	$("body").removeClass("overflow-hidden");
}

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

// Slide - Swiper <- Libreria
var swiper = new Swiper('.swiper-container', {
	// Optional parameters
	spaceBetween: 31,
	loop: true,
	centeredSlides: true,
	effect: "coverflow",

	// If we need pagination
	pagination: {
	el: '.swiper-pagination',
	clickable: true,
	},

	// Navigation arrows
	navigation: {
	nextEl: '.swiper-button-next',
	prevEl: '.swiper-button-prev',
	},
	// Breakpoints
	breakpoints: {
		510: {
		slidesPerView: 1,
		},
		668: {
		slidesPerView: 2,
		},
		1024: {
		slidesPerView: 3,
		},
	},
	// Effects
	coverflowEffect: {
		rotate: 0,
		stretch: 0,
		depth: 100,
		modifier: 1,
		slideShadows: false,
	},
});

// Ubicación - Api - Google Maps	
// function initMap() {
// 	var coord = {lat:-34.5956145 , lng:-58.4431949};
	
// 	var map = new google.maps.Map(document.getElementById('map'),{
// 		center: coord,
// 		zoom:10,
// 		mapID: 'e5aa844c24f35d3d'
// 	});
// 	var marker = new google.maps.Marker({
// 		position: coord,
// 		map: map
// 	});
// }
