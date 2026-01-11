<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewort" content="width=device-witdth, initial-scale=1.0">
        <title>Potwierdzenie zgłoszenia</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f2f5;
                display: flex;
                justify-content: center; /*wysrodkowanie w poziomie i pionie*/
                align-items: center;
                height: 100vh;
                margin: 0; /*usuwam domyslne marginesy przegladarki*/
}

.card { /*biała karta*/
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1); /*cien pod karta*/
    text-align: center;
    max-width: 450px;
    width: 100%;   /*male ekrany=100% szerokosci*/
}

.icon-success {
    color: #28a745;
    font-size: 60px;
    margin-bottom: 10px;
}

h1 {
    color: #333;    /*ciemny kolor naglowka*/
    margin-top: 0;
}

.summary-box {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 15px; /*wewnetrxzne odstepy*/
    border-radius: 5px;  /*zaokraglone rogi*/
    text-align: left;
    margin: 20px 0;
    color: #555;
    font-size: 14px;
}

.summary-box strong {
    color: #333;
}

.btn {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none; /*usuwam podkreslenie linku*/
    border-radius: 5px;
    font-weight: bold;  /*pogrubiona czcionka*/
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}

.error-msg { /*wyswietli sie gdy bedzei blad zapisu blub awaria pilaczenia*/
    color: red;
    font-weight: bold;
}
</style>

    </head>

    <body>

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

                    echo "<a href='index.php' class='btn'>Wróc do strony głównej</a>"; //przycisk do powrotu na main
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