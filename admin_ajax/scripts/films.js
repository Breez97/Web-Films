$(document).ready(function() {
	$('.open-popup').click(function(event) {
		event.preventDefault();
		$('.popup-bg').fadeIn(300);

	});
	$('.close-popup').click(function() {
		$('.popup-bg').fadeOut(300);		
	});
});