<?php
	session_start();
	require_once '../login.php';

	$conn = mysqli_connect($hostname, $username, $password, $database);
	if(!$conn){
		die("Error connecting database. Please try later.");
		exit();
	}

	// in case the user directly want's to access this page, php doesn't know whose profile to display
	if(!isset($_SESSION['user'])){
	    echo <<< _END
	        <div>
	            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
	        </div>
	_END;
	    exit;
	}
	else if($_SESSION['loggedIn'] == false){
		echo <<< _END
			<div>
				<h1>You need to log in first.</h1>
			</div>
		_END;
		header('Refresh:01; url=../auth/auth.php');
		exit;
	}
	else{
		$query = "SELECT * FROM email_ids WHERE email='{$_SESSION['user']}'";
		$result = mysqli_query($conn, $query);

		$num_of_rows = mysqli_num_rows($result);
		// echo $num_of_rows;
		// echo $query;

		$chosen_preferences = mysqli_fetch_row($result)[1];
		$chosen_preferences = explode(",",$chosen_preferences);
		// print_r($chosen_preferences);
		$keyword_query = "SELECT COUNT(*) FROM keywords";

		$num_of_keywords = mysqli_query($conn, $keyword_query);
		$num_of_keywords = (int)mysqli_fetch_row($num_of_keywords)[0];
		// print_r($num_of_keywords);

		$all_keywords_query = "SELECT keyword FROM keywords";
		$all_keywords_result = mysqli_query($conn, $all_keywords_query);

		echo "<form mehod='post' action='update_preferences_table.php' >";
			for($i=0;$i<$num_of_keywords;$i++){
				$cur_row = mysqli_fetch_row($all_keywords_result);
				// print_r($cur_row);
				// echo "{$cur_row[0]} <br>";
				$present = in_array($cur_row[0], $chosen_preferences);

				if($present)
					echo "{$cur_row[0]} <input type='checkbox' name='{$i}'  value='{$cur_row[0]}' checked /> <br> ";
				else 
					echo "{$cur_row[0]} <input type='checkbox' name='{$i}'  value='{$cur_row[0]}' /> <br> ";

			}
			echo "<button type='submit'>Save</button>";
		echo "</form>";

	}

?>
