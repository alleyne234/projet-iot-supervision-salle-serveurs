const ctx = document.getElementById('dashboard-humidity-graph');

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
                beginAtZero: false
            }
        }
    }
});


function updateChart() {
    fetch('./../../models/get_data.php')
        .then(response => {
            // Vérification de la réponse de la requête
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données : ' + response.status);
            }

            // Transformation des données de la réponse en JSON si la réponse est ok
            return response.json();
        })
        .then(data => {
            let list_timestamp = [];
            let list_humidities = [];
            
            // Récupération des données
            for (let i = 9; i >= 0; i--) {
                list_timestamp.push(data[i].horodatage);
                list_humidities.push(data[i].humidite);
            }

            // Mise à jour du graphique
            graph.data.labels = list_timestamp;
            graph.data.datasets[0].data = list_humidities;
            graph.update();
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données : ' + error.message);
        });
}

updateChart();

setInterval(updateChart, 5000);
