<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$response = [];
		$commentId = $_POST['id'];
		$userName = $_POST['user_name'];
		$filmTitle = $_POST['film_title'];

		$response['id'] = $commentId;
		$response['user_name'] = $userName;
		$response['film_title'] = $filmTitle;

		include("../../common/connection.php");

		$film_ids = [];
        $count = 0;
        $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE id=$commentId");
        while($array = mysqli_fetch_array($result)) {
            $film_ids[$count] = $array['film_id'];
            $count += 1;
        }
        $query = mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE id=$commentId");
        for($i = 0; $i < $count; $i += 1) {
            $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE film_id=$film_ids[$i]");
            $sum = 0;
            while($array = mysqli_fetch_array($result)) {
                $sum += floatval($array['rating']);
                $count += 1;
            }
            $sum = number_format($sum / $count, 1);
            $query = mysqli_query($descr, "UPDATE films SET rating=$sum WHERE id=$film_ids[$i]");
        }

		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		echo json_encode(['error' => 'Неверный метод запроса']);
	}
?>