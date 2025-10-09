<canvas id="myChart" style="display: block; width: 463px; height: 231px;" width="463" height="231" class="chartjs-render-monitor">
    <!-- <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">

            </div>
        </div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:200%;height:200%;left:0; top:0">

            </div>
        </div>
    </div> -->
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

<!-- <div class="row">
    <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="card-header">
        <h4>Line Chart ATK Masuk</h4>
        </div>
        <div class="card-body" viewtampilgrafik><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <canvas id="myChart" style="display: block; width: 463px; height: 231px;" width="463" height="231" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="card-header">
        <h4>Bar Chart</h4>
        </div>
        <div class="card-body"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <canvas id="myChart2" style="display: block; width: 463px; height: 231px;" width="463" height="231" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
    </div>
</div> -->

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx,{
        type : 'bar',
        data:{
            labels : [<?= $tanggal ?>],
            datasets : [{
                label : 'Total Rupiah',
                backgroundColor : ['rgb(255,99,132)'],
                borderColor : ['rgb(255,991,130)'],
                data : [<?= $total ?>]
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1000
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grace: '20%',
                }
            }
        }
    })
</script>