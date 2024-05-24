<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$response = [];
		$response['error'] = NULL;

		$userId = $_POST['user-id'];
		$updateName = $_POST['update-name'];
		$updateLogin = $_POST['update-login'];
		if (strlen($updateLogin) < 5) {
			$response['error'] .= "Длина логина должна быть не менее 5 символов. ";
		}
		$updatePassword = $_POST['update-password'];
		if (strlen($updatePassword) < 5) {
			$response['error'].= "Длина пароля должна быть не менее 5 символов. ";
		}
		$updateEmail = $_POST['update-email'];
		if (strpos($updateEmail, '@') === false) {
			$response['error'].= "Неверная запись почты. ";
		}
		$updateAdmin = $_POST['update-admin'];

		if ($response['error'] == NULL) {
			$oldName = $_POST['old-name'];
			$oldLogin = $_POST['old-login'];
			$oldPassword = $_POST['old-password'];
			$oldEmail = $_POST['old-email'];
			$oldAdmin = $_POST['old-admin'];

			$response['id'] = $userId;
			$response['update_name'] = $updateName;
			$response['update_login'] = $updateLogin;
			$response['update_password'] = $updatePassword;
			$response['update_email'] = $updateEmail;
			$response['update_admin'] = ($updateAdmin === '1') ? 'Yes' : 'No';

			$response['old_name'] = $_POST['old-name'];
			$response['old_login'] = $_POST['old-login'];
			$response['old_password'] = $_POST['old-password'];
			$response['old_email'] = $_POST['old-email'];
			$response['old_admin'] = $_POST['old-admin'];

			include("../../common/connection.php");
			$resultSelect = mysqli_query($descr, "SELECT * FROM users WHERE (login='$updateLogin' OR email='$updateEmail') AND id != $userId");
			if (mysqli_num_rows($resultSelect) > 0) {
				$response['error'] = "Такой пользователь уже есть\n";
			} else {
				mysqli_query($descr, "UPDATE users SET is_admin=$updateAdmin, name='$updateName', login='$updateLogin', password='$updatePassword',email='$updateEmail' WHERE id=$userId");
			}
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>