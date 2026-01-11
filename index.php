<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wizualizacja Szpitala - Projekt Zaliczeniowy</title>
    <link rel="stylesheet" href="2_css/style.css">
</head>
<body>

    <header>
        <h1>Interaktywna Mapa Szpitala Klinicznego</h1>
        <p>Wizualizacja rozmieszczenia aparatury medycznej</p>
    </header>

    <main>
        <div id="widok-start">
            <h2>Wybierz poziom placówki:</h2>
            <div class="nawigacja-startowa">
                <button onclick="pokazPietro('widok-parter')">
                    <strong>Parter</strong><br>
                    <small>SOR, OIOM, Pediatria</small>
                </button>
                <button onclick="pokazPietro('widok-pietro1')">
                    <strong>I Piętro</strong><br>
                    <small>Specjalistyka, Diagnostyka (MRI, CT)</small>
                </button>
                <a href="usterka.php" style="text-decoration: none;">
                    <button>
                        <strong>Zgłoś Usterkę</strong><br>
                        <small>Formulasz serwisowy</small>
                    </button>
                </a>

            </div>
        </div>

        <div id="widok-parter" class="widok-pietra">
            <div class="naglowek-pietra">
                <h2>Poziom 0: Parter</h2>
                <button class="btn-wroc" onclick="wrocDoStartu()">⬅ Powrót</button>
            </div>
            <div id="kontener-mapy-0" class="mapa-szpitala"></div>
        </div>

        <div id="widok-pietro1" class="widok-pietra">
            <div class="naglowek-pietra">
                <h2>Poziom 1: Oddziały Specjalistyczne</h2>
                <button class="btn-wroc" onclick="wrocDoStartu()">⬅ Powrót</button>
            </div>
            <div id="kontener-mapy-1" class="mapa-szpitala"></div>
        </div>
    </main>

    <div id="modal-sprzet" class="modal">
        <div class="modal-tresc">
            <span class="zamknij" onclick="zamknijModal()">&times;</span>
            <h2 id="modal-tytul">Nazwa Sprzętu</h2>
            <img id="modal-img" src="" alt="Zdjęcie sprzętu">
            <p id="modal-opis">Opis sprzętu...</p>
        </div>
    </div>

    <script src="3_js/script.js"></script>

</body>
</html>