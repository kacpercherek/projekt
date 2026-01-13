<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoś Usterkę - System Szpitalny</title>
    
    <link rel="stylesheet" href="2_css/style.css">

    </head>

    <body class="body-formularz">
        
        <div class="form-container">
            <a href="index.html" class="btn-back">⬅ Wróc do mapy szpitala</a> <!--przycisk do powrotu!-->

            <h2>Zgłoś awarię </h2>
            <p>Wypełnij formularz zgłoszeniowy.<p>

            <form action="zgloszenie.php" method="POST">

            <label>Nazwa Sprzętu:</label>
            <input type="text" name="sprzet" placeholder="np. Defibrylator" required>

            <label>Opis usterki: </label>
            <textarea name="opis" rows="5" placeholder="Opisz usterkę" required></textarea>

            <input type="submit" value="Wyślij zgłoszenie">

        </form>

        </div>

    </body>

    </html>