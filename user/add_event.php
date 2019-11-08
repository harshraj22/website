<?php
	//just for testing remov afterwards
	session_start();
	//echo $_SESSION['user'];
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
		<input type="text" name="title" placeholder="Title">
		<br><br>
		<legend>Date</legend>
		<input type="date" name="date" >
		<br><br>
		<legend>Link</legend>
		<input type="text" name="link" placeholder="link">
		<br><br><br>
		<legend>Select the keywords</legend>
		<input type="checkbox" name="checklist[]" value="academics">Academics<br>
		<input type="checkbox" name="checklist[]" value="sports">Sports<br>
		<input type="checkbox" name="checklist[]" value="cultural">Cultural<br>
		<input type="checkbox" name="checklist[]" value="talk">Talk<br>
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
