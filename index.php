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

// Hämta produkter från databasen
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Köp och Sälj Bilbarnstolar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Välkommen till Köp och Sälj Bilbarnstolar</h1>
        <nav>
            <ul>
                <li><a href="#products">Produkter</a></li>
                <li><a href="#sell">Sälj din Bilbarnstol</a></li>
                <li><a href="#contact">Kontakt</a></li>
            </ul>
        </nav>
    </header>

    <section id="products">
        <h2>Till Salu</h2>

        <?php
        // Kontrollera om det finns några produkter
        if ($result->num_rows > 0) {
            // Visa produkter
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["image_url"] . "' alt='Bilbarnstol'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p>" . $row["description"] . "</p>";
                echo "<p>Pris: " . $row["price"] . " kr</p>";
                echo "<a href='#'>Köp nu</a>";
                echo "</div>";
            }
        } else {
            echo "Inga produkter tillgängliga.";
        }

        // Stäng databaskopplingen
        $conn->close();
        ?>
    </section>

    <section id="sell">
        <h2>Sälj din Bilbarnstol</h2>
        <form action="upload_product.php" method="post" enctype="multipart/form-data">
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="description">Beskrivning:</label>
            <textarea id="description" name="description" required></textarea><br>

            <label for="price">Pris:</label>
            <input type="number" id="price" name="price" required><br>

            <label for="image">Bild:</label>
            <input type="file" id="image" name="image" required><br>

            <button type="submit">Lägg upp Produkt</button>
        </form>
    </section>

    <footer id="contact">
        <p>Kontaktinformation: <a href="mailto:info@exempel.com">info@exempel.com</a></p>
    </footer>
</body>
</html>
