temperatureWarning = document.getElementById("temperature-warning");
humidityWarning = document.getElementById("humidity-warning");


// Fonction pour mettre à jour les valeurs actuelles de température et d'humidité
function updateCurrentValues() {
    // Requête GET pour récupérer la dernière valeur de la base de données
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

            // Vérification de la température actuelle
            if (data.temperature >= 30) {
                temperatureWarning.innerText = "Température élevée : " + data.temperature + "°C";
                temperatureWarning.classList.remove("hide-notification");
            } else {
                temperatureWarning.classList.add("hide-notification");
            }

            // Vérification de l'humidité actuelle
            if (data.humidite >= 65) {
                humidityWarning.innerText = "Humidité élevée : " + data.humidite + "%";
                humidityWarning.classList.remove("hide-notification");
            } else {
                humidityWarning.classList.add("hide-notification");
            }
        })
        .catch(error => {
            console.error("Erreur lors de la récupération des données : " + error.message);
        });
}

// Appel de la fonction pour la première fois
updateCurrentValues();

// Mise à jour périodique des valeurs toutes les 60 secondes
setInterval(updateCurrentValues, 60000);
