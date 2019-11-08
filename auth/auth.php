 
<?php
	session_start();
	require_once "../login.php";

	// If this page was requested for first time, username and password in html form won't be set
	if(!isset($_POST['username']) || !isset($_POST['pass'])){
        echo <<< _END
        
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="index.css">

			<!-- =====================input form================== -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
						<form method='POST' action='' enctype='multipart/form-data'>
							<div class="form-group row-md-2">    
								Username: <input type='text' name='username' class="form-control" placeholder="username" required>
								<br>
								Password: <input type='password' name='pass' class="form-control" placeholder="password" required>
							</div>
								<input type='submit' class="btn btn-primary">
						</form>
					</div>
                </div>
            </div>

_END;
	}

	else{
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn)
            die("Error while connectine. Try later. <br>".mysqli_connect_error());

        $currentUserName = trim($_POST['username']);
        $currentUserPass = trim($_POST['pass']);

        $user_query = "SELECT * FROM auth WHERE username='{$currentUserName}' AND password='{$currentUserPass}'";
        $user_result = mysqli_query($conn, $user_query);

        if(!$user_result)
            die("Error matching credentials. Please try later.<br>".mysqli_error($conn));
        else if(mysqli_num_rows($user_result) == 0){
            echo "Username and password doesn't match.<br>";
        }
        else{
            $_SESSION['user'] = $currentUserName;
            $_SESSION['loggedIn'] = true;
            echo "Successfully Logged In. Redirecting to Profile.<br>";
            $data = mysqli_fetch_row($user_result);
            header('Refresh:01; url=../user/profile.php');
        }
    }

?>