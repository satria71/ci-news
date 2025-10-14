<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Dashboard &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">  
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Aktiva Aktif</h4>
                            </div>
                            <div class="card-body">
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-trash-restore"></i>
                        </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tidak Aktif</h4>
                            </div>
                            <div class="card-body">
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-laptop-medical"></i>
                        </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Rusak</h4>
                            </div>
                            <div class="card-body">
                                -
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-toolbox"></i>
                        </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sarana Pinjam</h4>
                            </div>
                            <div class="card-body">
                                -
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-thermometer-three-quarters"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Suhu Coldroom</h4>
                            </div>
                            <div class="card-body">
                              <h4 id="suhu">-</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kelembapan Coldroom</h4>
                            </div>
                            <div class="card-body">
                              <h4 id="kelembapan">-</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Status Coldroom</h4>
                            </div>
                            <div class="card-body">
                              <h4 id="kelembapan">-</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="row">
              <!-- Chart ATK Masuk -->
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Line Chart ATK Masuk</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="bulan">Pilih Bulan</label>
                      <div class="input-group">
                          <input 
                            type="month"
                            id="bulan" 
                            class="form-control" 
                            value="<?= date('Y-m') ?>"
                            required
                          >
                          <button type="button" class="btn btn-primary btn-sm" id="tomboltampil">
                            <i class="fas fa-search"></i> Tampilkan
                          </button>
                      </div>
                    </div>
                    <div class="viewtampilgrafik"></div>
                  </div>
                </div>
              </div>

              <!-- Chart ATK Keluar -->
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Line Chart ATK Keluar</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                        <label for="bulan">Pilih Bulan</label>
                        <div class="input-group">
                          <input 
                            type="month"
                            id="bulan2" 
                            class="form-control" 
                            value="<?= date('Y-m') ?>"
                            required
                          >
                          <button type="button" class="btn btn-primary btn-sm" id="tomboltampilatkkeluar">
                            <i class="fas fa-search"></i> Tampilkan
                          </button>
                        </div>
                      </div>
                    <div class="viewtampilgrafikatkkeluar"></div>
                  </div>
                </div>
              </div>
          </div>
            
        </div>
    </section>

<script>
function tampilgrafik(){
  $.ajax({
    type: "post",
    url: "laporan/tampilgrafikatkmasuk",
    data: {
      bulan : $('#bulan').val()
    },
    dataType: "json",
    beforeSend:function(){
      $('.viewtampilgrafik').html('<i class="fas fa-spinner"></i>');
    },
    success: function (response) {
      if(response.data){
        $('.viewtampilgrafik').html(response.data);
      }
    },
    error: function(xhr,ajaxOptions,thrownError){
        alert(xhr.status+'\n'+thrownError);
    }
  });
}

function tampilgrafikatkkeluar(){
  $.ajax({
    type: "post",
    url: "laporan/tampilgrafikatkkeluar",
    data: {
      bulan : $('#bulan2').val()
    },
    dataType: "json",
    beforeSend:function(){
      $('.viewtampilgrafikatkkeluar').html('<i class="fas fa-spinner"></i>');
    },
    success: function (response) {
      if(response.data){
        $('.viewtampilgrafikatkkeluar').html(response.data);
      }
    },
    error: function(xhr,ajaxOptions,thrownError){
        alert(xhr.status+'\n'+thrownError);
    }
  });
}

$(document).ready(function () {
  tampilgrafik();
  tampilgrafikatkkeluar();

  $('#tomboltampil').click(function (e) { 
    e.preventDefault();
    tampilgrafik();
  });

  $('#tomboltampilatkkeluar').click(function (e) { 
    e.preventDefault();
    tampilgrafikatkkeluar();
  });
});
</script>
<?= $this->endSection()?>