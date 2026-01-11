<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdzenie zgłoszenia</title>
    <style>
        /* TŁO I CENTROWANIE (To samo co w formularzu) */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* KARTA POTWIERDZENIA */
        .card {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 450px;
            width: 100%;
        }

        /* ZIELONY PTASZEK SUKCESU */
        .icon-success {
            color: #28a745;
            font-size: 60px;
            margin-bottom: 10px;
        }

        h1 {
            color: #333;
            margin-top: 0;
        }

        /* PUDEŁKO Z DANYMI */
        .summary-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            margin: 20px 0;
            color: #555;
            font-size: 14px;
        }

        .summary-box strong {
            color: #333;
        }

        /* PRZYCISK POWROTU */
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error-msg {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "serwer_tpsi"; // <-- Upewnij się, że nazwa bazy jest poprawna!

        // Łączenie z bazą
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");

        if ($conn->connect_error) {
            die("<p class='error-msg'>Połączenie nieudane: " . $conn->connect_error . "</p>");
        }

        // Logika zapisu
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sprzet = $_POST['sprzet'];
            $opis = $_POST['opis'];

            $stmt = $conn->prepare("INSERT INTO zgloszenia (nazwa_sprzetu, opis_usterki) VALUES (?, ?)");
            $stmt->bind_param("ss", $sprzet, $opis);

            if ($stmt->execute()) {
                // --- SUKCES (Wyświetlamy ładny HTML) ---
                echo "<div class='icon-success'>✔</div>";
                echo "<h1>Zgłoszenie przyjęte!</h1>";
                echo "<p>Twoje zgłoszenie zostało poprawnie zapisane w systemie.</p>";
                
                echo "<div class='summary-box'>";
                echo "<strong>Sprzęt:</strong> " . htmlspecialchars($sprzet) . "<br><br>";
                echo "<strong>Opis usterki:</strong><br>" . htmlspecialchars($opis);
                echo "</div>";

                echo "<a href='index.php' class='btn'>Wróć do strony głównej</a>";
            } else {
                // --- BŁĄD ---
                echo "<h2 style='color:red'>Wystąpił błąd!</h2>";
                echo "<p>Nie udało się zapisać zgłoszenia.</p>";
                echo "<p class='error-msg'>" . $stmt->error . "</p>";
                echo "<a href='usterka.php' class='btn' style='background-color:#6c757d'>Spróbuj ponownie</a>";
            }

            $stmt->close();
        } else {
            // Jeśli ktoś wejdzie tu bezpośrednio bez wysyłania formularza
            echo "<p>Brak danych do przetworzenia.</p>";
            echo "<a href='index.php' class='btn'>Wróć</a>";
        }

        $conn->close();
        ?>
    </div>

</body>
</html>