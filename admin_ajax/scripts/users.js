$(document).ready(function() {
	$('.open-popup').click(function(event) {
		event.preventDefault();
		$('.popup-bg').fadeIn(300);
		$('form[name=add-form]').show();
		$('form[name=add-form]').closest('.form-container').find('div.header-text').text('Добавление пользователя');
		$('form[name=add-form]')[0].reset();
		$('form[name=update-form]').hide();
		$('form[name=delete-form]').hide();
	})

	$('.close-popup').click(function() {
		$('.popup-bg').fadeOut(300);		
        $('.popup-info').fadeOut(300);
		$('.popup-info-container').empty();
	});

	closePopUpInfo();

	$('form[name=add-form]').submit(function(event) {
		event.preventDefault();
		let formData = new FormData(this);
		$.ajax({
			url: '../admin_ajax/handlers/users_add.php',
			type: 'POST',
			data: formData,
			contentType: false,
            processData: false,
			success: function(data) {
				if (data.error) {
					let newPopupInfo = `
						<div class="popup-info">
							<img class="close-popup-info" src="./img/cross.svg" alt="icon">
							<div class="film-main-text size-info">Ошибка добавления</div>
							<div class="film-main-text">${data.error}</div>
						</div>
					`;
					$('.popup-info-container').prepend(newPopupInfo);
					closePopUpInfo();
				} else {
					let newPopupInfo = `
						<div class="popup-info">
							<img class="close-popup-info" src="./img/cross.svg" alt="icon">
							<div class="film-main-text size-info">Новый пользователь успешно добавлен</div>
							<div class="info-container">
								<div class="info-container-text center-text">
									<div class="film-main-text">${data.name}</div>
									<div class="film-main-text">${data.login}</div>
									<div class="film-main-text">${data.password}</div>
									<div class="film-main-text">${data.email}</div>
									<div class="film-main-text">${data.admin}</div>
								<div>
							</div>
						</div>
					`;
					$('.popup-info-container').prepend(newPopupInfo);

    				closePopUpInfo();

					let newUserInfo = `
						<div class='film-container'>
							<div class='components-container'>
								<div class='name-container'>
									<div class='film-main-text'>Имя</div>
									<div name='user-name' class='film-main-text'>${data.name}</div>
								</div>
								<div class='login-container'>
									<div class='film-main-text'>Логин</div>
									<div name='user-login' class='film-main-text'>${data.login}</div>
								</div>
								<div class='password-container'>
									<div class='film-main-text'>Пароль</div>
									<div name='user-password' class='film-main-text'>${data.password}</div>
								</div>
								<div class='email-container'>
									<div class='film-main-text'>Почта</div>
									<div name='user-email' class='film-main-text'>${data.email}</div>
								</div>
								<div class='admin-container'>
									<div class='film-main-text'>Админ</div>
									<div name='user-admin' class='film-main-text'>${data.admin}</div>
								</div>
							</div>
							<div class='buttons-container'>
								<div class='film-main-text'><a class='update-button' data-id='${data.id}'>Изменить</a></div>
								<div class='film-main-text'><a class='delete-button' data-id='${data.id}'>Удалить</a></div>
							</div>
						</div>
					`;
					$('.main-container').append(newUserInfo);
				}
			},
			error: function(xhr, status, error) {
				console.log(status, error);
			}
		});
	});

	$('.main-container').on('click', '.update-button', updateUser);
	$('.main-container').on('click', '.delete-button', deleteUser);
});

function closePopUpInfo() {
    $('.close-popup-info').click(function() {
        $(this).closest('.popup-info').fadeOut(300);
    });
}

function updateUser() {
	$('form[name=add-form]').hide();
    $('form[name=update-form]').show();
    $('form[name=delete-form]').hide();

	let userId = $(this).data('id');
	let parentContainer = $(this).closest('.film-container');
	let currentName = parentContainer.find('div[name=user-name]');
	let currentLogin = parentContainer.find('div[name=user-login]');
	let currentPassword = parentContainer.find('div[name=user-password]');
	let currentEmail = parentContainer.find('div[name=user-email]');
	let currentAdmin = parentContainer.find('div[name=user-admin]');

	$('.popup-bg').fadeIn(300);

	let form = $('form[name=update-form]');
    form[0].reset();
	form.closest('.form-container').find('div.header-text').text('Изменение пользователя');
	form.find('input[name=update-name]').val(currentName.text());
	form.find('input[name=update-login]').val(currentLogin.text());
	form.find('input[name=update-password]').val(currentPassword.text());
	form.find('input[name=update-email]').val(currentEmail.text());
	form.find('select[name=update-admin]').val((currentAdmin.text() === 'No') ? '0' : '1');

	form.off('submit').on('submit', function(event) {
		event.preventDefault();
        let formData = new FormData(this);

		formData.append('user-id', userId);
		formData.append('old-name', currentName.text());
		formData.append('old-login', currentLogin.text());
		formData.append('old-password', currentPassword.text());
		formData.append('old-email', currentEmail.text());
		formData.append('old-admin', currentAdmin.text());

		console.log(currentEmail.text());
		console.log(formData.get('update-email'));

		$.ajax({
			url: '../admin_ajax/handlers/users_update.php',
			type: 'POST',
			data: formData,
			contentType: false,
            processData: false,
			success: function(data) {
				$('.popup-info-container').empty();
				if (data.error) {
					let newPopupInfo = `
						<div class="popup-info">
							<img class="close-popup-info" src="./img/cross.svg" alt="icon">
							<div class="film-main-text size-info">Ошибка добавления</div>
							<div class="film-main-text">${data.error}</div>
						</div>
					`;
					$('.popup-info-container').prepend(newPopupInfo);
					closePopUpInfo();
				} else {
					let oldInfoPopup = `
						<div class="popup-info">
							<img class="close-popup-info" src="./img/cross.svg" alt="icon">
							<div class="film-main-text size-info">Старая информация</div>
							<div class="info-container">
								<div class="info-container-text center-text">
									<div class="film-main-text">${data.old_name}</div>
									<div class="film-main-text">${data.old_login}</div>
									<div class="film-main-text">${data.old_password}</div>
									<div class="film-main-text">${data.old_email}</div>
									<div class="film-main-text">${data.old_admin}</div>
								<div>
							</div>
						</div>
					`;
					$('.popup-info-container').prepend(oldInfoPopup);

					let newInfoPopup = `
						<div class="popup-info">
							<img class="close-popup-info" src="./img/cross.svg" alt="icon">
							<div class="film-main-text size-info">Новая информация</div>
							<div class="info-container">
								<div class="info-container-text center-text">
									<div class="film-main-text">${data.update_name}</div>
									<div class="film-main-text">${data.update_login}</div>
									<div class="film-main-text">${data.update_password}</div>
									<div class="film-main-text">${data.update_email}</div>
									<div class="film-main-text">${data.update_admin}</div>
								<div>
							</div>
						</div>
					`;

					$('.popup-info-container').prepend(newInfoPopup);

					closePopUpInfo();

					currentName.text(data.update_name);
					currentLogin.text(data.update_login);
					currentPassword.text(data.update_password);
					currentEmail.text(data.update_email);
					currentAdmin.text(data.update_admin);
				}
			} ,
			error: function(xhr, status, error) {
                console.log(status, error);
            }
		});
	});
}

function deleteUser() {
	$('form[name=add-form]').hide();
    $('form[name=update-form]').hide();
    $('form[name=delete-form]').show();

	let infoDeleteText =  $('form[name=delete-form]').find('div.size');
	infoDeleteText.text('Вы точно хотите удалить?');
	$('form[name=delete-form]').find('button[name=yes-button]').show();
    $('form[name=delete-form]').find('button[name=no-button]').text('Нет');
	let formContainer = $('form[name=delete-form]').closest('div.form-container');
    formContainer.find('div.header-text').text('Удаление пользователя');

	$('.popup-bg').fadeIn(300);

	let userId = $(this).data('id');
	let parentContainer = $(this).closest('.film-container');
	let currentName = parentContainer.find('div[name=user-name]');

	$('form[name=delete-form]').find('div[name=film-title]').text(currentName.text());

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
            'id': userId,
            'name': currentName.text()
        };
        $.ajax({
            url: '../admin_ajax/handlers/users_delete.php',
            type: 'POST',
            data: data,
            success: function(data) {
                $('.popup-info-container').empty();
                let popupInfo = `
                    <div class="popup-info">
                        <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                        <div class="film-main-text size-info">Информация о удалении</div>
                        <div class="film-main-text">Пользователь ${data.name} успешно удален</div>
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