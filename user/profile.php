<?php
	session_start();
	require_once '../login.php';
	// in case the user directly want's to access this page, php doesn't know whose profile to display
	//echo $_SESSION['user'];

	if(!isset($_SESSION['user'])) {$id_token = $_GET['email'];$image = $_GET['image'];$_SESSION['user'] = $id_token;
	$_SESSION['image'] = $image;}
	$image = $_SESSION['image'];

	// if($_SESSION['user']==="manageevents123@gmail.com") {
	// 	$_SESSION['loggedIn'] = true;
	// 	header("Location: add_keywords.php");
	// }
	//else {
	$_SESSION['loggedIn'] = true;
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UserDetails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Home</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Git <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <?php
                        if($_SESSION['loggedIn'] == true)
                            echo '<a class="nav-link" href="logout.php">Logout</a>';
                        else
                            echo '<a class="nav-link" href="logout.php">Logout</a>';
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="filter.php">
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>


<?php
// 	if(!isset($_SESSION['user'])){
// 	    echo <<< _END
// 	        <div>
// 	            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
// 	        </div>
// _END;
// 	    exit;
// 	}
// 	else if($_SESSION['loggedIn'] == false){
// 		echo <<< _END
// 			<div>
// 				<h1>You need to log in first.</h1>
// 			</div>
// _END;
// 		header('Refresh:01; url=../auth/auth.php');
// 		exit;
// 	}
// 	else{

		echo <<< _END
			<!DOCTYPE html>
			<html>
			<head>
			    <title>User Profile</title>
			</head>
			<body style="background-image: url('../attachments/calendar.jpg'); background-size: cover; background-repeat: no-repeat;">

			    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			    <link rel="stylesheet" href="style.css">
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
				<img src="{$image}" style="float: right; margin-right: 120px;">
				<div class="p-5 m-5">
					
					<div class="text-center">
						<a href="slot.php" class="p-3 m-3 btn btn-primary">Time Table</a>
					</div>
					</br>
					</br>
			    	<div class="text-center">
				    	<a href="update_preferences.php" class="p-3 m-3 btn btn-primary">Update Preferences</a>
				    	<a href="add_event.php" class="p-3 m-3 btn btn-primary">Add event</a>
				    </div>
					</br>
					</br>
					<div class="text-center">
				    	<a href="https://calendar.google.com/calendar/embed?src=manageevents123%40gmail.com&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Calendar</a>
				    	<a href="https://calendar.google.com/calendar/embed?src=dt7kcs78evt5eca4c25jbthcv0%40group.calendar.google.com&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Cultural</a>
				    	<a href="https://calendar.google.com/calendar/embed?src=2lu9o9ti61rdt8c9dvs0pkb2tg%40group.calendar.google.com&ctz=Asia%2FKolkata" class="p-3 m-3 btn btn-primary">Sports</a>
				    </div>
					</br>
					</br>

_END;
	// }
	if($_SESSION['user']=='manageevents123@gmail.com'){
		echo '<div class="text-center"><a href="add_keywords.php" class="p-3 m-3 btn btn-primary">Add keywords</a></div>';
	}
	echo '</div>
		</body>
	</html>'

?>

