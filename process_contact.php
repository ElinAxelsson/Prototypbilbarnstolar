<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // E-postinställningar
    $to = "dinemail@example.com";  // Byt ut mot din egen e-postadress
    $subject = "Nytt meddelande från kontaktsidan";
    $headers = "Från: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Meddelandets innehåll
    $email_body = "Namn: $name\n";
    $email_body .= "E-post: $email\n\n";
    $email_body .= "Meddelande:\n$message\n";

    // Skicka e-postmeddelandet
    if (mail($to, $subject, $email_body, $headers)) {
        echo "<h1>Tack, $name!</h1>";
        echo "<p>Ditt meddelande har skickats.</p>";
    } else {
        echo "<h1>Ett fel uppstod!</h1>";
        echo "<p>Vi kunde tyvärr inte skicka ditt meddelande. Försök igen senare.</p>";
    }
} else {
    echo "Något gick fel. Försök igen.";
}
?>
