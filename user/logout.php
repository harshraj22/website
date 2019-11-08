<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="../auth/auth.php">Go back</a>';
?>
