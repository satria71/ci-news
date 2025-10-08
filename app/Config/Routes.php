<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// kalau mau improved, aktifkan di Config\Feature.php
// $autoRoutesImproved = true;
// $routes->resource('masteratk');

//login
$routes->get('auth', 'Auth::index');
$routes->get('login', 'Auth::login');
$routes->post('auth/loginProcess', 'Auth::loginProcess');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('/', 'Home::index');
// $routes->addRedirect('/', 'home');
$routes->get('masteratk', 'MasterAtk::index');
// $routes->get('masteratk/show', 'MasterAtk::getData');
//read
$routes->get('masteratk/add', 'MasterAtk::create');
//create
$routes->post('masteratk', 'MasterAtk::store');
//update
$routes->get('masteratk/edit/(:any)', 'MasterAtk::edit/$1');
$routes->put('masteratk/(:any)', 'MasterAtk::update/$1');
//delete
$routes->delete('masteratk/(:any)', 'MasterAtk::delete/$1');
$routes->post('masteratk/delete', 'MasterAtk::delete');


//ATK Datang
$routes->get('atk/datang', 'AtkDatang::index');

//voucher
$routes->get('voucher', 'Voucher::index');
$routes->get('voucher/formtambah', 'voucher::formtambah');
$routes->post('voucher/simpandata', 'voucher::simpandata');
//update
$routes->get('voucher/formedit/(:any)', 'voucher::formedit/$1');
$routes->put('voucher/(:any)', 'voucher::update/$1');

$routes->match(['get', 'post'], 'masteratk/dt_masteratk', 'MasterAtk::dt_masteratk');
$routes->post('masteratk/proseseditdata', 'MasterAtk::proseseditdata');
$routes->get('masteratk/editdata/(:num)', 'MasterAtk::editdata/$1');
$routes->match(['get','post'], 'masteratk/save', 'MasterAtk::save');

$routes->get('atkmasuk', 'AtkMasuk::index');

$routes->match(['get', 'post'],'atkmasuk/datatemp', 'AtkMasuk::datatemp');
$routes->match(['get', 'post'],'atkmasuk/ambildatabarang', 'AtkMasuk::ambildatabarang');
$routes->match(['get', 'post'],'atkmasuk/simpantemp', 'AtkMasuk::simpantemp');
$routes->match(['get', 'post'],'atkmasuk/hapus', 'AtkMasuk::hapus');
$routes->match(['get', 'post'],'atkmasuk/caridatabarang', 'AtkMasuk::caridatabarang');
$routes->match(['get', 'post'],'atkmasuk/modaldetailcaribarang', 'AtkMasuk::modaldetailcaribarang');
$routes->match(['get', 'post'],'atkmasuk/selesaitransaksi', 'AtkMasuk::selesaitransaksi');
$routes->match(['get', 'post'],'atkmasuk/data', 'AtkMasuk::data');
$routes->match(['get', 'post'],'atkmasuk/index', 'AtkMasuk::index');
$routes->match(['get', 'post'],'atkmasuk/dt_transaksiatk', 'AtkMasuk::dt_transaksiatk');
$routes->match(['get', 'post'],'atkmasuk/detailitem', 'AtkMasuk::detailitem');
$routes->match(['get', 'post'],'atkmasuk/edittransaksi/(:any)', 'AtkMasuk::edittransaksi/$1');
$routes->match(['get', 'post'],'atkmasuk/datadetailtransaksi', 'AtkMasuk::datadetailtransaksi');
$routes->match(['get','post'], 'atkmasuk/edititem', 'AtkMasuk::edititem');
$routes->match(['get','post'], 'atkmasuk/simpandetailsj', 'AtkMasuk::simpandetailsj');
$routes->match(['get','post'], 'atkmasuk/updateitemsj', 'AtkMasuk::updateitemsj');
$routes->match(['get','post'], 'atkmasuk/hapusitemdetail', 'AtkMasuk::hapusitemdetail');
$routes->match(['get','post'], 'atkmasuk/hapustransaksi', 'AtkMasuk::hapustransaksi');

//ATK KELUAR
$routes->match(['get','post'], 'atkkeluar/data', 'AtkKeluar::data');
$routes->match(['get', 'post'],'atkkeluar/index', 'AtkKeluar::index');
$routes->match(['get', 'post'],'atkkeluar/input', 'AtkKeluar::input');
$routes->match(['get', 'post'],'atkkeluar/buatnosjinputan', 'AtkKeluar::buatnosjinputan');
$routes->match(['get', 'post'],'atkkeluar/datatemp', 'AtkKeluar::datatemp');
$routes->match(['get', 'post'],'atkkeluar/ambildatabarang', 'AtkKeluar::ambildatabarang');
$routes->match(['get', 'post'],'atkkeluar/datatemp', 'AtkKeluar::datatemp');
$routes->match(['get', 'post'],'atkkeluar/simpantemp', 'AtkKeluar::simpantemp');
$routes->match(['get', 'post'],'atkkeluar/hapus', 'AtkKeluar::hapus');
$routes->match(['get', 'post'],'atkkeluar/modalcaribarang', 'AtkKeluar::modalcaribarang');
$routes->match(['get', 'post'],'atkkeluar/listdatabarang', 'AtkKeluar::listdatabarang');
$routes->match(['get', 'post'],'atkkeluar/selesaitransaksi', 'AtkKeluar::selesaitransaksi');
$routes->match(['get', 'post'],'atkkeluar/cetaksj/(:any)', 'AtkKeluar::cetaksj/$1');
$routes->match(['get', 'post'],'atkkeluar/listdata', 'AtkKeluar::listdata');
$routes->match(['get', 'post'],'atkkeluar/hapustransaksi', 'AtkKeluar::hapustransaksi');
$routes->match(['get', 'post'],'atkkeluar/edit/(:any)', 'AtkKeluar::edit/$1');
$routes->match(['get', 'post'],'atkkeluar/ambiltotalharga', 'AtkKeluar::ambiltotalharga');
$routes->match(['get', 'post'],'atkkeluar/totalharga', 'AtkKeluar::totalharga');
$routes->match(['get', 'post'],'atkkeluar/datadetail', 'AtkKeluar::datadetail');
$routes->match(['get', 'post'],'atkkeluar/hapusitemdetail', 'AtkKeluar::hapusitemdetail');
$routes->match(['get', 'post'],'atkkeluar/edititem', 'AtkKeluar::edititem');
$routes->match(['get', 'post'],'atkkeluar/updateitemsj', 'AtkKeluar::updateitemsj');
$routes->match(['get', 'post'],'atkkeluar/simpandetail', 'AtkKeluar::simpandetail');

//KARYAWAN
$routes->match(['get', 'post'],'karyawan/formtambah', 'Karyawan::formtambah');
$routes->match(['get', 'post'],'karyawan/simpan', 'Karyawan::simpan');
$routes->match(['get', 'post'],'karyawan/modaldatakaryawan', 'Karyawan::modaldatakaryawan');
$routes->match(['get', 'post'],'karyawan/listdata', 'Karyawan::listdata');
$routes->match(['get', 'post'],'karyawan/hapus', 'Karyawan::hapus');

//LAPORAN
$routes->match(['get', 'post'],'laporan/data', 'laporan::index');
$routes->match(['get', 'post'],'laporan/cetakatkmasuk', 'laporan::cetakatkmasuk');
$routes->match(['get', 'post'],'laporan/cetakatkmasukperiode', 'laporan::cetakatkmasukperiode');