<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends Front
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('m_ujian');
		$this->load->model('m_siswa_ujian');
		$dat_ujian = [];
		$ujian = $this->m_ujian->get_ujian($this->auth()->nisn);
		if($ujian){
			$dat_ujian = $ujian->result_object();
		}
		$this->view('home', compact('dat_ujian'));
	}
}
