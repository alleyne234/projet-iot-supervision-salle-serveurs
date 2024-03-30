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
    var xhr = new XMLHttpRequest();

    xhr.open('GET', './../../models/get_data.php', true);

    xhr.responseType = 'json';

    xhr.onload = function() {
    if(xhr.status === 200) {
        let data = xhr.response;

        let list_timestamp = [];

        for (let i = 9; i >= 0; i--) {
            list_timestamp.push(data[i].horodatage);
        }

        let list_humidities = [];

        for (let i = 9; i >= 0; i--) {
            list_humidities.push(data[i].humidite);
        }

        graph.data.labels = list_timestamp;
        graph.data.datasets[0].data = list_humidities;
        graph.update();
    } else {
        console.error('Erreur lors de la récupération des données : ' + xhr.status);
    }
    };

    xhr.onerror = function() {
    console.error('Erreur de connexion.');
    };

    xhr.send();
}

updateChart();

setInterval(updateChart, 5000);
