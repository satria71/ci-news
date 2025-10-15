<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Jalan ATK Keluar</title>
</head>
<body onLoad="window.print();">
    <table border = "0" style="text-align:center; width:100%;">
        <tr>
            <td style="width:100px">
                <img alt="logo-idm" src="<?=base_url()?>/template/assets/img/avatar/logo.png" width="250px">
            </td>
            <td></td>
            <td colspan="5">
                <h2 style="height:2px;">PT. INDOMARCO PRISMATAMA</h2>
                <h3 style="height:2px;">DISTRIBUTION CENTER MALANG</h3>
                <h5 style="height:2px;">Jl. Mayjen Sungkono no 99 Kec. Kedung Kandang Malang</h5>
                <h5 style="height:2px;">Jawa Timur, Telp 0341-752000</h5>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <hr style="border:none; border-top:1px solid #000;">
            </td>
        </tr>
        <tr style="text-align:left;">
            <td>No Surat Jalan</td>
            <td>:</td>
            <td><?= $no_sj ?></td>
        </tr>
        <tr style="text-align:left;">
            <td>Tanggal</td>
            <td>:</td>
            <td><?= date('d-m-Y', strtotime($tgl)) ?></td>
        </tr>
        <tr style="text-align:left;">
            <td>Nama Karyawan</td>
            <td>:</td>
            <td><?= $namakaryawan ?></td>
        </tr>
            <tr style="text-align:left;">
            <td>Bagian Karyawan</td>
            <td>:</td>
            <td><?= $bagian ?></td>
        </tr>
        <tr>
            <td colspan="7">
                <br>
            </td>
        </tr>
    </table>
    
    <!-- <table border="1" style="text-align:center; width:100%;">
        <tr>
            <td style="width:20px;">No.</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>QTY</td>
            <td>Satuan</td>
            <td>Harga</td>
            <td>Sub. Total</td>
        </tr>
    </table> -->

    <table border="1" style="text-align:center; width:100%;">
        <tr style="font-weight: bold;">
            <td style="width:20px;">No.</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>QTY</td>
            <td>Satuan</td>
            <td>Harga</td>
            <td>Sub. Total</td>
        </tr>

        <?php
            $totalitem = 0;
            $jumlahitem = 0;
            $totalharga = 0;
            $no = 0;
            $hariini = date('d M Y');
            foreach($detailatk as $row) :
                $totalitem += $row['det_jumlah'];
                $jumlahitem ++;
                $no ++;
                $totalharga += $row['det_subtotal'];
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $row['det_kode_barang']; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= number_format($row['det_jumlah'],0,",","."); ?></td>
            <td><?= $row['satuan'] ?></td>
            <td style="text-align:right;"><?= number_format($row['det_harga_keluar'],0,",",".");?></td>
            <td style="text-align:right;"><?= number_format($row['det_subtotal'],0,",","."); ?></td>
        </tr>
        <?php endforeach ?>

        <tr style="font-weight: bold;">
            <td colspan="2">TOTAL</td>
            <td>
                <?= number_format($jumlahitem ,0,",",".")?>
            </td>
            <td>
                <?= number_format($totalitem,0,",",".") ?>
            </td>
            <td>-</td>
            <td>-</td>
            <td style="text-align:right;">
                <?= number_format($totalharga ,0,",",".") ?>
            </td>
        </tr>
    </table>

    <br>

    <table border="0" style="text-align:center; width:100%;">
        <tr>
            <td colspan="4"></td>
            <td colspan="3"></td>
            <td colspan="3">Malang, <?= $hariini ?></td>
        </tr>
        <tr>
            <td colspan="4">Mengetahui,</td>
            <td colspan="3">Menyetujui,</td>
            <td colspan="3">Dibuat,</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="3"></td>
            <td colspan="3"><br><br><br><br></td>
        </tr>
        <tr>
            <td colspan="4">MGR</td>
            <td colspan="3">SPV</td>
            <td colspan="3">ADM</td>
        </tr>
    </table>

    <table>       
        <!-- cetakan lama -->
        <!-- <tr>
            <td colspan="7">
                <table style="width:100%; text-align:left; font-size:10pt;">
                    <?php
                        $totalitem = 0;
                        $jumlahitem = 0;
                        $totalharga = 0;
                        $no = 0;
                        foreach($detailatk as $row) :
                            $totalitem += $row['det_jumlah'];
                            $jumlahitem ++;
                            $no ++;
                            $totalharga += $row['det_subtotal'];
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['det_kode_barang']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
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
        </tr> -->
    </table>
</body>
</html>