var ctx = document.getElementById("myChart").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Prihodi", "Troškovi"],
        datasets: [{
            label: ['Prihodi', 'Troškovi'], // Name the series
            data: [500, 650], // Specify the data values array
            fill: false,
            borderColor: ['#226CE0', '#83C9F4'], // Add custom color border (Line)
            backgroundColor: ['#226CE0', '#83C9F4'],  // Add custom color background (Points and Fill)
            // borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});

var ctx = document.getElementById("myCharts").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "August", "Septembar", "Oktobar", "Novembar", "Decembar"],
        datasets: [{
            label: 'Prihodi', // Name the series
            data: [500, 650, 300, 220, 800, 1200, 1300, 550, 700, 800, 700, 1500, 2500, 500], // Specify the data values array
            fill: false,
            borderColor: '#83C9F4', // Add custom color border (Line)
            backgroundColor: '#83C9F4', // Add custom color background (Points and Fill)
            borderWidth: 2 // Specify bar border width
        }]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});