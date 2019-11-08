<?php
	session_start();
	require_once '../login.php';
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
		echo <<< _END
			<!DOCTYPE html>
			<html>
			<head>
			    <title>User Profile</title>
			</head>
			<body>

			    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			    <link rel="stylesheet" href="style.css">
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

			    <div class="container p-5 m-5">
			    	<div class="row">
				    	<a href="update_preferences.php" class="p-3 m-3 btn btn-primary">Update Preferences</a>
				    	<a href="myCalander.php" class="p-3 m-3 btn btn-primary">My calander</a>
				    	<a href="add_event.php" class="p-3 m-3 btn btn-primary">Add event</a>
				    </div>
					</br>
					</br>
					<div class="row">
				    	<a href="https://calendar.google.com/calendar/embed?src=180010012%40iitdh.ac.in&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Calendar</a>
				    	<a href="https://calendar.google.com/calendar/embed?src=iitdh.ac.in_kg93fmiu87ft3grqjva0r0fd8s%40group.calendar.google.com&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Cultural</a>
				    	<a href="https://calendar.google.com/calendar/embed?src=iitdh.ac.in_onf4cdo18u684mqofapld4j2og%40group.calendar.google.com&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Sports</a>
				    </div>
			    </div>

			</body>
			</html>

_END;
	}

?>
