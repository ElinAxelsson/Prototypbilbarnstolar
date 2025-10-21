<?php
session_start();

// Om användaren redan är inloggad, omdirigera till kartan
if (isset($_SESSION['user_id'])) {
    header('Location: friends-map.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Här skulle du kontrollera användarnamn och lösenord (det här är bara ett exempel)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Här ska du kolla användarnamn och lösenord mot din databas
    if ($username == 'admin' && $password == 'password') {  // Här använder vi exempelvärden
        // Starta session och sätt inloggad användare
        $_SESSION['user_id'] = $username;  // Du kan spara användarens ID i sessionen
        header('Location: friends-map.php');  // Omdirigera till kartan
        exit();
    } else {
        $error_message = 'Fel användarnamn eller lösenord';
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
</head>
<body>
    <h1>Logga in</h1>
    <form action="login.php" method="POST">
        <label for="username">Användarnamn:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Lösenord:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit">Logga in</button>
    </form>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <p>Har du inget konto? <a href="register.php">Registrera dig här</a></p>
</body>
</html>
