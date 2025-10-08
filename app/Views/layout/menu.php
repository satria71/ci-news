<br>
<center><h6 style="letter-spacing:1px;">Management System</h6></center>
<li class="menu-header">Main Menu</li>
<li><a class="nav-link" href="<?= site_url()?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
<!-- <li><a class="nav-link" href="<?= site_url('barang')?>"><i class="fas fa-lemon"></i> <span>Cek Kesegaran</span></a></li> -->

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>ATK</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url('masteratk')?>">Master ATK</a></li>
        <li><a class="nav-link" href="<?= site_url('atkmasuk/data')?>">ATK Masuk</a></li>
        <li><a class="nav-link" href="<?= site_url('atkkeluar/data')?>">ATK Keluar</a></li>
        <li><a class="nav-link" href="<?= site_url('laporan/data')?>"">Laporan ATK</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-ticket-alt"></i> <span>Voucher</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="<?= site_url('voucher')?>">Master Voucher</a></li>
        <li><a class="nav-link" href="<?= site_url('AktivaSupport/datang')?>">Temuan Voucher</a></li>
        <li><a class="nav-link" href="">Cek Laporan</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-business-time"></i><span>Lembur</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Master Karyawan</a></li>
        <li><a class="nav-link" href="">Input SPL</a></li>
        <li><a class="nav-link" href="">Monitoring SPL</a></li>
        <li><a class="nav-link" href="">Cetak Laporan</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-fighter-jet"></i><span>Mutasi Barang</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Barang</a></li>
        <li><a class="nav-link" href="">Input Mutasi</a></li>
        <li><a class="nav-link" href="">Monitoring Mutasi</a></li>
        <li><a class="nav-link" href="">Cetak Laporan</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-truck-moving"></i><span>TAG</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Input TAG</a></li>
        <li><a class="nav-link" href="">Cetak Laporan</a></li>
    </ul>
</li>

<li class="nav-item dropdown">
<a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i><span>Support</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="">Barang Masuk</a></li>
        <li><a class="nav-link" href="">Barang Keluar</a></li>
        <li><a class="nav-link" href="">Kartu Stok</a></li>
        <li><a class="nav-link" href="">Segel</a></li>
    </ul>
</li>

<li><a class="nav-link" href="<?= site_url('barang')?>"><i class="fas fa-user"></i> <span>Manage User</span></a></li>
