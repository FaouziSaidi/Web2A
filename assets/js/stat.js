function calculateStatistics() {

    const table = document.querySelector('table'); // Sélectionne le tableau HTML
    const rows = table.querySelectorAll('tbody tr'); // Sélectionne toutes les lignes dans le corps du tableau
    let totalSalary = 0; // Initialise la somme des salaires à 0
    let minSalary = Infinity; // Initialise le salaire minimum à une valeur infinie pour le trouver lors du parcours
    let maxSalary = -Infinity; // Initialise le salaire maximum à une valeur moins infinie pour le trouver lors du parcours

    // Parcours de chaque ligne du tableau
    rows.forEach(row => {
        const salary = parseFloat(row.querySelector('td:nth-child(6)').textContent); // Récupère le salaire dans la cellule correspondante
        totalSalary += salary; // Ajoute le salaire actuel à la somme totale des salaires
        console.log("Total Salary:",totalSalary);
        // Met à jour le salaire minimum et maximum si nécessaire
        if (salary < minSalary) {
            minSalary = salary;
        }
        if (salary > maxSalary) {
            maxSalary = salary;
        }
    });

    const averageSalary = totalSalary / rows.length; // Calcule le salaire moyen

    // Retourne un objet contenant les statistiques calculées
    return {
        totalSalary: totalSalary,
        averageSalary: averageSalary,
        minSalary: minSalary,
        maxSalary: maxSalary
    };
}



// Récupère les statistiques
const statistics = calculateStatistics();
console.log("Total Salary:", statistics.totalSalary);
console.log("Average Salary:", statistics.averageSalary);
console.log("Minimum Salary:", statistics.minSalary);
console.log("Maximum Salary:", statistics.maxSalary);
// Définit les données du graphique
const data = {
    labels: ["Total Salary", "Average Salary", "Minimum Salary", "Maximum Salary"],
    datasets: [{
        label: "Statistics salary",
        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
        data: [
            statistics.totalSalary,
            statistics.averageSalary,
            statistics.minSalary,
            statistics.maxSalary
        ]
    }]
};

// Crée un nouveau graphique à barres
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
   options: {
    scales: {
        y: {
            beginAtZero: true
        }
    }
}
});


function calculateWorkHoursStatistics() {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tbody tr');
    let totalWorkHours = 0;
    let countLessThan30 = 0;
    let countBetween30And50 = 0;
    let countGreaterThan50 = 0;

    rows.forEach(row => {
        const workHours = parseFloat(row.querySelector('td:nth-child(5)').textContent);
        totalWorkHours += workHours;

        if (workHours < 30) {
            countLessThan30++;
        } else if (workHours >= 30 && workHours <= 50) {
            countBetween30And50++;
        } else {
            countGreaterThan50++;
        }
    });

    const totalCount = countLessThan30 + countBetween30And50 + countGreaterThan50;

    const percentageLessThan30 = (countLessThan30 / totalCount) * 100;
    const percentageBetween30And50 = (countBetween30And50 / totalCount) * 100;
    const percentageGreaterThan50 = (countGreaterThan50 / totalCount) * 100;

    return {
        percentageLessThan30: percentageLessThan30,
        percentageBetween30And50: percentageBetween30And50,
        percentageGreaterThan50: percentageGreaterThan50
    };
}
// Utilisation de la fonction calculateWorkHoursStatistics pour obtenir les pourcentages des heures de travail
const workHoursStatistics = calculateWorkHoursStatistics();
console.log("Percentage Less Than 30 Hours:", workHoursStatistics.percentageLessThan30);
console.log("Percentage Between 30 and 50 Hours:", workHoursStatistics.percentageBetween30And50);
console.log("Percentage Greater Than 50 Hours:", workHoursStatistics.percentageGreaterThan50);

// Définition des données pour le graphique
const workHoursData = {
    labels: ["< 30 Hours", "30 - 50 Hours", "> 50 Hours"],
    datasets: [{
        label: "Work Hours Statistics",
        backgroundColor: ["#9966FF", "#FF9966", "#20B2AA"],
        data: [
            workHoursStatistics.percentageLessThan30,
            workHoursStatistics.percentageBetween30And50,
            workHoursStatistics.percentageGreaterThan50
        ]
    }]
};

// Création du graphique circulaire
const workHoursCtx = document.getElementById('workHoursChart').getContext('2d');
const workHoursChart = new Chart(workHoursCtx, {
    type: 'pie',
    data: workHoursData,
    options: {}
});
