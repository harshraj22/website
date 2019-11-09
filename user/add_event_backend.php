<?php

	require_once '../login.php';

	function Error($errno,$errstr){
		echo "<script type='text/javascript'>alert('ERROR : $errstr');</script>;";
		die();
	}
	set_error_handler("Error");

	session_start();
	$user = $_SESSION['user'];
	$logged = $_SESSION['logged'];
	
	if($logged==false){
		echo "<script type='text/javascript'>alert('Session retired! Please login again'); window.location.href = './add_event.php'; </script>";
		//this should redirect to login form
	}

	$title = NULL;
	$title = $_POST['title'];
	if($title==NULL){
		echo "<script type='text/javascript'>alert('You must write title of the event! '); window.location.href = './add_event.php'; </script>";
	}
	
	$date = NULL;
	$date = $_POST['date'];
	if($date==NULL){
		echo "<script type='text/javascript'>alert('Select a date! '); window.location.href = './add_event.php'; </script>";
	}

	$body = $_POST['body'];
	$link = $_POST['link'];

	$string = "";
	$firstcommaerror = 0;
	if(!empty($_POST['checklist'])){
		foreach ($_POST['checklist'] as $value) {
			if(!$firstcommaerror){
				$string = $value;
				$firstcommaerror = 1;
			}
			else{
				$string = $string .",".$value;
			}
		}
	}

	if($string==""){
		echo "<script>alert('Must select atleast one tag!'');window.location.href = './add_event.php'; </script>";
	}

	$conn = mysqli_connect($hostname,$username,$password);
	if(!$conn){
		echo "error";
		die();
		trigger_error("1".mysqli_connect_error());
	}

	$query = "use mailmaintainer";
	$result = mysqli_query($conn,$query);
	if(!$result){
		trigger_error("2".mysqli_connect_error());
	}

	$query = "select * from events where date = '{$date}' and title = '{$title}'";
	$result = mysqli_query($conn,$query);
	$num_rows = mysqli_num_rows($result);
	if($num_rows!=0){
		echo "<script type='text/javascript'>alert('Event already exists!'); window.location.href = './add_event.php'; </script>";
	}


	$query = "insert into events values ('{$date}','{$title}','{$body}','{$link}','{$string}','{$user}')";
	$result = mysqli_query($conn,$query);
	if(!$result){
		trigger_error("3".mysqli_connect_error());
	}

	echo "Event successfully added !!";	
	header("Refresh:01 ; url='profile.php'");
	
?>
