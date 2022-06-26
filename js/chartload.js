
document.addEventListener("DOMContentLoaded", function () {

    const mjesecni_prihod = document.querySelector('#mjesecni_prihod').value;
    const mjesecni_rashod = document.querySelector('#mjesecni_rashod').value;

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Prihodi", "Troškovi"],
            datasets: [{
                label: ['Prihodi', 'Troškovi'],
                data: [mjesecni_prihod, mjesecni_rashod],
                fill: false,
                borderColor: ['#226CE0', '#83C9F4'],
                backgroundColor: ['#226CE0', '#83C9F4'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Mjesečni chart
    var ctx = document.getElementById("myCharts").getContext('2d');

    const januar_prihod = document.querySelector('#januar_prihod').value;
    const februar_prihod = document.querySelector('#februar_prihod').value;
    const mart_prihod = document.querySelector('#mart_prihod').value;
    const april_prihod = document.querySelector('#april_prihod').value;
    const maj_prihod = document.querySelector('#maj_prihod').value;
    const juni_prihod = document.querySelector('#juni_prihod').value;
    const juli_prihod = document.querySelector('#juli_prihod').value;
    const august_prihod = document.querySelector('#august_prihod').value;
    const septembar_prihod = document.querySelector('#septembar_prihod').value;
    const oktobar_prihod = document.querySelector('#oktobar_prihod').value;
    const novembar_prihod = document.querySelector('#novembar_prihod').value;
    const decembar_prihod = document.querySelector('#decembar_prihod').value;

    const januar_rashod = document.querySelector('#januar_rashod').value;
    const februar_rashod = document.querySelector('#februar_rashod').value;
    const mart_rashod = document.querySelector('#mart_rashod').value;
    const april_rashod = document.querySelector('#april_rashod').value;
    const maj_rashod = document.querySelector('#maj_rashod').value;
    const juni_rashod = document.querySelector('#juni_rashod').value;
    const juli_rashod = document.querySelector('#juli_rashod').value;
    const august_rashod = document.querySelector('#august_rashod').value;
    const septembar_rashod = document.querySelector('#septembar_rashod').value;
    const oktobar_rashod = document.querySelector('#oktobar_rashod').value;
    const novembar_rashod = document.querySelector('#novembar_rashod').value;
    const decembar_rashod = document.querySelector('#decembar_rashod').value;

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Januar", "Februar", "Mart", "April", "Maj", "Juni", "Juli", "August", "Septembar", "Oktobar", "Novembar", "Decembar"],
            datasets: [
                {
                    label: 'Prihodi',
                    data: [januar_prihod, februar_prihod, mart_prihod, april_prihod, maj_prihod, juni_prihod, juli_prihod, august_prihod, septembar_prihod, oktobar_prihod, novembar_prihod, decembar_prihod],
                    fill: false,
                    borderColor: '#226CE0',
                    backgroundColor: '#226CE0',
                    borderWidth: 2
                },
                {
                    label: 'Rashodi',
                    data: [januar_rashod, februar_rashod, mart_rashod, april_rashod, maj_rashod, juni_rashod, juli_rashod, august_rashod, septembar_rashod, oktobar_rashod, novembar_rashod, decembar_rashod],
                    fill: false,
                    borderColor: '#83C9F4',
                    backgroundColor: '#83C9F4',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
}); 