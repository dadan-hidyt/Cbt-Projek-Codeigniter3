<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Home/index';
$route['auth/cek'] = 'Auth/cek_login';

$route['home'] = 'Siswa';