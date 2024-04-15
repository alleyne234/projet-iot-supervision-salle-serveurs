// Récupération de l'élément canvas pour dessiner le graphique de température
const ctx = document.getElementById('dashboard-temperature-graph');

// Initialisation du graphique de température Chart.js
const graph = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Température ',
            data: [],
            backgroundColor: [],
            borderColor: [
                'rgb(127, 127, 127, 0.5)'
            ],
            borderWidth: 1
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


// Fonction pour obtenir la couleur de fond en fonction de la température
function getBackgroundColorForTemperature(temperature, minTemperature, maxTemperature) {
    const colors = [
        'rgba(54, 162, 235, 0.2)',  // Bleu
        'rgba(75, 192, 192, 0.2)',  // Vert
        'rgba(255, 205, 86, 0.2)',  // Jaune
        'rgba(255, 159, 64, 0.2)',  // Orange
        'rgba(255, 99, 132, 0.2)'   // Rouge
    ];

    // Calcul de l'index de l'intervalle de température
    const temperatureRange = maxTemperature - minTemperature;
    const intervalSize = temperatureRange / colors.length + 0.001;
    const intervalIndex = Math.floor((temperature - minTemperature) / intervalSize);

    return colors[intervalIndex];
}


// Fonction pour mettre à jour le graphique de température
function updateChart() {
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
            let listTemperature = [];
            let minTemperature = Infinity;
            let maxTemperature = -Infinity;
            let listBackgroundColor = [];
            
            // Récupération des données de température
            for (let i = 9; i >= 0; i--) {
                listTimestamp.push(data[i].horodatage);
                listTemperature.push(data[i].temperature);

                // Mise à jour des températures minimale et maximale
                if (data[i].temperature < minTemperature) {
                    minTemperature = data[i].temperature;
                }

                if (data[i].temperature > maxTemperature) {
                    maxTemperature = data[i].temperature;
                }
            }

            // Attribution des couleurs de fond des barres en fonction des températures
            for (let i = 9; i >= 0; i--) {
                listBackgroundColor.push(getBackgroundColorForTemperature(data[i].temperature, minTemperature, maxTemperature));
            }

            // Mise à jour du graphique avec les nouvelles données
            graph.data.labels = listTimestamp;
            graph.data.datasets[0].data = listTemperature;
            graph.data.datasets[0].backgroundColor = listBackgroundColor;
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
