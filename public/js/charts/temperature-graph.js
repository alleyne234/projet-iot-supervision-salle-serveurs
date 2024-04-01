const ctx = document.getElementById('dashboard-temperature-graph');

const graph = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Température ',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)'
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
            let list_temperatures = [];
            
            // Récupération des données
            for (let i = 9; i >= 0; i--) {
                list_timestamp.push(data[i].horodatage);
                list_temperatures.push(data[i].temperature);
            }

            // Mise à jour du graphique
            graph.data.labels = list_timestamp;
            graph.data.datasets[0].data = list_temperatures;
            graph.update();
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données : ' + error.message);
        });
}

updateChart();

setInterval(updateChart, 6000);
