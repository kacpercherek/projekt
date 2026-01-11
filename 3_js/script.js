
function pokazPietro(idPietra) {
    // Ukrywam start i inne piętra
    document.getElementById('widok-start').style.display = 'none';
    document.getElementById('widok-parter').style.display = 'none';
    document.getElementById('widok-pietro1').style.display = 'none';

    // Pokazuje wybrane pietro
    const wybranePietro = document.getElementById(idPietra);
    if (wybranePietro) {
        wybranePietro.style.display = 'block';
    } else {
        console.error("Nie znaleziono widoku o ID:", idPietra);
    }
}

function wrocDoStartu() {
    // Ukrywam wszystkie piętra
    const pietra = document.getElementsByClassName('widok-pietra');
    for (let i = 0; i < pietra.length; i++) {
        pietra[i].style.display = 'none';
    }
    // Pokazuje start
    document.getElementById('widok-start').style.display = 'block';
}


function generujPietro(danePietra, kontenerId) {
    const kontener = document.getElementById(kontenerId);
    
    // tu robie zabezpieczenie - sprawdzam czy kontener istnieje w HTML
    if (!kontener) {
        console.error("BŁĄD: W pliku index.html brakuje diva o id='" + kontenerId + "'");
        return; 
    }

    kontener.innerHTML = ''; // Czyszcze stare kafelki

    danePietra.forEach((sala) => {

        const wrapper = document.createElement('div'); //to jest takie ala pudelko ktore trzyma pokoj i liste razem
        wrapper.className = 'pokoj-wrapper'; //nowa klasa do cssa

        // Robie kafelek do sali
        const divSala = document.createElement('div');
        divSala.className = 'sala'; 
        divSala.innerHTML = `<h3>${sala.nazwa}</h3><small>Kliknij, by zobaczyć sprzęt</small>`;

        // Tworze listę sprzętu
        const divLista = document.createElement('div');
        divLista.className = 'lista-sprzetu';
        divLista.id = `Lista-${sala.id}`;
        divLista.innerHTML = `<h4>Sprzęt w sali: ${sala.nazwa}</h4>`;

        //  przyciski do sprzętu
        sala.sprzet.forEach(sprzet => {
            const btn = document.createElement('button');
            btn.className = 'btn-sprzet';
            btn.innerText = sprzet.nazwa;
            btn.onclick = () => pokazModal(sprzet); // Kliknięcie otwiera modal
            divLista.appendChild(btn);
        });

        // Kliknięcie w salę otwiera/zamyka listę
        divSala.onclick = () => {
            if (divLista.style.display === 'block') {
                divLista.style.display = 'none';
            } else {
                // Zamykam inne listy, otwieram ta wybrana
                document.querySelectorAll('.lista-sprzetu').forEach(el => el.style.display = 'none');
                divLista.style.display = 'block';
            }
        };

        wrapper.appendChild(divSala);
        wrapper.appendChild(divLista);
        kontener.appendChild(wrapper);
    });
}


function pokazModal(sprzet) {
    document.getElementById('modal-tytul').innerText = sprzet.nazwa;
    document.getElementById('modal-opis').innerText = sprzet.opis;
    document.getElementById('modal-img').src = sprzet.zdjecie;
    document.getElementById('modal-sprzet').style.display = 'block';
}

function zamknijModal() {
    document.getElementById('modal-sprzet').style.display = 'none';
}

// pop-up sie zamyknie jak klikne w tlo
window.onclick = function(event) {
    const modal = document.getElementById('modal-sprzet');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


// czekam az sie zaladuje html i pobieram dane
document.addEventListener('DOMContentLoaded', () => {
    fetch('szpital.json')
        .then(response => response.json())
        .then(data => {
            console.log("Dane pobrane poprawnie:", data);
            generujPietro(data.pietro0, 'kontener-mapy-0');
            generujPietro(data.pietro1, 'kontener-mapy-1');
        })
        .catch(error => console.error('Błąd pobierania JSON:', error));
});