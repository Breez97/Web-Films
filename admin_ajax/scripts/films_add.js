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

    closePopUpInfo();

	$('form[name=add-form]').on('submit', function(event) {
        event.preventDefault();    
        let formData = new FormData(this);    
        $.ajax({
            url: '../admin_ajax/handlers/films_add.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.error == null) {
                    addNewFilm(data);
                } else {
                    let newPopupInfo = `
                        <div class="popup-info">
                            <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                            <div class="film-main-text size-info">Ошибка добавления</div>
                            <div class="film-main-text">${data.error}</div>
                        </div>
                    `;
                    $('.popup-info-container').prepend(newPopupInfo);
                }
            },
            error: function(xhr, status, error) {
                console.log(status, error);
            }
        });
    });	
});

function addNewFilm(data) {
    let newPopupInfo = `
        <div class="popup-info">
            <img class="close-popup-info" src="./img/cross.svg" alt="icon">
            <div class="film-main-text size-info">Новый фильм успешно добавлен</div>
            <div class="info-container">
                <div class="info-container-text">
                    <div class="film-main-text left-text">${data.title}</div>
                    <div class="film-main-text left-text">${data.category}</div>
                    <div class="film-main-text left-text">${data.rating} / 10.0</div>
                    <div class="film-main-text left-text">${data.genre}</div>
                    <div class="film-main-text left-text">${data.description}</div>
                </div>
                <div class="info-container-images">
                    <img src="../${data.headerImageFullName}" width="60%" height="60%">
                    <img src="../${data.smallImageFullName}" width="60%" height="60%">
                </div>
            </div>
        </div>
    `;
    $('.popup-info-container').prepend(newPopupInfo);

    closePopUpInfo();

    let newFilmInfo = `
        <div class='film-container'>
            <div class='film-title-text'>${data.title}</div>
            <div class='film-main-text'>${data.category}</div>
            <div class='components-container'>
                <div class='main-image'>
                    <div class='film-main-text'>Заглавная картинка</div>
                    <img src='../${data.headerImageFullName}' width='200px'>
                </div>
                <div class='small-image'>
                    <div class='film-main-text'>Маленькая картинка</div>
                    <img src='../${data.smallImageFullName}' width='150px'>
                </div>
                <div class='description-container'>
                    <div class='film-main-text'>Описание</div>
                    <div class='description-text'>${data.description}</div>
                </div>
                <div class='rating-container'>
                    <div class='film-main-text'>Рейтинг</div>
                    <div class='description-text'>${data.rating} / 10</div>
                </div>
                <div class='genre-container'>
                    <div class='film-main-text'>Жанр</div>
                    <div class='description-text'>${data.genre}</div>
                </div>
            </div>
            <div class='buttons-container'>
                <div class='film-main-text'><a href='film_update.php?film_id=$ids[$i]'>Изменить</a></div>
                <div class='film-main-text'><a href='film_delete_func.php?film_id=$ids[$i]'>Удалить</a></div>
            </div>
        </div>
    `;

    $('.main-container').append(newFilmInfo);
}

function closePopUpInfo() {
    $('.close-popup-info').click(function() {
        $(this).closest('.popup-info').fadeOut(300);
    });
}