$(document).ready(function() {
	$('.open-popup').click(function(event) {
		event.preventDefault();
		$('.popup-bg').fadeIn(300);
        $('#add-form')[0].reset();

	});

	$('.close-popup').click(function() {
		$('.popup-bg').fadeOut(300);		
        $('.popup-info').fadeOut(300);
	}); 
});