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
                <input type="text" name="nama_karyawan" class="form-control" id="nama_karyawan">
                <div class="invalid-feedback errornamakaryawan">
            </div>
            <div class="form-group mb-2">
                <label>Bagian</label>
                <input type="text" name="bagian" class="form-control" id="bagian">
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
                    }
                }
            });
            return false;
        });
    });
</script>