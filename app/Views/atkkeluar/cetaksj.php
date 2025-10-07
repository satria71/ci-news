<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Jalan ATK Keluar</title>
</head>
<body onLoad="window.print();">
    <table border = "1" style="text-align:center; width:100%;">
        <tr>
            <td colspan="2">
                <h2 style="height:2px;">DC MALANG</h2>
                <h5 style="height:2px;">Jl. Mayjend Sungkono</h5>
                <hr style="border:none; border-top:1px solid #000;">
            </td>
        </tr>

        <tr style="text-align:left;">
            <td>No Surat Jalan : </td>
            <td><?= $no_sj ?></td>
        </tr>
        <tr style="text-align:left;">
            <td>Tanggal : </td>
            <td><?= date('d-m-Y', strtotime($tgl)) ?></td>
        </tr>
        <tr style="text-align:left;">
            <td>Nama Karyawan : </td>
            <td><?= $namakaryawan ?></td>
        </tr>
            <tr style="text-align:left;">
            <td>Bagian Karyawan : </td>
            <td><?= $bagian ?></td>
        </tr>

        <tr>
            <td colspan="2">
                <hr style="border:none; border-top:1px dashed #000;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width:100%; text-align:left; font-size:10pt;">
                    <?php
                        $totalitem = 0;
                        $jumlahitem = 0;
                        $totalharga = 0;
                        foreach($detailatk as $row) :
                            $totalitem += $row['det_jumlah'];
                            $jumlahitem ++;
                            $totalharga += $row['det_subtotal'];
                    ?>
                        <tr>
                            <td colspan="3"><?= $row['nama_barang']; ?></td>
                        </tr>
                        <tr>
                            <td><?= number_format($row['det_jumlah'],0,",","."). ' ' . $row['satuan']; ?></td>
                            <td style="text-align:right;"><?= number_format($row['det_harga_keluar'],0,",",".");?></td>
                            <td style="text-align:right;"><?= number_format($row['det_subtotal'],0,",","."); ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td colspan="3"> 
                            <hr style="border:none; border-top:1px dashed #000;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> 
                            Jml.Item : <?= number_format($jumlahitem ,0,",","."). '(' . number_format($totalitem,0,",","."). ')'?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr style="border:none; border-top:1px dashed #000;">
                        </td>
                    </tr>
                    <tr style="text-align:right;">
                        <td></td>
                        <td>Total : </td>
                        <td>
                            <?= number_format($totalharga ,0,",",".") ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>