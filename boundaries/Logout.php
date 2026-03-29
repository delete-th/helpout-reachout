<?php
// boundaries/Logout.php
session_start();

// Clear all session data
session_unset();
session_destroy();

// Redirect to login page with a session flag for showing the popup
session_start(); // start session again to set the flag
$_SESSION['logout_success'] = true;

header("Location: index.php?action=Login");
exit();
?>
