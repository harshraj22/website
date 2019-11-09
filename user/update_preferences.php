<?php
	session_start();
	require_once '../login.php';

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

    <div class="container p-5 m-5">
		<?php
			$conn = mysqli_connect($hostname, $username, $password, $database);
			if(!$conn){
				die("Error connecting database. Please try later.");
				exit();
			}

			// in case the user directly want's to access this page, php doesn't know whose profile to display
			if(!isset($_SESSION['user'])){
			    echo <<< _END
			        <div class='container'>
			            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
			        </div>
			_END;
			    exit;
			}
			else if($_SESSION['loggedIn'] == false){
				echo <<< _END
					<div class='container'>
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
							echo "{$cur_row[0]} <input type='checkbox' name='{$i}'  value='{$cur_row[0]}' class='p-2 m-2' checked /> <br> ";
						else 
							echo "{$cur_row[0]} <input type='checkbox' name='{$i}'  value='{$cur_row[0]}' class='p-2 m-2' /> <br> ";

					}
					echo "<button type='submit' class='m-2'>Save</button>";
				echo "</form>";

			}

		?>
	</div>

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    

</body>
</html>
