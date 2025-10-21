<?php
session_start();
session_unset();  // Rensa alla sessioner
session_destroy();  // Zappa sessionen
header('Location: login.php');  // Omdirigera till login-sidan
exit();
?>
