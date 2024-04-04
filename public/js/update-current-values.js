function updateCurrentValues() {
    fetch("./../../src/models/get_last_value.php")
        .then(response => {
            // Vérification de la réponse de la requête
            if (!response.ok) {
                throw new Error("Erreur lors de la récupération des données : " + response.status);
            }

            // Transformation des données de la réponse en JSON si la réponse est ok
            return response.json();
        })
        .then(data => {
            // Mettre à jour les valeurs de température et d'humidité avec les données reçues
            document.getElementById("dashboard-current-temperature").innerText = data.temperature + "°C";
            document.getElementById("dashboard-current-humidity").innerText = data.humidite + "%";
        })
        .catch(error => {
            console.error("Erreur lors de la récupération des données : " + error.message);
        });
}

updateCurrentValues();
setInterval(updateCurrentValues, 60000);
