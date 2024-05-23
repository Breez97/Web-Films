$(document).ready(function() {
    closePopUpInfo();

    $('form[name=add-form]').submit(function(event) {
        event.preventDefault();    
        let formData = new FormData(this);    
        $.ajax({
            url: '../admin_ajax/handlers/films_add.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.error == null) {
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
                    closePopUpInfo();
                }
            },
            error: function(xhr, status, error) {
                console.log(status, error);
            }
        });
    });

    $('.main-container').on('click', '.update-button', updateFilm);
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
                <div class='film-main-text'><a class='update-button' data-id='${data.id}'>Изменить</a></div>
                <div class='film-main-text'><a class='delete-button' data-id='${data.id}'>Удалить</a></div>
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

function updateFilm() {
    console.log($(this));
    let filmId = $(this).data('id');
    let parentContainer = $(this).closest('.film-container');
    let currentTitle = parentContainer.find('div.film-title-text');
    let currentCategory = parentContainer.find('div.film-main-text').first();
    let currentHeaderImage = parentContainer.find('img').first();
    let currentSmallImage = parentContainer.find('img').last();
    let currentDescription = parentContainer.find('div.description-text').first();
    let currentRating = parentContainer.find('div.rating-container .description-text');
    let currentGenre = parentContainer.find('div.genre-container .description-text');

    $('form[name=add-form]').hide();
    $('form[name=update-form]').show();

    $('.popup-bg').fadeIn(300);
    let form = $('form[name=update-form]');
    form[0].reset();
    form.closest('.form-container').find('div.header-text').text('Изменение фильма');
    form.find('input[name=update-title]').val(currentTitle.text());
    form.find('select[name=update-category]').val(currentCategory.text() == "Фильм" ? "film" : "serial");
    form.find('textarea[name=update-description]').text(currentDescription.text());
    form.find('input[name=update-rating]').val(parseFloat(currentRating.text()));
    form.find('input[name=update-genre]').val(currentGenre.text());

    form.off('submit').on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        formData.append('film-id', filmId);
        formData.append('old-title', currentTitle.text());
        formData.append('old-category', currentCategory.text());
        formData.append('old-header-image', currentHeaderImage.attr('src'));
        formData.append('old-small-image', currentSmallImage.attr('src'));
        formData.append('old-description', currentDescription.text());
        formData.append('old-rating', parseFloat(currentRating.text()));
        formData.append('old-genre', currentGenre.text());

        $.ajax({
            url: '../admin_ajax/handlers/films_update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('.popup-info-container').empty();
                if (data.error == null) {
                    let oldInfoPopup = `
                        <div class="popup-info">
                            <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                            <div class="film-main-text size-info">Старая информация</div>
                            <div class="info-container">
                                <div class="info-container-text">
                                    <div class="film-main-text left-text">${data.old_title}</div>
                                    <div class="film-main-text left-text">${data.old_category}</div>
                                    <div class="film-main-text left-text">${data.old_rating} / 10.0</div>
                                    <div class="film-main-text left-text">${data.old_genre}</div>
                                    <div class="film-main-text left-text">${data.old_description}</div>
                                </div>
                                <div class="info-container-images">
                                    <img src="../${data.old_header_image}" width="60%" height="60%">
                                    <img src="../${data.old_small_image}" width="60%" height="60%">
                                </div>
                            </div>
                        </div>
                    `;

                    $('.popup-info-container').prepend(oldInfoPopup);

                    let newInfoPopup = `
                    <div class="popup-info">
                        <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                        <div class="film-main-text size-info">Новая информация</div>
                        <div class="info-container">
                            <div class="info-container-text">
                                <div class="film-main-text left-text">${data.update_title}</div>
                                <div class="film-main-text left-text">${data.update_category}</div>
                                <div class="film-main-text left-text">${data.update_rating} / 10.0</div>
                                <div class="film-main-text left-text">${data.update_genre}</div>
                                <div class="film-main-text left-text">${data.update_description}</div>
                            </div>
                            <div class="info-container-images">
                                <img src="../${data.update_headerImageFullName}" width="60%" height="60%">
                                <img src="../${data.update_smallImageFullName}" width="60%" height="60%">
                            </div>
                        </div>
                    </div>
                    `;

                    $('.popup-info-container').prepend(newInfoPopup);

                    closePopUpInfo();

                    currentTitle.text(data.update_title);
                    currentCategory.text(data.update_category);
                    currentHeaderImage.attr('src', `../${data.update_headerImageFullName}`);
                    currentSmallImage.attr('src', `../${data.update_smallImageFullName}`);
                    currentDescription.text(data.update_description);
                    currentRating.text(`${data.update_rating} / 10`);
                    currentGenre.text(data.update_genre);
                } else {
                    let newPopupInfo = `
                        <div class="popup-info">
                            <img class="close-popup-info" src="./img/cross.svg" alt="icon">
                            <div class="film-main-text size-info">Ошибка добавления</div>
                            <div class="film-main-text">${data.error}</div>
                        </div>
                    `;
                    $('.popup-info-container').prepend(newPopupInfo);
                    closePopUpInfo();
                }
            },
            error: function(xhr, status, error) {
                console.log(status, error);
            }
        });
    });
}
