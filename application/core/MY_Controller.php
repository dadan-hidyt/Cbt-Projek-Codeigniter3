<?php

interface ControllerInterface
{
    public function setTitle(?string $title = null);
    public function view(?string $view, array $data = []);
}

trait ControllerTrait
{

    public function responseJson(array $data): string
    {

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}

class Backoffice extends CI_Controller implements ControllerInterface
{
    public function __construct()
    {
        parent::__construct();
    }
    public function setTitle(?string $title = null)
    {
    }

    public function view(?string $view, array $data = [])
    {
    }
}

class Front extends CI_Controller implements ControllerInterface
{
    private $data = [];
    public $view_path = "front";
    public $auth;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_siswa');
        if (empty($this->auth)) {
            $this->auth();
        }
    }
    public function auth()
    {
        if ($nisn = $this->cek_login()) {
            $baris = $this->m_siswa->get_by_nisn($nisn);
            if ($baris->num_rows() > 0) {
                $this->data = array_merge($this->data, [
                    'auth' => $baris->row(),
                ]);
            }
        }
        return $this->data['auth'];
    }
    public function view(?string $view, array $data = [])
    {
        $data = array_merge($this->data, $data);
        $this->load->view($this->view_path . '/_part/base_head.php', $data);
        $this->load->view($this->view_path . '/' . $view . '.php', $data);
        $this->load->view($this->view_path . '/_part/base_foot.php', $data);
    }
    public function cek_login()
    {
        if (isset($_COOKIE['cbtcookies']) && !empty($_COOKIE['cbtcookies'])) {
            //cek token
            $token = $_COOKIE['cbtcookies'];
            $cek = $this->m_siswa->cek_token_login($token);
            $session = $cek->row();
            if ($cek->num_rows() === 1) {
                if ($session->expire >= time()) {
                    return $session->nisn;
                }
            }
        }
        return false;
    }
    public function setTitle(?string $title = null)
    {
        $this->data['title'] = $title;
    }
}
