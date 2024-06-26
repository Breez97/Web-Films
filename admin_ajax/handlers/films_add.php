<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$headerImageFullName = 'films_images/header_images/';
		$smallImageFullName = 'films_images/small_images/';
		$response = [];
		$response['error'] = NULL;

		if (isset($_FILES['header-image'])) {
			$headerImageTmpPath = $_FILES['header-image']['tmp_name'];
			$headerImageName = basename($_FILES['header-image']['name']);
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
		}

		if (isset($_FILES['small-image'])) {
			$smallImageTmpPath = $_FILES['small-image']['tmp_name'];
			$smallImageName = basename($_FILES['small-image']['name']);
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
		}

		if($response['error'] == NULL) {
			$response['title'] = $_POST['new-title'];
			$response['category'] = $_POST['new-category'];
			$response['description'] = $_POST['new-description'];
			$response['rating'] = $_POST['new-rating'];
			$response['genre'] = $_POST['new-genre'];

			if (empty($response['description'])) {
				$response['error'] .= "Описание не должно быть пустым\n";
			}

			include("../../common/connection.php");

			$newTitle = $response['title'];
			$newHeaderImage = $response['headerImageFullName'];
			$newSmallImage = $response['smallImageFullName'];
			$newRating = $response['rating'];
			$newDescription = $response['description'];
			$newGenre = $response['genre'];
			$newCategory = $response['category'];
			$response['category'] = ($newCategory == 'film') ? "Фильм" : "Сериал";

			$resultSelect = mysqli_query($descr, "SELECT * FROM films WHERE title='$newTitle' AND category='$newCategory'");
			if (mysqli_num_rows($resultSelect) > 0) {
				$response['error'] .= "Такой фильм уже добавлен\n";
			} else {
				$resultInsert = mysqli_query($descr, "INSERT INTO films(id, title, category, header_image, small_image, rating) VALUES (NULL, '$newTitle', '$newCategory', '$newHeaderImage', '$newSmallImage', '$newRating')");
				if (!$resultInsert) {
					$response['error'] .= "Ошибка при вставке данных в таблицу films\n";
				} else {
					$last_id = mysqli_insert_id($descr);
					$resultInsertInfo = mysqli_query($descr, "INSERT INTO films_info (id, film_id, description, genre) VALUES (NULL, $last_id, '$newDescription', '$newGenre')");
					if (!$resultInsertInfo) {
						$response['error'] .= "Ошибка при вставке данных в таблицу films_info:\n";
					} else {
						$response['id'] = $last_id;
					}
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>
