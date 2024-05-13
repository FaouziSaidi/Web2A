<?php
echo '
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceptance-Rejection Pie Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body style="height: 20%; width:20%">
    <!-- Canvas element for the pie chart -->
    <div>
        <canvas id="acceptanceRejectionChart"></canvas>

        <!-- JavaScript code for generating the pie chart -->
        <script>
            document.addEventListener(\'DOMContentLoaded\', function() {
                // Get canvas context
                var ctx = document.getElementById(\'acceptanceRejectionChart\');

                // Check if canvas element exists
                if (ctx) {
                    ctx = ctx.getContext(\'2d\');

                    // Calculate percentages
                    var total = 100; // Assuming total is 100%
                    var acceptance = 70; // Example acceptance percentage
                    var rejection = 30; // Example rejection percentage

                    // Data for the pie chart
                    var data = {
                        labels: ["Acceptance", "Rejection"],
                        datasets: [{
                            data: [acceptance, rejection],
                            backgroundColor: ["#2ECC71", "#E74C3C"], // Green for acceptance, red for rejection
                        }]
                    };

                    // Create pie chart
                    new Chart(ctx, {
                        type: \'pie\',
                        data: data,
                        options: {}
                    });
                }
            });
        </script>

    </div>
</body>
</html>';
?>
