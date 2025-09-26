<!-- Modal -->
<div class="modal fade" id="modaltambahkaryawan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Input Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('karyawan/simpan', ['class' => 'formsimpan']) ?>
            <div class="form-group mb-2">
                <label>NIK</label>
                <input type="text" name="nikmod" class="form-control" id="nikmod">
                <div class="invalid-feedback errornik">
            </div>
            <div class="form-group mb-2">
                <label>Nama Karyawan</label>
                <input type="text" name="nama_karyawanmod" class="form-control" id="nama_karyawanmod">
                <div class="invalid-feedback errornamakaryawan">
            </div>
            <div class="form-group mb-2">
                <label>Bagian</label>
                <input type="text" name="bagianmod" class="form-control" id="bagianmod">
                <div class="invalid-feedback errorbagian">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="tombolsimpan">Simpan</button>
      </div>
        <?= form_close() ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $('.formsimpan').submit(function (e) { 
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('#tombolsimpan').prop('disabled', true);
                    $('#tombolsimpan').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('#tombolsimpan').prop('disabled', false);
                    $('#tombolsimpan').html('simpan');
                },
                success: function (response) {
                    if(response.error){
                        let err = response.error;
                        if(err.errnik){
                            $('#nikmod').addClass('is-invalid');
                            $('.errornik').html(err.errnik);
                        }
                        if(err.errnama){
                            $('#nama_karyawanmod').addClass('is-invalid');
                            $('.errornamakaryawan').html(err.errnama);
                        }
                        if(err.errbagian){
                            $('#bagianmod').addClass('is-invalid');
                            $('.errorbagian').html(err.errbagian);
                        }
                    }

                    if(response.sukses){
                      swal({
                        title: "Berhasil",
                        text: response.sukses,
                        icon: "success",
                        buttons: {
                            cancel: {
                                text: "Cancel",
                                value: null,
                                visible: true,
                                className: "btn btn-outline-secondary waves-effect",
                                closeModal: true,
                            },
                            confirm: {
                                text: "Ya, ambil",
                                value: true,
                                visible: true,
                                className: "btn btn-primary me-3 waves-effect waves-light",
                                closeModal: true,
                            }
                        },
                        dangerMode: true,
                        className: "my-custom-swal"
                    }).then(function (ambil) {
                        if (ambil) {
                          $('#nama_karyawan').val(response.nama_karyawan);
                          $('#nik').val(response.nik);
                          $('#id').val(response.id);
                          $('#bagian').val(response.bagian);
                          $('#modaltambahkaryawan').modal('hide');
                        }else{
                          $('#modaltambahkaryawan').modal('hide');
                        }
                      });
                    }
                }
            });
            return false;
        });
    });
</script>