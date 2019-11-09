<?php
	session_start();
	require_once '../login.php';

	if(!isset($_SESSION['user']) || $_SESSION['user'] != 'manageevents123@gmail.com' || $_SESSION['loggedIn'] == false){
		die("<h2> The page you requested doesn't exists.</h2>");
		header("Refresh:01; url='profile.php'");
	}

	if(!isset($_POST['submit'])){
		// display form with submit button
		echo <<< _END
			<form method='POST' action='add_keywords.php'>
				<input type='text' name='key'>
				<input type='submit' name='submit' value='submit'>
			</form>
_END;
	}
	else{
		$conn = mysqli_connect($hostname, $username, $password, $database);
		if(!$conn){
			die("Error connecting database. Please try later.");
			exit();
		}

		$newKey = $_POST['key'];

		$check_existing_query = "SELECT COUNT(*) FROM keywords WHERE keyword='{$newKey}'";
		$check_existing_result = mysqli_query($conn, $check_existing_query);
		// print_r($check_existing_result);

		// $num_of_rows = mysqli_num_rows($check_existing_result);
		$check_existing_result = mysqli_fetch_row($check_existing_result);
		$num_of_rows = (int)$check_existing_result[0];
		// echo $num_of_rows.$check_existing_query;

		if($num_of_rows != 0){
			echo "<h2>Given tag already exists.</h2><br>";
			header("Refresh:01; url='profile.php'");
			exit;
		}

		$insert_given_tag = "INSERT INTO keywords VALUES('{$newKey}','')";
		if(mysqli_query($conn, $insert_given_tag)){
			echo "<h1>Successfully updated the given keyword.</h1><br>";
		}
		else
			echo "<h1>Error updating the given keyword.</h1><br>";
		header("Refresh:01; url='profile.php'");
	}
	echo <<<_END
	<div class="row">
		<a href="logout.php" class="p-3 m-3 btn btn-primary">Logout</a>
	</div>

_END;
?>
