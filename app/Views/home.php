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
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Stok Terbanyak</h4> -->
                    <!-- <div class="card-header-action">
                      <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div> -->
                  <!-- </div>
                  <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th>Kode Barang</th>
                            <th>Desc</th>
                            <th>Status</th>
                            <th>Stok</th>
                            <th>Action</th>
                          </tr>
                          <tr>
                            <td><a href="#">INV-87239</a></td>
                            <td class="font-weight-600">Kusnadi</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>July 19, 2018</td>
                            <td>
                              <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">INV-48574</a></td>
                            <td class="font-weight-600">Hasan Basri</td>
                            <td><div class="badge badge-success">Paid</div></td>
                            <td>July 21, 2018</td>
                            <td>
                              <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">INV-76824</a></td>
                            <td class="font-weight-600">Muhamad Nuruzzaki</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>July 22, 2018</td>
                            <td>
                              <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">INV-84990</a></td>
                            <td class="font-weight-600">Agung Ardiansyah</td>
                            <td><div class="badge badge-warning">Unpaid</div></td>
                            <td>July 22, 2018</td>
                            <td>
                              <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                          </tr>
                          <tr>
                            <td><a href="#">INV-87320</a></td>
                            <td class="font-weight-600">Ardian Rahardiansyah</td>
                            <td><div class="badge badge-success">Paid</div></td>
                            <td>July 28, 2018</td>
                            <td>
                              <a href="#" class="btn btn-primary">Detail</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div class="row">
              <div class="col-lg-4">
                <div class="card gradient-bottom">
                  <div class="card-header">
                    <h4>5 Item Stok Tertinggi</h4>
                  </div>
                  <div class="card-body" id="top-5-scroll">
                    <ul class="list-unstyled list-unstyled-border">
                      <li class="media">
                        <img class="mr-3 rounded" width="55" src="<?=base_url()?>/template/assets/img/products/product-3-50.png" alt="product">
                        <div class="media-body">
                          <div class="float-right"><div class="font-weight-600 text-muted text-small">86 Sales</div></div>
                          <div class="media-title">oPhone S9 Limited</div>
                          <div class="mt-1">
                            <div class="budget-price">
                              <div class="budget-price-square bg-primary" data-width="64%"></div>
                              <div class="budget-price-label">$68,714</div>
                            </div>
                            <div class="budget-price">
                              <div class="budget-price-square bg-danger" data-width="43%"></div>
                              <div class="budget-price-label">$38,700</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img class="mr-3 rounded" width="55" src="<?=base_url()?>/template/assets/img/products/product-4-50.png" alt="product">
                        <div class="media-body">
                          <div class="float-right"><div class="font-weight-600 text-muted text-small">67 Sales</div></div>
                          <div class="media-title">iBook Pro 2018</div>
                          <div class="mt-1">
                            <div class="budget-price">
                              <div class="budget-price-square bg-primary" data-width="84%"></div>
                              <div class="budget-price-label">$107,133</div>
                            </div>
                            <div class="budget-price">
                              <div class="budget-price-square bg-danger" data-width="60%"></div>
                              <div class="budget-price-label">$91,455</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img class="mr-3 rounded" width="55" src="<?=base_url()?>/template/assets/img/products/product-1-50.png" alt="product">
                        <div class="media-body">
                          <div class="float-right"><div class="font-weight-600 text-muted text-small">63 Sales</div></div>
                          <div class="media-title">Headphone Blitz</div>
                          <div class="mt-1">
                            <div class="budget-price">
                              <div class="budget-price-square bg-primary" data-width="34%"></div>
                              <div class="budget-price-label">$3,717</div>
                            </div>
                            <div class="budget-price">
                              <div class="budget-price-square bg-danger" data-width="28%"></div>
                              <div class="budget-price-label">$2,835</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img class="mr-3 rounded" width="55" src="<?=base_url()?>/template/assets/img/products/product-3-50.png" alt="product">
                        <div class="media-body">
                          <div class="float-right"><div class="font-weight-600 text-muted text-small">28 Sales</div></div>
                          <div class="media-title">oPhone X Lite</div>
                          <div class="mt-1">
                            <div class="budget-price">
                              <div class="budget-price-square bg-primary" data-width="45%"></div>
                              <div class="budget-price-label">$13,972</div>
                            </div>
                            <div class="budget-price">
                              <div class="budget-price-square bg-danger" data-width="30%"></div>
                              <div class="budget-price-label">$9,660</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="media">
                        <img class="mr-3 rounded" width="55" src="<?=base_url()?>/template/assets/img/products/product-5-50.png" alt="product">
                        <div class="media-body">
                          <div class="float-right"><div class="font-weight-600 text-muted text-small">19 Sales</div></div>
                          <div class="media-title">Old Camera</div>
                          <div class="mt-1">
                            <div class="budget-price">
                              <div class="budget-price-square bg-primary" data-width="35%"></div>
                              <div class="budget-price-label">$7,391</div>
                            </div>
                            <div class="budget-price">
                              <div class="budget-price-square bg-danger" data-width="28%"></div>
                              <div class="budget-price-label">$5,472</div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer pt-3 d-flex justify-content-center">
                    <div class="budget-price justify-content-center">
                      <div class="budget-price-square bg-primary" data-width="20"></div>
                      <div class="budget-price-label">Selling Price</div>
                    </div>
                    <div class="budget-price justify-content-center">
                      <div class="budget-price-square bg-danger" data-width="20"></div>
                      <div class="budget-price-label">Budget Price</div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

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