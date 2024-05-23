<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$headerImageFullName = 'films_images/header_images/';
		$smallImageFullName = 'films_images/small_images/';
		$response = [];
		$response['error'] = null;
		
		if (isset($_FILES['update-header-image']) && $_FILES['update-header-image']['name'] != '') {
			$headerImageTmpPath = $_FILES['update-header-image']['tmp_name'];
			$headerImageName = basename($_FILES['update-header-image']['name']);
			$headerImageDir = '../../' . $headerImageFullName;
			$headerImageExtension = strtolower(pathinfo($headerImageName, PATHINFO_EXTENSION));

			if (!in_array($headerImageExtension, ['png', 'jpg', 'jpeg'])) {
				$response['error'] .= "Заглавная картинка должна быть в формате PNG или JPG\n";
			} else {
				list($width, $height) = getimagesize($headerImageTmpPath);
				if ($width != 1920 || $height != 1080) {
					$response['error'] .= "Заглавная картинка должна быть размером 1920x1080 пикселей\n";
				} else {
					if (!is_dir($headerImageDir)) {
						mkdir($headerImageDir, 0755, true);
					}
					$headerImagePath = $headerImageDir . $headerImageName;
					$headerImageFullName = $headerImageFullName . $headerImageName;

					if (move_uploaded_file($headerImageTmpPath, $headerImagePath)) {
						$response['headerImageFullName'] = $headerImageFullName;
					} else {
						$response['error'] .= "Ошибка при загрузке заглавной картинки\n";
					}
				}
			}
		} else {
			$response['headerImageFullName'] = $response['headerImageFullName'] = str_replace('../', '', $_POST['old-header-image']);
		}

		if (isset($_FILES['update-small-image']) && $_FILES['update-small-image']['name'] != '') {
			$smallImageTmpPath = $_FILES['update-small-image']['tmp_name'];
			$smallImageName = basename($_FILES['update-small-image']['name']);
			$smallImageDir = '../../' . $smallImageFullName;
			$smallImageExtension = strtolower(pathinfo($smallImageName, PATHINFO_EXTENSION));

			if (!in_array($smallImageExtension, ['png', 'jpg', 'jpeg'])) {
				$response['error'] .= "Маленькая картинка должна быть в формате PNG или JPG\n";
			} else {
				list($width, $height) = getimagesize($smallImageTmpPath);
				if ($width != 1000 || $height != 1000) {
					$response['error'] .= "Маленькая картинка должна быть размером 1000x1000 пикселей\n";
				} else {
					if (!is_dir($smallImageDir)) {
						mkdir($smallImageDir, 0755, true);
					}
					$smallImagePath = $smallImageDir . $smallImageName;
					$smallImageFullName = $smallImageFullName . $smallImageName;

					if (move_uploaded_file($smallImageTmpPath, $smallImagePath)) {
						$response['smallImageFullName'] = $smallImageFullName;
					} else {
						$response['error'] .= "Ошибка при загрузке маленькой картинки\n";
					}
				}
			}
		} else {
			$response['smallImageFullName'] = str_replace('../', '', $_POST['old-small-image']);
		}

		if($response['error'] == null) {
			$filmId = $_POST['film-id'];

			$updateTitle = $_POST['update-title'];
			$updateCategory = $_POST['update-category'];
			$updateHeaderImage = $response['headerImageFullName'];
			$updateSmallImage = $response['smallImageFullName'];
			$updateDescription = $_POST['update-description'];
			$updateRating = $_POST['update-rating'];
			$updateGenre = $_POST['update-genre'];

			$oldTitle = $_POST['old-title'];
			$oldCategory = $_POST['old-category'];
			$oldHeaderImage = $_POST['old-header-image'];
			$oldSmallImage = $_POST['old-small-image'];
			$oldDescription = $_POST['old-description'];
			$oldRating = $_POST['old-rating'];
			$oldGenre = $_POST['old-genre'];

			$response['id'] = $filmId;
			$response['update_title'] = $updateTitle;
			$response['update_category'] = ($updateCategory === 'film') ? 'Фильм' : 'Сериал';
			$response['update_headerImageFullName'] = $updateHeaderImage;
			$response['update_smallImageFullName'] = $updateSmallImage;
			$response['update_description'] = $updateDescription;
			$response['update_rating'] = $updateRating;
			$response['update_genre'] = $updateGenre;

			$response['old_title'] = $oldTitle;
			$response['old_category'] = $oldCategory;
			$response['old_header_image'] = $oldHeaderImage;
			$response['old_small_image'] = $oldSmallImage;
			$response['old_description'] = $oldDescription;
			$response['old_rating'] = $oldRating;
			$response['old_genre'] = $oldGenre;

			include("../../common/connection.php");
			$resultSelect = mysqli_query($descr, "SELECT * FROM films WHERE title='$updateTitle' AND category='$updateCategory' AND id!=$filmId");
			if (mysqli_num_rows($resultSelect) > 0) {
				$response['error'] .= "Такой фильм уже есть\n";
			} else {
				mysqli_query($descr, "UPDATE films SET title='$updateTitle', category='$updateCategory', header_image='$updateHeaderImage', small_image='$updateSmallImage', rating=$updateRating WHERE id=$filmId");
				mysqli_query($descr, "UPDATE films_info SET description='$updateDescription', genre='$updateGenre' WHERE film_id=$filmId");
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>