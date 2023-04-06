<?php
class Login extends Backoffice{
    public function index()
    {
        $this->view('dashboard');
        // $this->load->view($this->view_path.'/login');
    }
    public function login_db(){
        
    }
}