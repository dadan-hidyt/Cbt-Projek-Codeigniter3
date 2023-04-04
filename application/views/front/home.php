<!-- home -->
<?php $this->load->view('front/_part/header.php') ?>
<!-- Homepage -->
<div class="container-fluid">
    <div class="cbt-content shadow rounded border">
        <div class="p-3">
            <h4>LIST UJIAN</h4>
        </div>
        <?php if ($this->session->flashdata('msg')) : ?>
            <p class="alert alert-danger"><?= $this->session->flashdata('msg') ?></p>
        <?php endif; ?>
        <div class="list-ujian">
            <div class="table-responsive">
                <table class="test-table table-bordered text-center font-bold  table">
                    <thead>
                        <tr>
                            <th>Nama Ujian</th>
                            <th>Waktu</th>
                            <th>jmlh Soal</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dat_ujian)) : ?>
                            <?php foreach ($dat_ujian as $row) : ?>
                                <tr>
                                    <td><?= $row->nama_ujian ?></td>
                                    <td><?= $row->total_waktu ?></td>
                                    <?php if ($row->jmlh_pg != 0 && $row->jmlh_essay != 0) : ?>
                                        <td><?= $row->jmlh_pg ?> | <?= $row->jmlh_essay ?></td>
                                    <?php elseif ($row->jmlh_pg != 0) : ?>
                                        <td><?= $row->jmlh_pg ?></td>
                                    <?php elseif ($row->jmlh_essay != 0) : ?>
                                        <td><?= $row->jmlh_essay ?></td>
                                    <?php endif ?>
                                    <td>
                                        <a href="<?= site_url("ujian/{$row->id_ujian}/confirm") ?>" class="btn btn-info btn-sm" href="">MULAI</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan='4'>Tidak ada ujian...</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>