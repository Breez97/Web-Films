$(document).ready(function() {

	$('.close-popup').click(function() {
		$('.popup-bg').fadeOut(300);		
        $('.popup-info').fadeOut(300);
		$('.popup-info-container').empty();
	});

	closePopUpInfo();

	$('.main-container').on('click', '.delete-button', deleteComment);
});

function closePopUpInfo() {
    $('.close-popup-info').click(function() {
        $(this).closest('.popup-info').fadeOut(300);
    });
}

function deleteComment() {
	$('.popup-bg').fadeIn(300);
	$('form[name=delete-form]').show();
	
	let infoDeleteText = $('form[name=delete-form]').find('div.size');
	infoDeleteText.text('Вы точно хотите удалить?');
	$('form[name=delete-form]').find('button[name=yes-button]').show();
    $('form[name=delete-form]').find('button[name=no-button]').text('Нет');
    let formContainer = $('form[name=delete-form]').closest('div.form-container');
    formContainer.find('div.header-text').text('Удаление комментария');

	let commentId = $(this).data('id');
	let parentContainer = $(this).closest('.film-container');
	let currentUser = parentContainer.find('div[name=user-name]').text();
	let currentTitle = parentContainer.find('div[name=film-title]').text();
	
	$('form[name=delete-form]').find('div[name=film-title]').text(`Комментарий пользователя ${currentUser} к фильму ${currentTitle}`);

	let buttonNo = $('form[name=delete-form]').find('button[name=no-button]');
    let buttonYes = $('form[name=delete-form]').find('button[name=yes-button]');

	buttonNo.off('click').on('click', function(event) {
        event.preventDefault();  
        $('.popup-bg').fadeOut(300);		
        $('.popup-info').fadeOut(300);
		$('.popup-info-container').empty();      
        $('form[name=delete-form]').fadeOut(300);
    });

	buttonYes.off('click').on('click', function(event) {
        event.preventDefault();
        let data = {
            'id': commentId,
			'user_name': currentUser,
            'film_title': currentTitle
        };
        $.ajax({
            url: '../admin_ajax/handlers/comments_delete.php',
            type: 'POST',
            data: data,
            success: function(data) {
                $('.popup-info-container').empty();
                let popupInfo = `
                    <div class="popup-info">
                        <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                        <div class="film-main-text size-info">Информация о удалении</div>
                        <div class="film-main-text">Комментарий пользователя ${data.user_name} к фильму ${data.film_title} удален</div>
                    </div>
                `;
                $('.popup-info-container').prepend(popupInfo);
                infoDeleteText.text('Запись удалена');
                $('form[name=delete-form]').find('button[name=yes-button]').hide();
                $('form[name=delete-form]').find('button[name=no-button]').text('Закрыть окно');
                closePopUpInfo();
                formContainer.closest('div.popup-add').css('min-height', '100px');
                parentContainer.remove();
            },
            error: function(xhr, status, error) {
                console.log(status, error);
            }
        });
    });
}