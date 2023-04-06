<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Home/index';
$route['auth/cek'] = 'Auth/cek_login';

$route['home'] = 'Siswa';
$route['ujian/(:num)/(:num)/(:num).html'] = "Ujian/mulai/$1/$2/$3";
$route['ujian/(:num)/confirm'] = 'Ujian/confirm/$1';

$route['waktu_server'] = "Ujian/waktu_server";
$route['selesai_ujian'] = "Ujian/selesai";
$route['selesai_ujian/summary/(:num)'] = "Ujian/summary/$1";

/**
 * route for backofice
 */

$route['backoffice/login'] = "backoffice/Login";
$route['backoffice'] = "backoffice/Login";
$route['backoffice/master/siswa'] = 'backoffice/Siswa/index';