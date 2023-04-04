<?php $this->load->view('front/_part/header.php') ?>
<div class="container-fluid">
    <div class="cbt-content">
        <div class="card shadow rounded">
            <div class="back">
                <a href="" class="btn m-3 btn-danger">Back</a>
            </div>
            <div class="card-body">
                <table class='table'>
                    <tbody>
                        <tr>
                            <td>Nama Mapel</td>
                            <td>:</td>
                            <td><?= $det_ujian->nama_mapel ?? '' ?></td>
                        </tr>
                        <tr>
                            <td>Guru Mata Pelajaran </td>
                            <td>:</td>

                            <td><b><?= ucwords($det_ujian->guru_mapel) ?></b></td>
                        </tr>
                        <tr>
                            <td>Jumlah Soal PG: </td>
                            <td>:</td>

                            <td><?= $det_ujian->jmlh_pg == 0 ?   'tidak ada' : $det_ujian->jmlh_pg . " Butir"; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Soal Essay: </td>
                            <td>:</td>

                            <td><?= $det_ujian->jmlh_essay == 0 ?   'tidak ada' : $det_ujian->jmlh_essay . " Butir"; ?></td>
                        </tr>
                        <tr>
                            <td>Waktu Pengerjaan </td>
                            <td>:</td>
                            <td><?= $det_ujian->total_waktu ?> Menit</td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= site_url("ujian/{$det_ujian->id_ujian}/{$det_ujian->id_mapel}/1.html") ?>" class="btn btn-primary float-right d-inline">LANJUTKAN</a>
            </div>
        </div>
    </div>
</div>