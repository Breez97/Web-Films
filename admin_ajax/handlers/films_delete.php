<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$response = [];
		$filmId = $_POST['id'];
		$filmTitle = $_POST['title'];
		$response['id'] = $filmId;
		$response['title'] = $filmTitle;

		include("../../common/connection.php");

		mysqli_query($descr, "DELETE FROM films WHERE films.id=$filmId");
		mysqli_query($descr, "DELETE FROM films_info WHERE film_id=$filmId");
		mysqli_query($descr, "DELETE FROM favourites WHERE film_id=$filmId");
		mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE film_id=$filmId");

		header('Content-Type: application/json');
		echo json_encode($response);
	}
?>