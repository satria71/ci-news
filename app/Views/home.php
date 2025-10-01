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

            <div class="row">
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
            </div>

            <!-- <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Real Time Chart Suhu Coolroom</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="ChartSuhu"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Real Time Chart Kelembapan Coolroom</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="ChartKelembapan"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="row">
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Summary Container</h4>
                  </div>
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-item">
                        <ul class="list-unstyled list-unstyled-border">
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../../public/template/assets/img/products/product-4-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Container Baik</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?> </div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-1-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Container Rusak</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?> </div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-2-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Total Container</a></div>
                              <div class="text-muted text-small">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Summary Bronjong</h4>
                  </div>
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-item">
                        <ul class="list-unstyled list-unstyled-border">
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-4-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Bronjong Baik</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?></div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-1-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Bronjong Rusak</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?></div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-2-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Total Bronjong</a></div>
                              <div class="text-muted text-small">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Summary Dollies</h4>
                  </div>
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-item">
                        <ul class="list-unstyled list-unstyled-border">
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-4-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Dollies Baik</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?></div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-1-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Dollies Rusak</a></div>
                              <div class="text-small text-muted">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?></div>
                            </div>
                          </li>
                          <li class="media">
                            <a href="#">
                              <img alt="image" class="mr-3 rounded" width="50" src="../assets/img/products/product-2-50.png">
                            </a>
                            <div class="media-body">
                              <div class="media-right">-</div>
                              <div class="media-title"><a href="#">Total Dollies</a></div>
                              <div class="text-muted text-small">by <a href="#">DC Malang</a> <div class="bullet"></div> <?php echo date("l");?>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
        </div>
    </section>
<?= $this->endSection()?>