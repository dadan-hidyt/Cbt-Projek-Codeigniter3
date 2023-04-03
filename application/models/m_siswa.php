<?php
class m_siswa extends CI_Model
{
    private $table = 'tb_siswa';
    private $fk = 'nisn';

    public function get_by_nisn(?string $no_peserta)
    {
        $this->db->select("*");
        $this->db->where("nisn", $no_peserta);
        return $this->db->get($this->table);
    }
    //membuat session
    public function buat_session($nisn)
    {
        $expire_token = time() + (60 * 60 * 24); //1 hari
        $data = [
            'token' => bin2hex(random_bytes(32)),
            'expire' => $expire_token,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'browser' => $this->agent->browser() . " " . $this->agent->version(),
            'os' => $this->agent->platform(),
            'nisn' => $nisn,
            'create_at' => time(),
        ];
        if ($this->db->insert('tb_sessions', $data)) {
            set_cookie('cbtcookies', $data['token'], $expire_token, '', '/', '', null, true);
            return true;
        }
        return false;
    }
    public function cek_token_login(?string $token) : CI_DB_mysqli_result{
        $this->db->select("*");
        $this->db->where("token", $token);
        return $this->db->get('tb_sessions');
    }
}
