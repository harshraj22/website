<?php
	//just for testing remove afterwards
	session_start();
	//$_SESSION['user'] = "default";
	$_SESSION['logged'] = true;
?>
<html>
<head>
	<title>
		Add_event
	</title>
</head>

<body>
	<fieldset value="hi" style= "width:60%">
	<legend>ADD EVENTS</legend>
	<form method="POST" action="add_event_backend.php">
		<br><br>
		<legend>Title of the event</legend>
		<input type="text" name="title" placeholder="Title" required>
		<br><br>
		<legend>Date</legend>
		<input type="date" name="date" required>
		<br><br>
		<legend>Link</legend>
		<input type="text" name="link" placeholder="link">
		<br><br><br>
		<legend>Select the keywords</legend>
		<?php 
			require_once '../login.php';

			function Error($errno,$errstr){
				echo "<script type='text/javascript'>alert('ERROR : $errstr');</script>;";
				die();
			}
			set_error_handler("Error");


			$conn = mysqli_connect($hostname,$username,$password);
			if(!$conn){
				trigger_error("1".mysqli_connect_error());
			}

			$query = "use mailmaintainer";
			$result = mysqli_query($conn,$query);
			if(!$result){
				trigger_error("2".mysqli_connect_error());
			}

			$query = "select * from keywords";
			$result = mysqli_query($conn,$query);
			if(!$result){
				trigger_error("3".mysqli_connect_error());
			}

			$numrows = mysqli_num_rows($result);
			while($row = mysqli_fetch_row($result)){
				echo "<input type='checkbox' name='checklist[]' value='$row[0]'>$row[0]<br>";
				 //mysqli_free_result($result);
			}


		//echo'<input type="checkbox" name="checklist[]" value="academics">Academics<br>'
		?>
		<br>
		<br>
		<legend>Describtion</legend>
		<textarea name="body" rows="5" cols="80%" >This event is about...</textarea>
		<br><br>
		<center><input type="submit" value="Submit!"></center>
	</form>
	</fieldset>
</body>
</html>
