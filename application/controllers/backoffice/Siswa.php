<?php

class Siswa extends Backoffice{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_siswa');
	}
	public function index(){
		$this->setTitle('Manage Siswa');
		$siswa = [];
		if($fetch = $this->m_siswa->all()){
			$siswa = $fetch->result_object();
		}
		return $this->view('siswa/show',compact('siswa'));
	}
}