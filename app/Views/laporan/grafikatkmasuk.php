<canvas id="myChart" style="display: block; width: 463px; height: 231px;" width="463" height="300" class="chartjs-render-monitor">
</canvas>
<?php
    $tanggal = "";
    $total = "";

    foreach($grafik as $row) :
        $tgl = $row->tanggal;
        $tanggal .="'$tgl'" .",";

        $totalharga = $row->total_harga;
        $total .="'$totalharga'" .",";
    endforeach;
?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    function formatRupiah(angka){
        if (!angka && angka !== 0) return '';
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    var chart = new Chart(ctx,{
        type : 'line',
        data:{
            labels : [<?= $tanggal ?>],
            datasets: [{
                label: 'Total Rupiah',
                data: [<?= $total ?>],
                borderWidth: 2,
                backgroundColor: '#6777ef',
                borderColor: '#6777ef',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            },
            title: {
                display: true,
                text: 'Grafik ATK Masuk per Tanggal',
                fontSize: 18,
                fontColor: '#111'
            },
            legend: {
            // display: false
                labels: {
                    fontColor: '#333',
                    fontStyle: 'bold'
                }
            },
            
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1000,
                        callback: function(value, index, values) {
                            return formatRupiah(value); // tampilkan dengan format Rp dan titik
                        }
                    }
                }],
                xAxes: [{
                    ticks: {
                    // display: false
                    display: true,                // tampilkan label tanggal
                        fontColor: '#333',            // warna teks tanggal
                        fontStyle: 'bold',            // teks tebal
                        autoSkip: true,               // otomatis sembunyikan label jika terlalu padat
                        maxRotation: 45,              // putar label agar tidak bertumpuk
                        minRotation: 0
                    },
                    gridLines: {
                    display: false
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem) {
                        return formatRupiah(tooltipItem.yLabel); // tooltip juga tampil format rupiah
                    }
                }
            }
        }
    })
</script>