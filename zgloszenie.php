<?php

$sukces = false; //false, bo nic nie wyslano

if ($_SERVER["REQUEST_METHOD"] == "POST") { //sprawdzenie czy sie kliknelo w wyslij 

$servername = "localhost";  //klucze do xamppa
$username = "root";
$password = "";
$dbname = "serwer_tpsi";

$conn = new mysqli($servername, $username, $password, $dbname); //otwieranie polaczenia z baza
$conn ->set_charset("utf8");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);  //jak bedzie blad to pokaze ten komunikat
}

$sprzet = $_POST['sprzet'];
$opis = $_POST['opis'];

$stmt = $conn->prepare("INSERT INTO zgloszenia (nazwa_sprzetu, opis_usterki) VALUES (?, ?)"); //ZABEZPIECZENIE, nie daje znakow bezposrednio, tylko ?
$stmt->bind_param("ss", $sprzet, $opis); // w znaki zapytania daje sprzet i opis

if ($stmt->execute()) {
    $sukces = true; //jak sie uda zapisac to na true 
} else {
    echo "Błąd: " . $stmt->error;
}

$stmt->close(); //zamykanie polaczenia z baza
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zgłoszenie</title>
        <link rel="stylesheet" href="2_css/style.css">

    </head>

    <body class="body-formularz">

        <div class="form-container">

            <?php if ($sukces == true): ?>

                <h1>Zgłoszenie zostało przyjęte</h1>
                <p>Zgłoszenie zostało poprawnie zapisane w systemie.</p>

                <div class="summary-box">
                    <strong>Sprzęt:</strong> <?php echo htmlspecialchars($sprzet); ?><br><br>
                    <strong>Opis Usterki:</strong><br>
                    <?php echo htmlspecialchars($opis); ?> 
                </div>

                <a href="index.html" class="btn">Wróć do strony głównej</a>

                <?php else: ?>

                    <a href="index.html" class="btn-back">⬅Wróć do mapy szpitala</a>

                    <h2>Zgłoś awarię</h2>
                    <p>Wypełnij formularz zgłoszeniowy.</p>

                    <form action="" method="POST">

                    <label>Nazwa Sprzętu:</label>
                    <input type="text" name="sprzet" placeholder="np. Defibrylator" required>

                    <label>Opis Usterki:</label>
                    <textarea name="opis" rows="5" placeholder="Opisz usterkę" required></textarea>

                    <input type="submit" value="Wyślij zgłoszenie">

                    </form>

                    <?php endif; ?>
                
        </div>

    </body>

</html>
