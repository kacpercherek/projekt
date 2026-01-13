<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewort" content="width=device-witdth, initial-scale=1.0">
        <title>Potwierdzenie zgłoszenia</title>
        <link rel="stylesheet" href="2_css/style.css">
    </head>

    <body class="body-formularz">

        <div class="card">

            <?php
            
            $servername = "localhost";     //połaczenie z baza
            $username = "root";
            $password = "";
            $dbname = "serwer_tpsi";

            $conn = new mysqli($servername, $username, $password, $dbname);

            $conn->set_charset("utf8"); //kodowanie utf8 dla polskich znakow

            if ($conn->connect_error) {
               die("<p class='error-msg'>Połączenie nieudane: " . $conn->connect_error . "</p>");   //takie ala zabezpieczenie? "sprawdzenie" poprawnosci polaczenia
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") { //odbiera dane z formularza 
                $sprzet = $_POST['sprzet'];
                $opis = $_POST['opis'];

                $stmt = $conn->prepare("INSERT INTO zgloszenia (nazwa_sprzetu, opis_usterki) VALUES (?, ?)"); //tworzenie zapytania do SQLa
                $stmt->bind_param("ss", $sprzet, $opis);

                if ($stmt->execute()) {
                    echo "<div class='icon-success'></div>"; //zielony haczyk
                    echo "<h1>Zgłoszenie zostało przyjęte.</h1>"; // nagłówek, ze sie udalo 
                    echo "<p>Zgłoszenie zostało poprawnie zapisane w systemie.</p>";

                    echo "<div class='summary-box'>"; //okienko z podsumowaniem co zostalo wpisane
                    
                    echo "<strong>Sprzęt:</strong> " . htmlspecialchars($sprzet) . "<br><br>"; //special chars chroni przed wpisywaniem znakow specjalnych-zamienia na zwykly tekst
                    echo "<strong>Opis Usterki:</strong><br>" . htmlspecialchars($opis);
                    echo "</div>";

                    echo "<a href='index.html' class='btn'>Wróc do strony głównej</a>"; //przycisk do powrotu na main
                } else {   //co jak bedzie blad zapisu
                    echo "<h2 style='color:red'>Wystąpił błąd.</h2>";
                    echo "<p>Nie udało się zapisać zgłoszenia. </p>";
                    echo "<p class='error-msg'>" . $stmt->error . "</p>"; //dokladny blad z bazy danych
                    echo "<a href='usterka.php' class='btn' style='background-color:#6c757d'>Spróbuj ponownie</a>";
                }
                $stmt->close(); //zamkniecie zapytania
            } else {
                echo "<p>Brak danych do przetworzenia.</p>"; //wpisanie zgloszenie.php recznie a nie z formularza
                echo "<a href='index.php' class='btn'>Wróć</a>";
            }

            $conn->close(); //koniec polaczenia z baza danych 
            ?>
        </div>
    </body>
</html>