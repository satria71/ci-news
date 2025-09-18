<!-- Modal -->
<div class="modal fade" id="modalcaribarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Silahkan cari data barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Silahkan cari barang berdasarkan kode barang atau nama barang" id="cari">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="btncari">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <!-- Loader, disembunyikan awalnya -->
        <div id="loader" style="display:none;">
            <div class="d-flex align-items-center">
                <strong>Loading...</strong>
                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>

        <div class="row modalviewdetaildata"></div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    function caridatabarang(){
        let cari = $('#cari').val();
        $.ajax({
            type: "post",
            url: "/atkmasuk/modaldetailcaribarang",
            data: {
                cari : cari
            },
            dataType: "json",
            beforeSend: function(){
                $('#loader').show();
            },
            success: function (response) {
                if(response.data){
                    $('.modalviewdetaildata').html(response.data);
                }
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    }

    $(document).ready(function () {
        $('#btncari').click(function (e) { 
            e.preventDefault();
            caridatabarang();
        });

        $('#cari').keydown(function (e) { 
            if(e.keyCode == 13){
                e.preventDefault();
                caridatabarang();
            }
        });
    });
</script>