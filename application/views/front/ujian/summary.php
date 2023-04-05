<?php $this->load->view('front/_part/header.php') ?>
<div class="container-fluid">
    <div class="cbt-content">
        <div class="card shadow rounded">
            <div class="back">
                <a href="" class="btn m-3 btn-danger">Home</a>
            </div>
            <div class="card-body">
                <h3>Ringkasan Hasil Ujian Anda</h3>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>Nama Ujian</th>
                            <td>:</td>
                            <td><?= $result->nama_ujian ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Nama Mapel</th>
                            <td>:</td>
                            <td><?= $result->nama_mapel ?? '' ?></td>
                        </tr>
                        <tr>
                            <th>Guru Mata Pelajaran </th>
                            <td>:</td>

                            <td><b><?= ucwords($result->guru_mapel) ?></b></td>
                        </tr>
                        <tr>
                            <th>Jumlah Soal PG: </th>
                            <td>:</td>

                            <td><?= $result->jmlh_pg == 0 ?   'tidak ada' : $result->jmlh_pg . " Butir"; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Soal Essay: </th>
                            <td>:</td>

                            <td><?= $result->jmlh_essay == 0 ?   'tidak ada' : $result->jmlh_essay . " Butir"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h2>Hasil Ujian</h2>
                            </td>
                        </tr>
                        <tr>
                            <th>Sisa Waktu</th>
                            <td>:</td>
                            <td><?= $result->sisa_waktu ?></td>
                        </tr>
                        <tr>
                            <th>Soal Kosong</th>
                            <td>:</td>
                            <td> <?php if ($result->lihat_nilai) : ?>
                                    <?= $result->kosong ?> Soal
                                    <?php if ($result->detail_kosong) : ?>
                                        - [<?= $result->detail_kosong; ?>]
                                    <?php endif; ?>
                                <?php else : ?>
                                    <i>Tidak di perlihatkan</i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Benar</th>
                            <td>:</td>
                            <td>
                                <?php if ($result->lihat_nilai) : ?>
                                    <?= $result->benar ?> Soal
                                    <?php if ($result->detail_benar) : ?>
                                        - [<?= $result->detail_benar; ?>]
                                    <?php endif; ?>
                                <?php else : ?>
                                    <i>Tidak di perlihatkan</i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Salah</th>
                            <td>:</td>
                            <td>
                                <?php if ($result->lihat_nilai) : ?>
                                    <?= $result->salah ?> Soal
                                    <?php if ($result->detail_salah) : ?>
                                        - [<?= $result->detail_salah; ?>]
                                    <?php endif; ?>
                                <?php else : ?>
                                    <i>Tidak di perlihatkan</i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai</th>
                            <td>:</td>
                            <td><?php if ($result->lihat_nilai) : ?>
                                    <?= $result->poin ?>
                                <?php else : ?>
                                    <i>Tidak di perlihatkan</i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= site_url("home") ?>" class="btn btn-primary float-right d-inline">LANJUTKAN</a>
            </div>
        </div>
    </div>
</div>