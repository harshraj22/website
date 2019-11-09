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

		$keyword_query = "SELECT COUNT(*) FROM keywords";

		$num_of_keywords = mysqli_query($conn, $keyword_query);
		$num_of_keywords = (int)mysqli_fetch_row($num_of_keywords)[0];
		// print_r($num_of_keywords);

		$all_keywords_query = "SELECT keyword FROM keywords";
		$all_keywords_result = mysqli_query($conn, $all_keywords_query);

		$final_keyword = "";

		for($i=0;$i<$num_of_keywords;$i++){
			// iterate over all keywords
			$cur_row = mysqli_fetch_row($all_keywords_result);
			// cur_row = currently iterating checkbox
			
			if(isset($_GET["{$i}"])){
				// if checked, make it into email
				if(empty($final_keyword) == true)
					$final_keyword = "{$cur_row[0]}";
				else 
					$final_keyword = $final_keyword.",{$cur_row[0]}";

				$cur_key_res = mysqli_query($conn, "SELECT * FROM email_ids WHERE email='{$_SESSION['user']}'");
				// keywords of cur user
				$cur_key = mysqli_fetch_row($cur_key_res)[1];

				// if checked key does not exist
				if(strpos($cur_key, $cur_row[0]) === false){
					$cur_row_emails = mysqli_query($conn, "SELECT * FROM keywords WHERE keyword='{$cur_row[0]}'");
					$cur_row_emails = mysqli_fetch_row($cur_row_emails)[1];
					echo $cur_key;
					// if(empty($cur_key) == false)
					if(empty($cur_row_emails) == false)
						$cur_row_emails = $cur_row_emails.",{$_SESSION['user']}";
					else 
						$cur_row_emails = "{$_SESSION['user']}";

					echo $cur_row_emails;
					mysqli_query($conn, "UPDATE keywords SET emails='{$cur_row_emails}' WHERE keyword='{$cur_row[0]}'");

				}
				// else if(){

				// }
			}
			// if unchecked key exist
			else{
				// keyword not checked
				$cur_key_res = mysqli_query($conn, "SELECT * FROM email_ids WHERE email='{$_SESSION['user']}'");
				// keywords of cur user
				$cur_key = mysqli_fetch_row($cur_key_res)[1];

				// if unchecked key exists
				if(strpos($cur_key, $cur_row[0]) !== false){
					$cur_row_emails = mysqli_query($conn, "SELECT * FROM keywords WHERE keyword='{$cur_row[0]}'");
					$cur_row_emails = mysqli_fetch_row($cur_row_emails)[1];
					$var = explode(",", $cur_row_emails);
					// array of keywords
					$index = array_search($_SESSION['user'], $var);
					unset($var[$index]);
					$final = implode(",",$var);

					mysqli_query($conn, "UPDATE keywords SET emails='$final' WHERE keyword='{$cur_row[0]}'");

				}
			}

		}
		// echo $final_keyword;
		$update_query = "UPDATE email_ids SET email='{$_SESSION['user']}', keywords='{$final_keyword}' WHERE email='{$_SESSION['user']}'";
		$update_result = mysqli_query($conn, $update_query);

		if($update_result)
			echo "Successfully updated<br>";
		else 
			echo "Error while updating<br>".mysqli_error($conn);

		$keywords_update_query = "SELECT * FROM keywords";
		$keywords_update_res = mysqli_query($conn, $keywords_update_query);



	}

?>
