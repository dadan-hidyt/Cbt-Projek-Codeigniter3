<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front {

	public function index()
	{
		//jika sudah login
		$view_name = 'login';
		if($this->cek_login() !== false){
			$view_name = 'sudah_login';
		}
		$ujian = [];
		
		


		$this->setTitle('Login');
		$bodyClass = "bg-autenticate";
		return $this->view($view_name,compact('bodyClass'));
	}
}
