<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoś Usterkę - System Szpitalny</title>
    
    <link rel="stylesheet" href="2_css/style.css">

    <style>
        body { /*tło*/
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex; 
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
}

.form-container { /*karta formularza*/
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

h2 { /*nagłówek zglos awarie*/
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
}

p { /*opis pod naglowkiem*/
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
}

label { /*etykiety wsn "nazwa sprzetu" i "opis"*/
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
    border: 1px solid #ccc; /*szara ramka*/
    border-radius: 5px;
    box-sizing: border-box; /*padding nie powieksza szerokosci pola*/
    font-size: 16px;
    font-family: inherit; /*czcionka z body*/
}

textarea {
    resize: vertical; /*blokada na rozciaganie pola tekstowego na boki*/
}

input[type="submit"] {
    background-color: #28a745;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s; /*animacja przy najechaniu*/
}

input[type="submit"]:hover {
    background-color: #218838; /*ciemniejszy kolor po najechaniu*/
}

.btn-back { /*wróc do mapy*/
    display: inline-block;
    margin-bottom: 20px;
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

.btn-back:hover {
    text-decoration: underline; /*podkresla sie po najechaniu*/
}
    </style>

    </head>

    <body>
        <div class="form-container">
            <a href="index.php" class="btn-back">⬅ Wróc do mapy szpitala</a> <!--przycisk do powrotu!-->

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