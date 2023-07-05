function mettreAJourDate() {
    // Obtient l'élément avec l'ID "date"
    var elementDate = document.getElementById("date");

    // Obtient la date et l'heure actuelles
    var dateActuelle = new Date();

    // Formate la date et l'heure
    var jour = dateActuelle.getDate();
    var mois = dateActuelle.getMonth() + 1; // Note : les mois sont indexés à partir de 0
    var annee = dateActuelle.getFullYear();
    var heure = dateActuelle.getHours();
    var minute = dateActuelle.getMinutes();
    var seconde = dateActuelle.getSeconds();

    // Met à jour le contenu de l'élément avec la date et l'heure actuelles
    elementDate.textContent = jour + "/" + mois + "/" + annee + " " + heure + ":" + minute + ":" + seconde;
}

// Appelle la fonction mettreAJourDate chaque seconde (1000 millisecondes)
setInterval(mettreAJourDate, 1000);