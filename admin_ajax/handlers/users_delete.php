<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$response = [];
		$userId = $_POST['id'];
		$userName = $_POST['name'];
		$response['id'] = $userId;
		$response['name'] = $userName;

		include("../../common/connection.php");

		$query = mysqli_query($descr, "DELETE FROM users WHERE id=$userId");
        $query = mysqli_query($descr, "DELETE FROM favourites WHERE user_id=$userId");
        $film_ids = [];
        $count = 0;
        $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE user_id=$userId");
		while($array = mysqli_fetch_array($result)) {
            $film_ids[$count] = $array['film_id'];
            $count += 1;
        }
		$query = mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE user_id=$userId");
		for($i = 0; $i < $count; $i += 1)
        {
            $result = mysqli_query("SELECT * FROM comments_and_ratings WHERE WHERE film_id=$film_ids[$i]");
            $sum = 0;
            while($array = mysqli_fetch_array($result))
            {
                $sum += floatval($array['rating']);
                $count += 1;
            }
            $sum = number_format($sum / $count, 1);
            mysqli_query($descr, "UPDATE films SET rating=$sum WHERE id=$film_ids[$i]");
        }
		
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>