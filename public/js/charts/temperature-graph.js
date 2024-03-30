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

        let list_temperatures = [];

        for (let i = 9; i >= 0; i--) {
            list_temperatures.push(data[i].temperature);
        }

        graph.data.labels = list_timestamp;
        graph.data.datasets[0].data = list_temperatures;
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

setInterval(updateChart, 6000);
