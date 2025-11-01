<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan ATK Masuk</title>
</head>
<body>
    <table border="0" style="border-collapse: collapse; 
              border: 0px solid #000; 
              text-align: center; 
              width: 90%; 
              margin: 0 auto;">
        <tr>
            <td style="width:50px;">
                <img alt="logo-idm" src="<?=base_url()?>/template/assets/img/avatar/logo.png" width="250px">
            </td>
            <td>
                <h2 style="height:2px;">PT. INDOMARCO PRISMATAMA</h2>
                <h3 style="height:2px;">DISTRIBUTION CENTER MALANG</h3>
                <h5 style="height:2px;">Jl. Mayjen Sungkono no 99 Kec. Kedung Kandang Malang</h5>
                <h5 style="height:2px;">Jawa Timur, Telp 0341-752000</h5>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="padding:10px;"> 
                <hr style="border:none; border-top:1px solid #000;">
            </td>
        </tr>

        <tr>
            <td style="padding:1px;">
            </td>
            <td style="padding:1px;">
                <h3 style="margin:0;">Laporan ATK Keluar</h3>
            </td>
        </tr>

        <tr>
            <td style="padding:1px;">
            </td>
            <td style="padding:1px;">
                <h5 style="margin:0;">Periode : <?= $tglawal ." s/d ". $tglakhir ?></h5>
            </td>
        </tr>

        <tr>
            <td style="padding:10px;"> 

            </td>
            <td style="padding:10px;"> 

            </td>
        </tr>
    </table>

    <center>
        <table border="1" style="border-collapse: collapse; 
            border: 1px solid #000; 
            text-align: center; 
            width: 90%; 
            margin: 0 auto;">
            <thead>
                <tr>
                    <th>No.</td>
                    <th>Kode Barang</td>
                    <th>Nama Barang</th>
                    <th>Jumlah Item</th>
                    <th>Total Harga (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $totalseluruhharga = 0;
                foreach($datalaporan as $row) : 
                    $totalseluruhharga += $row['total_harga'];
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kode_barang']; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['total_item']; ?></td>
                    <td><?= number_format($row['total_harga'],0,",","."); ?></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total seluruh harga</th>
                    <td><?= number_format($totalseluruhharga,0,",","."); ?></td>
                </tr>
            </tfoot>
        </table>
    </center>
</body>
</html>