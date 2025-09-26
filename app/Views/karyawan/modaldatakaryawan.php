    <!-- General CSS Files -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  



  <!-- CSS Libraries -->

  <!-- Paho -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js" type="text/javascript"></script> -->


  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/custom.css">

  <script src="<?=base_url()?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <!-- General JS Scripts -->
  <!-- <script src="<?=base_url()?>/template/node_modules/jquery/dist/jquery.min.js"></script> -->
  <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
  <script src="<?=base_url()?>/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  
  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>

  <!-- Page Specific JS File -->
<!-- Modal -->
<div class="modal fade" id="modaldatakaryawan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cari Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive table-bordered">
        <table class="table table-striped table-sm" id="datakaryawan">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Bagian</th>
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
function listdatakaryawan(){
    var table = $('#datakaryawan').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "/karyawan/listdata",
            "type" : "POST",
        },
        "columnDefs" : [{
            "targets" : [0,4],
            "orderable" : false,
        },],
    });
}

function pilih(id,nik,nama,bagian){
    $('#nik').val(nik);
    $('#nama_karyawan').val(nama);
    $('#bagian').val(bagian);

    $('#modaldatakaryawan').modal('hide');
}

$(document).ready(function () {
    listdatakaryawan();
});
</script>