<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$response = [];
		$response['error'] = NULL;

		$newName = $_POST['new-name'];
		$newLogin = $_POST['new-login'];
		if (strlen($newLogin) < 5) {
			$response['error'] .= "Длина логина должна быть не менее 5 символов. ";
		}
		$newPassword = $_POST['new-password'];
		if (strlen($newPassword) < 5) {
			$response['error'] = "Длина пароля должна быть не менее 5 символов. ";
		}
		$newEmail = $_POST['new-email'];
		if (strpos($newEmail, '@') === false) {
			$response['error'] = "Неверная запись почты. ";
		}
		$newAdmin = $_POST['new-admin'];

		if ($response['error'] == NULL) {
			$response['name'] = $newName;
			$response['login'] = $newLogin;
			$response['password'] = $newPassword;
			$response['email'] = $newEmail;
			$response['admin'] = ($newAdmin == '1') ? 'Yes' : 'No';

			include("../../common/connection.php");
			$resultSelect = mysqli_query($descr, "SELECT * FROM users WHERE login='$newLogin' OR email='$newEmail'");
			if (mysqli_num_rows($resultSelect) > 0) {
				$response['error'][] = "Такой пользователь уже добавлен";
			} else {
				$resultInsert = mysqli_query($descr, "INSERT INTO users(id, is_admin, name, login, password, email) VALUES (NULL, $newAdmin, '$newName', '$newLogin', '$newPassword', '$newEmail')");
				$resultSelectLastId = mysqli_query($descr, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
				while ($array = mysqli_fetch_array($resultSelectLastId)) {
					$response['id'] = $array['id'];
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>
