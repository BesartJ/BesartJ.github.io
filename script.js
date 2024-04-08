// script.js
const data = [
    { id: 1, name: "Apfel", description: "Reich an Vitamin C." },
    { id: 2, name: "Banane", description: "Hoher Kaliumgehalt." },
    { id: 3, name: "Karotte", description: "Gut für die Augen." },
    { id: 4, name: "Spinat", description: "Voll mit Eisen." },
    { id: 5, name: "Tomate", description: "Quelle für Lycopin." },
    { id: 6, name: "Erdbeere", description: "Reich an Antioxidantien." },
    { id: 7, name: "Zucchini", description: "Niedrig in Kalorien." },
    { id: 8, name: "Kirsche", description: "Gut für das Herz." },
    { id: 9, name: "Blaubeere", description: "Hoher Nährstoffgehalt." },
    { id: 10, name: "Gurke", description: "Hoher Wassergehalt." },
    { id: 11, name: "Paprika", description: "Vitamin C Bombe." },
    { id: 12, name: "Brokkoli", description: "Viel Vitamin K." },
    { id: 13, name: "Aubergine", description: "Gut fürs Gehirn." },
    { id: 14, name: "Knoblauch", description: "Natürliches Antibiotikum." },
    { id: 15, name: "Ingwer", description: "Hilft bei Verdauung." },
    { id: 16, name: "Kohl", description: "Fördert die Verdauung." },
    { id: 17, name: "Salat", description: "Niedrig in Kalorien." },
    { id: 18, name: "Mango", description: "Süß und nahrhaft." },
    { id: 19, name: "Pfirsich", description: "Gut für die Haut." },
    { id: 20, name: "Birne", description: "Ballaststoffreich." },
    { id: 21, name: "Radieschen", description: "Gut für die Leber." },
    { id: 22, name: "Süßkartoffel", description: "Vitamin A Quelle." },
    { id: 23, name: "Traube", description: "Gut für die Blutzirkulation." },
    { id: 24, name: "Wassermelone", description: "Perfekt für den Sommer." },
    { id: 25, name: "Zitrone", description: "Stärkt das Immunsystem." },
    { id: 26, name: "Avocado", description: "Gesunde Fette." },
    { id: 27, name: "Ananas", description: "Enthält Bromelain." },
    { id: 28, name: "Kokosnuss", description: "Reich an Fasern." },
    { id: 29, name: "Kiwi", description: "Hoher Vitamin C Gehalt." },
    { id: 30, name: "Limette", description: "Gut für die Verdauung." },
    { id: 31, name: "Papaya", description: "Enthält Papain." },
    { id: 32, name: "Granatapfel", description: "Antioxidansreich." },
    { id: 33, name: "Himbeere", description: "Vitaminreich." },
    { id: 34, name: "Schwarze Johannisbeere", description: "Gut für die Nieren." },
    { id: 35, name: "Mandarine", description: "Stärkt das Immunsystem." },
    { id: 36, name: "Artischocke", description: "Gut für die Leber." },
    { id: 37, name: "Rote Bete", description: "Blutdrucksenkend." },
    { id: 38, name: "Fenchel", description: "Verbessert die Verdauung." },
    { id: 39, name: "Lauch", description: "Reich an Vitaminen." },
    { id: 40, name: "Kürbis", description: "Vielseitig und nahrhaft." },
    { id: 41, name: "Rosenkohl", description: "Enthält viele Nährstoffe." },
    { id: 42, name: "Sellerie", description: "Entzündungshemmend." },
    { id: 43, name: "Champignon", description: "Gut für das Immunsystem." },
    { id: 44, name: "Shiitake-Pilze", description: "Fördert die Herzgesundheit." },
    { id: 45, name: "Sprossen", description: "Reich an Proteinen." },
    { id: 46, name: "Süße Erbsen", description: "Hoher Proteingehalt." },
    { id: 47, name: "Mais", description: "Gute Energiequelle." },
    { id: 48, name: "Feige", description: "Reich an Kalzium." },
    { id: 49, name: "Dattel", description: "Natürlich süß." },
    { id: 50, name: "Oliven", description: "Gut fürs Herz." }
];
document.getElementById('search-input').addEventListener('keyup', function(event) {
    if (event.key === 'Enter' || event.keyCode === 13) {
        searchData();
    }
});


function searchData() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const results = data.filter(item => item.name.toLowerCase().includes(input) || item.description.toLowerCase().includes(input));

    displayResults(results);
}

function displayResults(results) {
    const resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ""; // Ergebnisse zurücksetzen

    results.forEach(item => {
        const element = document.createElement('div');
        element.innerHTML = `<h3>${item.name}</h3><p>${item.description}</p>`;
        resultsContainer.appendChild(element);
    });
}
