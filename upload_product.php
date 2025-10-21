<?php
// Koppla till databasen
$servername = "localhost";
$username = "root"; // eller din databas användarnamn
$password = ""; // din databas lösenord
$dbname = "bilbarnstolar";

// Skapa anslutning
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollera anslutningen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hämta inlämnad data
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];

// Spara bilden
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$image_url = 'uploads/' . $image;  // Mapp där bilder lagras
move_uploaded_file($image_tmp, $image_url);

// Lägg till produkt i databasen
$sql = "INSERT INTO products (title, description, price, image_url) VALUES ('$title', '$description', '$price', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "Produkt uppladdad!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Stäng databaskopplingen
$conn->close();
?>
