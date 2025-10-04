<!-- Modal -->
<div class="modal fade" id="modalcaribarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cari Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive table-bordered">
        <table style="width: 100%;" class="table table-striped table-sm" id="databarang">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead> 
            <tbody>
            
            </tbody>
        </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="tombolsimpan">Simpan</button>
      </div>
      </div>
  </div>
</div>

<script>
function listdatabarang(){
    var table = $('#databarang').DataTable({
        destroy : true,
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "/atkkeluar/listdatabarang",
            "type" : "POST",
        },
        "columnDefs" : [{
            "targets" : [0,5],
            "orderable" : false,
        },],
    });
}

function pilih(kode_barang){
    $('#kode_barang').val(kode_barang);

    $('#modalcaribarang').on('hidden.bs.modal',function(event){
        ambildatabarang();
    });

    $('#modalcaribarang').modal('hide');
}

$(document).ready(function () {
    listdatabarang();
});
</script>