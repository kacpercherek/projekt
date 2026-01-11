<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoś Usterkę - System Szpitalny</title>
    
    <link rel="stylesheet" href="2_css/style.css">

    <style>
        /* TŁO STRONY - Jasnoszare, medyczne */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5; 
            display: flex;
            justify-content: center; /* Centrowanie w poziomie */
            align-items: center;     /* Centrowanie w pionie */
            height: 100vh;           /* Wysokość na cały ekran */
            margin: 0;
        }

        /* BIAŁA KARTA FORMULARZA */
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px; /* Zaokrąglone rogi */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Delikatny cień */
            width: 100%;
            max-width: 400px; /* Nie szerszy niż 400px */
            text-align: center;
        }

        /* NAGŁÓWKI */
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        p {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* WYGLĄD PÓL DO WPISYWANIA */
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"], 
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Żeby padding nie psuł szerokości */
            font-size: 16px;
            font-family: inherit;
        }

        textarea {
            resize: vertical; /* Pozwala rozciągać tylko w dół */
        }

        /* PRZYCISK WYSYŁANIA */
        input[type="submit"] {
            background-color: #28a745; /* Zielony "Medyczny" */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Ciemniejszy zielony po najechaniu */
        }

        /* LINK POWROTU */
        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <a href="index.php" class="btn-back">⬅ Wróć do mapy szpitala</a>

        <h2>Zgłoś awarię</h2>
        <p>Wypełnij formularz dla działu technicznego.</p>

        <form action="zgloszenie.php" method="POST">
            
            <label>Nazwa sprzętu:</label>
            <input type="text" name="sprzet" placeholder="np. Defibrylator Sala 3" required>

            <label>Opis usterki:</label>
            <textarea name="opis" rows="5" placeholder="Opisz co nie działa..." required></textarea>

            <input type="submit" value="Wyślij zgłoszenie">
        </form>
    </div>

</body>
</html>