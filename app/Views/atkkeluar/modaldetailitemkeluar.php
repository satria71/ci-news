<div class="modal fade" id="modalitem" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php 
          $totalharga = 0;
          $jumlahitem = 0;
          foreach ($tampildatadetail as $row) :
          $totalharga += $row['det_subtotal'];
          $jumlahitem += $row['det_jumlah'];
          endforeach;
      ?>
      <div class="modal-body table-responsive table-bordered table-hover">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Keluar</th>
                    <th>Jumlah</th>
                    <th>Sub. Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nomor = 1;
                    foreach($tampildatadetail as $row) :
                ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $row['det_kode_barang']?></td>
                    <td><?= $row['nama_barang']?></td>
                    <td style="text-align: right;"><?= number_format($row['det_harga_keluar'],0,",",".")?></td>
                    <td style="text-align: right;"><?= number_format($row['det_jumlah'],0,",",".")?></td>
                    <td style="text-align: right;"><?= number_format($row['det_subtotal'],0,",",".")?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                  <td style="font-weight:bold;" colspan="4">Total</td>
                  <td style="text-align: right; font-weight:bold;"><?= $jumlahitem ?></td>
                  <td style="text-align: right; font-weight:bold;"><?= number_format($totalharga,0,",",".") ?></td>
                </tr>
            </tbody>

        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
