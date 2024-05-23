$(document).ready(function() {
	$('.open-popup').click(function(event) {
		event.preventDefault();
		$('.popup-bg').fadeIn(300);
		$('form[name=add-form]').show();
		$('form[name=add-form]').closest('.form-container').find('div.header-text').text('Добавление фильма');
        $('form[name=add-form]')[0].reset();
		$('form[name=update-form]').hide();
		$('form[name=delete-form]').hide();
	});

	$('.close-popup').click(function() {
		$('.popup-bg').fadeOut(300);		
        $('.popup-info').fadeOut(300);
		$('.popup-info-container').empty();
	}); 
});