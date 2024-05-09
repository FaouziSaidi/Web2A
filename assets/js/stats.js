        // Fonction pour calculer l'âge à partir de la date de naissance
        function calculateAge(dob) {
            const birthdate = new Date(dob);
            const today = new Date();
            const age = today.getFullYear() - birthdate.getFullYear();
            const monthDiff = today.getMonth() - birthdate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                return age - 1;
            }
            return age;
        }

        // Fonction pour calculer les statistiques d'âge
        function calculateAgeStatistics() {
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tbody tr');
            let countLessThan20 = 0;
            let countBetween20And40 = 0;
            let countGreaterThan40 = 0;

            rows.forEach(row => {
                const dob = row.querySelector('td:nth-child(4)').textContent;
                const age = calculateAge(dob);

                if (age < 20) {
                    countLessThan20++;
                } else if (age >= 20 && age <= 40) {
                    countBetween20And40++;
                } else {
                    countGreaterThan40++;
                }
            });

            const totalCount = countLessThan20 + countBetween20And40 + countGreaterThan40;

            const percentageLessThan20 = (countLessThan20 / totalCount) * 100;
            const percentageBetween20And40 = (countBetween20And40 / totalCount) * 100;
            const percentageGreaterThan40 = (countGreaterThan40 / totalCount) * 100;

            return {
                percentageLessThan20: percentageLessThan20,
                percentageBetween20And40: percentageBetween20And40,
                percentageGreaterThan40: percentageGreaterThan40
            };
        }

        // Utilisation de la fonction calculateAgeStatistics pour obtenir les pourcentages des tranches d'âge
        const ageStatistics = calculateAgeStatistics();

        // Données pour le graphique
        const ageData = {
            labels: ["< 20 Years", "20 - 40 Years", "> 40 Years"],
            datasets: [{
                label: "User Age Statistics",
                backgroundColor: ["#FF6384", "#FFCE56", "#36A2EB"],
                data: [
                    ageStatistics.percentageLessThan20,
                    ageStatistics.percentageBetween20And40,
                    ageStatistics.percentageGreaterThan40
                ]
            }]
        };

        // Création du graphique circulaire
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const ageChart = new Chart(ageCtx, {
            type: 'pie',
            data: ageData,
            options: {}
        });