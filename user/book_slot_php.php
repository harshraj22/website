<?php
	session_start();
	require_once '../login.php';
    //echo $_POST['book'];
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

    $new = $_POST['book'];
    //echo $new;
    //echo $_POST['branch'];
    $branch = $_POST['branch'];
    if(isset($_POST['book'])){
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn){
            die("Error connecting database. Please try later.");
            exit();
        }
        else {
            $query = 'SELECT * FROM temp_table WHERE time="'.$_POST['book'].'"';
            $result = mysqli_query($conn, $query);
            $num_of_rows = mysqli_num_rows($result);
            //echo $num_of_rows;
            //echo $new;
            //$query = 'UPDATE temp_table SET branch="'.$_POST["branch"].'" WHERE time="'.$_POST['book'].'"';
            //$result = mysqli_query($conn, $query);
            //$num_of_rows = mysqli_num_rows($result);
            mysqli_query($conn, 'UPDATE temp_table SET branch="'.$branch.'" WHERE time="'.$new.'"');
            echo "successfully booked";

        }
    }





?>
