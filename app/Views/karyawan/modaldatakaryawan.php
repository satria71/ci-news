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
        <table style="width: 100%;" class="table table-striped table-sm" id="datakaryawan">
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
        destroy : true,
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

function hapus(id, nik, nama, bagian){
  swal({
      title: "Hapus Karyawan ?",
      text: "Yakin menghapus data karyawa dengan nama "+nama+"?",
      icon: "warning",
      buttons: {
          cancel: {
              text: "Cancel",
              value: null,
              visible: true,
              className: "btn btn-outline-secondary waves-effect",
              closeModal: true,
          },
          confirm: {
              text: "Ya Hapus",
              value: true,
              visible: true,
              className: "btn btn-primary me-3 waves-effect waves-light",
              closeModal: true,
          }
      },
      dangerMode: true,
      className: "my-custom-swal"
  }).then(function (willDelete) {
      if (willDelete) {
          $.ajax({
              url: '/karyawan/hapus',
              type: 'POST',
              data: {
                  id: id
              },
              dataType: 'json',
              success: function (res) {
                if(res.sukses){
                  swal({
                      icon: "success",
                      title: "Berhasil",
                      text: res.sukses,
                      button: {
                          text: "OK",
                          className: "btn btn-primary waves-effect"
                      }
                  });
                  listdatakaryawan();
                }
              },
              error: function () {
                  swal({
                      icon: "error",
                      title: "Error",
                      text: "Terjadi kesalahan pada server.",
                      button: {
                          text: "OK",
                          className: "btn btn-danger waves-effect"
                      }
                  });
              }
          });
      }
  });
}

$(document).ready(function () {
    listdatakaryawan();
});
</script>