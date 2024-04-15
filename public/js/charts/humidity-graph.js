// Récupération de l'élément canvas pour dessiner le graphique d'humidité
const ctx = document.getElementById('dashboard-humidity-graph');

// Initialisation du graphique d'humidité Chart.js
const graph = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Humiditité ',
            data: [],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            x: {
                display: false
            },
            y: {
                beginAtZero: false,
                grace: '5%'
            }
        }
    }
});


// Fonction pour mettre à jour le graphique d'humidité
function updateChart() {
    // Requête GET pour récupérer les données de l'humidité depuis la base de données
    fetch('./../models/get_data.php')
        .then(response => {
            // Vérification de la réponse de la requête
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données : ' + response.status);
            }

            // Transformation des données de la réponse en JSON si la réponse est ok
            return response.json();
        })
        .then(data => {
            let listTimestamp = [];
            let listHumidity = [];
            
            // Récupération des données de l'humidité
            for (let i = 9; i >= 0; i--) {
                listTimestamp.push(data[i].horodatage);
                listHumidity.push(data[i].humidite);
            }

            // Mise à jour du graphique avec les nouvelles données
            graph.data.labels = listTimestamp;
            graph.data.datasets[0].data = listHumidity;
            graph.update();
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données : ' + error.message);
        });
}

// Appel de la fonction pour la première fois
updateChart();

// Mise à jour périodique des valeurs toutes les 60 secondes
setInterval(updateChart, 60000);
