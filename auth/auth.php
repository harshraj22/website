 
<?php
	session_start();
	require_once "../login.php";

	// If this page was requested for first time, username and password in html form won't be set
    if(!isset($_POST['idtoken'])){
        echo <<< _END
            <html>
            <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" href="index.css">
                <meta name="google-signin-client_id" content="22046108295-tm5jl58sabcn5q8475veo04shonrs5va.apps.googleusercontent.com">
                <meta name="google-signin-scope" content="profile email">
            </head>

            <!-- =====================input form================== -->
            <body>
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
                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                <form type='post' action='http://localhost/website/website/user/profile.php'>
                    <input type='hidden' id='idtoken' name='email'>
                    <input type='hidden' id='image' name='image'>
                    <input type='submit' id='submit' style='display: none;'>
                </form>
                <script src="https://apis.google.com/js/platform.js"></script>
                <script>
                function onSignIn(googleUser) {
                    // Useful data for your client-side scripts:
                    var profile = googleUser.getBasicProfile();
                    console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                    console.log('Full Name: ' + profile.getName());
                    console.log('Given Name: ' + profile.getGivenName());
                    console.log('Family Name: ' + profile.getFamilyName());
                    console.log("Image URL: " + profile.getImageUrl());
                    console.log("Email: " + profile.getEmail());

                    // The ID token you need to pass to your backend:
                    var id_token = googleUser.getAuthResponse().id_token;
                    console.log("ID Token: " + id_token);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'auth.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                    console.log('Signed in as: ' + xhr.responseText);
                    };
                    xhr.send('idtoken=' + id_token);
                    document.getElementById('idtoken').value=profile.getEmail();
                    document.getElementById('image').value=profile.getImageUrl();
                    document.getElementById('submit').click();
                }
                </script>
            </body>
            </html>

_END;
	}

	else{
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if(!$conn)
            die("Error while connectine. Try later. <br>".mysqli_connect_error());

        require_once '../auth/vendor/autoload.php';

        // Get $id_token via HTTPS POST.
        $id_token = $_POST['idtoken'];
        $CLIENT_ID = "22046108295-tm5jl58sabcn5q8475veo04shonrs5va.apps.googleusercontent.com";

        $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $userid = $payload['sub'];
            echo "success";
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
        } else {
        // Invalid ID token
            echo "failure";
        }
    }

?>