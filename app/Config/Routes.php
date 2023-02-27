<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * API
 * --------------------------------------------------------------------
 */
// $routes->resource();
// $routes->get('user/(:num)', 'API/User::show/$1');
$routes->add('register', 'API/User::register');
$routes->add('login', 'API/User::login');
$routes->post('reGenToken', 'API/Token::reGenToken');

// routes Data User 
$routes->resource('datausers', ['controller' => 'DataUsers'], ['filter' => 'auth']);
$routes->post('datausers/(:num)', 'DataUsers::update/$1', ['filter' => 'auth']);
$routes->get('userbylevel/(:num)', 'DataUsers::showLevelId/$1', ['filter' => 'auth']);

// routes Home
$routes->resource('home', ['controller' => 'Home'], ['filter' => 'auth']);
$routes->post('home/(:num)', 'Home::update/$1', ['filter' => 'auth']);
$routes->post('home/(:num)', 'Home::update2/$1', ['filter' => 'auth']);
$routes->post('home/(:num)', 'Home::update3/$1', ['filter' => 'auth']);

// $routes->resource('API/Client'); // Equivalent to the following:
$routes->resource('konven', ['controller' => 'Konven'], ['filter' => 'auth']);
$routes->get('konven', 'Konven::index', ['filter' => 'auth']);
$routes->post('konven', 'Konven::create', ['filter' => 'auth']);
$routes->get('konven/(:num)', 'Konven::show/$1', ['filter' => 'auth']);
$routes->put('konven/(:num)', 'Konven::update/$1', ['filter' => 'auth']);
$routes->delete('konven/(:num)', 'Konven::delete/$1', ['filter' => 'auth']);
$routes->get('konvenbylevel/(:num)', 'Konven::showLevelId/$1', ['filter' => 'auth']);

// routes produk konven
$routes->resource('danakonven', ['controller' => 'DanaKonven'], ['filter' => 'auth']);
$routes->resource('kredit', ['controller' => 'Kredit'], ['filter' => 'auth']);
$routes->resource('jasakonven', ['controller' => 'JasaKonven'], ['filter' => 'auth']);
// routes dana konven
$routes->resource('tabkonven', ['controller' => 'TabKonven'], ['filter' => 'auth']);
$routes->get('tabkonven/(:num)', 'TabKonven::show/$1', ['filter' => 'auth']);
$routes->resource('detailtabkonven', ['controller' => 'DetailTabKonven'], ['filter' => 'auth']);
$routes->get('detailtabkonven/(:num)', 'DetailTabKonven::show/$1', ['filter' => 'auth']);
$routes->post('detailtabkonven/(:num)', 'DetailTabKonven::update/$1', ['filter' => 'auth']);
$routes->post('detailtabkonven/(:num)', 'DetailTabKonven::approve/$1', ['filter' => 'auth']);
$routes->post('detailtabkonven/(:num)', 'DetailTabKonven::update2/$1', ['filter' => 'auth']);
$routes->post('detailtabkonven/(:num)', 'DetailTabKonven::update3/$1', ['filter' => 'auth']);
$routes->resource('girokonven', ['controller' => 'GiroKonven'], ['filter' => 'auth']);
$routes->resource('detailgirokonven', ['controller' => 'DetailGiroKonven'], ['filter' => 'auth']);
$routes->post('detailgirokonven/(:num)', 'DetailGiroKonven::approve/$1', ['filter' => 'auth']);
$routes->get('detailgirokonven/(:num)', 'DetailGiroKonven::show/$1', ['filter' => 'auth']);
$routes->post('detailgirokonven/(:num)', 'DetailGiroKonven::update/$1', ['filter' => 'auth']);
$routes->post('detailgirokonven/(:num)', 'DetailGiroKonven::update2/$1', ['filter' => 'auth']);
$routes->post('detailgirokonven/(:num)', 'DetailGiroKonven::update3/$1', ['filter' => 'auth']);
$routes->resource('depositokonven', ['controller' => 'DepositoKonven'], ['filter' => 'auth']);
$routes->get('detaildepokonven/(:num)', 'DetailDepoKonven::show/$1', ['filter' => 'auth']);
$routes->post('detaildepokonven/(:num)', 'DetailDepoKonven::update/$1', ['filter' => 'auth']);
$routes->post('detaildepokonven/(:num)', 'DetailDepoKonven::update2/$1', ['filter' => 'auth']);
$routes->post('detaildepokonven/(:num)', 'DetailDepoKonven::update3/$1', ['filter' => 'auth']);
$routes->resource('kategori', ['controller' => 'Kategori'], ['filter' => 'auth']);

// routes kredit
$routes->resource('kreditproduktif', ['controller' => 'KreditProduktif'], ['filter' => 'auth']);
$routes->resource('kreditkonsumer', ['controller' => 'KreditKonsumer'], ['filter' => 'auth']);
$routes->resource('kreditstandar', ['controller' => 'KreditStandar'], ['filter' => 'auth']);
$routes->resource('kreditprogram', ['controller' => 'KreditProgram'], ['filter' => 'auth']);
$routes->get('detailkredit/(:num)', 'DetailKredit::show/$1', ['filter' => 'auth']);
$routes->resource('detailkredit', ['controller' => 'DetailKredit'], ['filter' => 'auth']);
$routes->post('detailkredit/(:num)', 'DetailKredit::approve/$1', ['filter' => 'auth']);
$routes->post('detailkredit/(:num)', 'DetailKredit::update/$1', ['filter' => 'auth']);
$routes->post('detailkredit/(:num)', 'DetailKredit::update2/$1', ['filter' => 'auth']);
$routes->post('detailkredit/(:num)', 'DetailKredit::update3/$1', ['filter' => 'auth']);
$routes->resource('detailkreditproduktif', ['controller' => 'DetailKreditProduktif'], ['filter' => 'auth']);
$routes->post('detailkreditproduktif/(:num)', 'DetailKreditProduktif::approve/$1', ['filter' => 'auth']);
$routes->post('detailkreditproduktif/(:num)', 'DetailKreditProduktif::update/$1', ['filter' => 'auth']);
$routes->post('detailkreditproduktif/(:num)', 'DetailKreditProduktif::update2/$1', ['filter' => 'auth']);
$routes->post('detailkreditproduktif/(:num)', 'DetailKreditProduktif::update3/$1', ['filter' => 'auth']);
$routes->resource('detailkreditkonsumer', ['controller' => 'DetailKreditKonsumer'], ['filter' => 'auth']);
$routes->post('detailkreditkonsumer/(:num)', 'DetailKreditKonsumer::update/$1', ['filter' => 'auth']);
$routes->post('detailkreditkonsumer/(:num)', 'DetailKreditKonsumer::update2/$1', ['filter' => 'auth']);
$routes->post('detailkreditkonsumer/(:num)', 'DetailKreditKonsumer::update3/$1', ['filter' => 'auth']);
$routes->post('detailkreditkonsumer/(:num)', 'DetailKreditKonsumer::approve/$1', ['filter' => 'auth']);
$routes->resource('detailkreditstandar', ['controller' => 'DetailKreditStandar'], ['filter' => 'auth']);
$routes->post('detailkreditstandar/(:num)', 'DetailKreditStandar::approve/$1', ['filter' => 'auth']);
$routes->post('detailkreditstandar/(:num)', 'DetailKreditStandar::update/$1', ['filter' => 'auth']);
$routes->post('detailkreditstandar/(:num)', 'DetailKreditStandar::update2/$1', ['filter' => 'auth']);
$routes->post('detailkreditstandar/(:num)', 'DetailKreditStandar::update3/$1', ['filter' => 'auth']);
$routes->post('detailkreditstandar/(:num)', 'DetailKreditStandar::update4/$1', ['filter' => 'auth']);
$routes->resource('detailkreditprogram', ['controller' => 'DetailKreditProgram'], ['filter' => 'auth']);
$routes->post('detailkreditprogram/(:num)', 'DetailKreditProgram::update/$1', ['filter' => 'auth']);
$routes->post('detailkreditprogram/(:num)', 'DetailKreditProgram::update2/$1', ['filter' => 'auth']);
$routes->post('detailkreditprogram/(:num)', 'DetailKreditProgram::update3/$1', ['filter' => 'auth']);
$routes->post('detailkreditprogram/(:num)', 'DetailKreditProgram::approve/$1', ['filter' => 'auth']);
 
// routes Jasa Konven
$routes->resource('kirimanuangkonven', ['controller' => 'KirimanUangKonven'], ['filter' => 'auth']);
$routes->resource('detailjasakonven', ['controller' => 'DetailJasaKonven'], ['filter' => 'auth']);
$routes->post('detailjasakonven/(:num)', 'DetailJasaKonven::update/$1', ['filter' => 'auth']);
$routes->post('detailjasakonven/(:num)', 'DetailJasaKonven::update2/$1', ['filter' => 'auth']);
$routes->post('detailjasakonven/(:num)', 'DetailJasaKonven::update3/$1', ['filter' => 'auth']);
$routes->post('detailjasakonven/(:num)', 'DetailJasaKonven::approve/$1', ['filter' => 'auth']);
$routes->resource('detailkirimanuang', ['controller' => 'DetailKirimanUang'], ['filter' => 'auth']);
$routes->post('detailkirimanuang/(:num)', 'DetailKirimanUang::update/$1', ['filter' => 'auth']);
$routes->post('detailkirimanuang/(:num)', 'DetailKirimanUang::update2/$1', ['filter' => 'auth']);
$routes->post('detailkirimanuang/(:num)', 'DetailKirimanUang::update3/$1', ['filter' => 'auth']);
$routes->post('detailkirimanuang/(:num)', 'DetailKirimanUang::approve/$1', ['filter' => 'auth']);


// routes produk syariah
$routes->resource('syariah', ['controller' => 'Syariah'], ['filter' => 'auth']);
$routes->resource('danasyariah', ['controller' => 'DanaSyariah'], ['filter' => 'auth']);
$routes->resource('pembiayaan', ['controller' => 'Pembiayaan'], ['filter' => 'auth']);
$routes->resource('detailpembiayaan', ['controller' => 'DetailPembiayaan'], ['filter' => 'auth']);
$routes->post('detailpembiayaan/(:num)', 'DetailPembiayaan::update/$1', ['filter' => 'auth']);
$routes->post('detailpembiayaan/(:num)', 'DetailPembiayaan::update2/$1', ['filter' => 'auth']);
$routes->post('detailpembiayaan/(:num)', 'DetailPembiayaan::update3/$1', ['filter' => 'auth']);
$routes->post('detailpembiayaan/(:num)', 'DetailPembiayaan::approve/$1', ['filter' => 'auth']);
$routes->resource('jasasyariah', ['controller' => 'JasaSyariah'], ['filter' => 'auth']);
$routes->resource('detailjasasyariah', ['controller' => 'DetailJasaSyariah'], ['filter' => 'auth']);
$routes->post('detailjasasyariah/(:num)', 'DetailJasaSyariah::update/$1', ['filter' => 'auth']);
$routes->post('detailjasasyariah/(:num)', 'DetailJasaSyariah::update2/$1', ['filter' => 'auth']);
$routes->post('detailjasasyariah/(:num)', 'DetailJasaSyariah::update3/$1', ['filter' => 'auth']);
$routes->resource('girosyariah', ['controller' => 'GiroSyariah'], ['filter' => 'auth']);
$routes->resource('detailgirosyariah', ['controller' => 'DetailGiroSyariah'], ['filter' => 'auth']);
$routes->post('detailgirosyariah/(:num)', 'DetailGiroSyariah::update/$1', ['filter' => 'auth']);
$routes->post('detailgirosyariah/(:num)', 'DetailGiroSyariah::update2/$1', ['filter' => 'auth']);
$routes->post('detailgirosyariah/(:num)', 'DetailGiroSyariah::update3/$1', ['filter' => 'auth']);
$routes->post('detailgirosyariah/(:num)', 'DetailGiroSyariah::approve/$1', ['filter' => 'auth']);
$routes->resource('depositosyariah', ['controller' => 'DepositoSyariah'], ['filter' => 'auth']);
$routes->resource('detaildeposyariah', ['controller' => 'DetailDepoSyariah'], ['filter' => 'auth']);
$routes->post('detaildeposyariah/(:num)', 'DetailDepoSyariah::update/$1', ['filter' => 'auth']);
$routes->post('detaildeposyariah/(:num)', 'DetailDepoSyariah::update2/$1', ['filter' => 'auth']);
$routes->post('detaildeposyariah/(:num)', 'DetailDepoSyariah::update3/$1', ['filter' => 'auth']);
$routes->post('detaildeposyariah/(:num)', 'DetailDepoSyariah::approve/$1', ['filter' => 'auth']);
$routes->resource('tabsyariah', ['controller' => 'TabSyariah'], ['filter' => 'auth']);
$routes->resource('detailtabsyariah', ['controller' => 'DetailTabSyariah'], ['filter' => 'auth']);
$routes->post('detailtabsyariah/(:num)', 'DetailTabSyariah::update/$1', ['filter' => 'auth']);
$routes->post('detailtabsyariah/(:num)', 'DetailTabSyariah::update2/$1', ['filter' => 'auth']);
$routes->post('detailtabsyariah/(:num)', 'DetailTabSyariah::update3/$1', ['filter' => 'auth']);
$routes->post('detailtabsyariah/(:num)', 'DetailTabSyariah::approve/$1', ['filter' => 'auth']);
$routes->resource('modalkerja', ['controller' => 'ModalKerja'], ['filter' => 'auth']);
$routes->resource('detailmodalkerja', ['controller' => 'DetailModalKerja'], ['filter' => 'auth']);
$routes->post('detailmodalkerja/(:num)', 'DetailModalKerja::update/$1', ['filter' => 'auth']);
$routes->post('detailmodalkerja/(:num)', 'DetailModalKerja::update2/$1', ['filter' => 'auth']);
$routes->post('detailmodalkerja/(:num)', 'DetailModalKerja::update3/$1', ['filter' => 'auth']);
$routes->post('detailmodalkerja/(:num)', 'DetailModalKerja::approve/$1', ['filter' => 'auth']);
$routes->resource('investasi', ['controller' => 'Investasi'], ['filter' => 'auth']);
$routes->resource('detailinvestasi', ['controller' => 'DetailInvestasi'], ['filter' => 'auth']);
$routes->post('detailinvestasi/(:num)', 'DetailInvestasi::update/$1', ['filter' => 'auth']);
$routes->post('detailinvestasi/(:num)', 'DetailInvestasi::update2/$1', ['filter' => 'auth']);
$routes->post('detailinvestasi/(:num)', 'DetailInvestasi::update3/$1', ['filter' => 'auth']);
$routes->post('detailinvestasi/(:num)', 'DetailInvestasi::approve/$1', ['filter' => 'auth']);
$routes->resource('kirimanuangsyariah', ['controller' => 'KirimanUangSyariah'], ['filter' => 'auth']);
$routes->resource('detailkirimanuangsyariah', ['controller' => 'DetailKirimanUangSyariah'], ['filter' => 'auth']);
$routes->post('detailkirimanuangsyariah/(:num)', 'DetailKirimanUangSyariah::update/$1', ['filter' => 'auth']);
$routes->post('detailkirimanuangsyariah/(:num)', 'DetailKirimanUangSyariah::update2/$1', ['filter' => 'auth']);
$routes->post('detailkirimanuangsyariah/(:num)', 'DetailKirimanUangSyariah::update3/$1', ['filter' => 'auth']);

// routes informasi
$routes->resource('informasi', ['controller' => 'Informasi'], ['filter' => 'auth']);
$routes->resource('jaringanpelayanan', ['controller' => 'JaringanPelayanan'], ['filter' => 'auth']);
$routes->resource('lokasiatm', ['controller' => 'LokasiATM'], ['filter' => 'auth']);
$routes->resource('lokasilayanan', ['controller' => 'LokasiLayanan'], ['filter' => 'auth']);
$routes->resource('lokasilayananatm', ['controller' => 'LokasiLayananATM'], ['filter' => 'auth']);
$routes->get('detaillokasilayananbyid/(:num)', 'DetailLokasiLayanan::showById/$1', ['filter' => 'auth']);
$routes->resource('detaillokasilayanan', ['controller' => 'DetailLokasiLayanan'], ['filter' => 'auth']);
$routes->resource('detaillokasiatm', ['controller' => 'DetailLokasiAtm'], ['filter' => 'auth']);
$routes->get('detaillokasiatmbyid/(:num)', 'DetailLokasiAtm::showById/$1', ['filter' => 'auth']);

$routes->resource('cabangutama', ['controller' => 'CabangUtama'], ['filter' => 'auth']);

// routes internal
$routes->resource('internal', ['controller' => 'Internal'], ['filter' => 'auth']);
$routes->resource('detailinternal', ['controller' => 'DetailInternal'], ['filter' => 'auth']);
$routes->get('detailinternalbyid/(:num)', 'DetailInternal::showById/$1', ['filter' => 'auth']);
$routes->get('detailinternalbyid/(:num)/(:num)', 'DetailInternal::showParentID/$1/$1', ['filter' => 'auth']);
$routes->resource('stdlayanan', ['controller' => 'StdLayanan'], ['filter' => 'auth']);
$routes->resource('detailstdlayanan', ['controller' => 'DetailStdLayanan'], ['filter' => 'auth']);
$routes->get('detailstdlayanan/(:num)', 'DetailStdLayanan::show/$1', ['filter' => 'auth']);
$routes->post('detailstdlayanan/(:num)', 'DetailStdLayanan::update/$1', ['filter' => 'auth']);
$routes->post('detailstdlayanan/(:num)', 'DetailStdLayanan::update2/$1', ['filter' => 'auth']);
$routes->post('detailstdlayanan/(:num)', 'DetailStdLayanan::update3/$1', ['filter' => 'auth']);
$routes->resource('bdykerja', ['controller' => 'BdyKerja'], ['filter' => 'auth']);
$routes->resource('detailbdykerja', ['controller' => 'DetailBdyKerja'], ['filter' => 'auth']);
$routes->get('detailbdykerja/(:num)', 'DetailBdyKerja::show/$1', ['filter' => 'auth']);
$routes->post('detailbdykerja/(:num)', 'DetailBdyKerja::update/$1', ['filter' => 'auth']);
$routes->post('detailbdykerja/(:num)', 'DetailBdyKerja::update2/$1', ['filter' => 'auth']);
$routes->post('detailbdykerja/(:num)', 'DetailBdyKerja::update3/$1', ['filter' => 'auth']);
$routes->resource('identitas', ['controller' => 'IdentitasPribadi'], ['filter' => 'auth']);
$routes->resource('standarlayanan', ['controller' => 'StandarLayanan'], ['filter' => 'auth']);
$routes->resource('detailstandarlayanan', ['controller' => 'DetailStandarLayanan'], ['filter' => 'auth']);
$routes->get('detailstandarlayanan/(:num)', 'DetailStandarLayanan::show/$1', ['filter' => 'auth']);
$routes->post('detailstandarlayanan/(:num)', 'DetailStandarLayanan::update/$1', ['filter' => 'auth']);
$routes->post('detailstandarlayanan/(:num)', 'DetailStandarLayanan::update2/$1', ['filter' => 'auth']);
$routes->post('detailstandarlayanan/(:num)', 'DetailStandarLayanan::update3/$1', ['filter' => 'auth']);
$routes->delete('detailidentitas/(:num)', 'DetailIdentitas::delete/$1', ['filter' => 'auth']);
$routes->resource('detailidentitas', ['controller' => 'DetailIdentitas'], ['filter' => 'auth']);
$routes->post('detailidentitas/(:num)', 'DetailIdentitas::update/$1', ['filter' => 'auth']);
$routes->post('detailidentitas/(:num)', 'DetailIdentitas::update2/$1', ['filter' => 'auth']);
$routes->post('detailidentitas/(:num)', 'DetailIdentitas::update3/$1', ['filter' => 'auth']);
$routes->delete('detailidentitas/(:num)', 'DetailIdentitas::delete/$1', ['filter' => 'auth']);
$routes->get('detailidentitas/(:num)', 'DetailIdentitas::show/$1', ['filter' => 'auth']);
 


// routes Data Divisi atau level
$routes->resource('level', ['controller' => 'Level'], ['filter' => 'auth']);
$routes->post('level/(:num)', 'Level::updateLevelAkses/$1', ['filter' => 'auth']);
$routes->resource('levellink', ['controller' => 'LevelLink'], ['filter' => 'auth']);
$routes->get('levellinkbyid/(:num)', 'LevelLink::showByLevelId/$1', ['filter' => 'auth']);
$routes->delete('levellinkbyid/(:num)', 'LevelLink::delete/$1', ['filter' => 'auth']);

// routes Helpdesk
$routes->resource('helpdesk', ['controller' => 'Helpdesk'], ['filter' => 'auth']);

// routes search
$routes->resource('search', ['controller' => 'Search'], ['filter' => 'auth']);


$routes->get('syariah', 'Syariah::index', ['filter' => 'auth']);
$routes->post('syariah', 'Syariah::create', ['filter' => 'auth']);
$routes->get('syariah/(:num)', 'Syariah::show/$1', ['filter' => 'auth']);
$routes->put('syariah/(:num)', 'Syariah::update/$1', ['filter' => 'auth']);
$routes->delete('syariah/(:num)', 'Syariah::delete/$1', ['filter' => 'auth']);


$routes->get('danasyariah', 'DanaSyariah::index', ['filter' => 'auth']);
$routes->post('danasyariah', 'DanaSyariah::create', ['filter' => 'auth']);
$routes->get('danasyariah/(:num)', 'DanaSyariah::show/$1', ['filter' => 'auth']);
$routes->put('danasyariah/(:num)', 'DanaSyariah::update/$1', ['filter' => 'auth']);
$routes->delete('danasyariah/(:num)', 'DanaSyariah::delete/$1', ['filter' => 'auth']);

$routes->delete('detailtabkonven/(:num)', 'DetailTabKonven::deletegambar/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
