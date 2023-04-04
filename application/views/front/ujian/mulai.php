<?php $this->load->view('front/_part/header.php') ?>
<div class="container-fluid">
    <div class="cbt-content">
        <div class="card shadow rounded">
            <div class="card-header">
                <div class="row g-3 d-flex align-items-center">
                    <div class="col-md-8">
                        <div class="waktu-ujian">
                            <span>Sisa Waktu: <?= $data['sisa_waktu'] / 60 ?> Menit</span>&nbsp;<span class="badge text-lg badge-success" id="_ping">Mengecek koneksi...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="h3">
                    <?php if ($data['jawaban_sekarang']) : ?>
                        <span id="no_soal" class="text-success" style="text-shadow:0px 0px 2px"> Soal No: <?= $data['soal']->no_soal; ?></span>
                    <?php else : ?>
                        <span id="no_soal" class="" style="text-shadow:0px 0px 2px"> Soal No: <?= $data['soal']->no_soal; ?></span>
                    <?php endif ?>
                </div>
                <div class="soal">
                    <div class="pertanyaan">
                        <p>
                            <?= $data['soal']->pertanyaan; ?>
                        </p>
                    </div>
                    <div class="pilihan">
                        <div action="">
                            <div class="pilihan_group">
                                <input <?= $data['jawaban_sekarang'] === "A" ? 'checked' : '' ?> class="pilihan_item" data-abc="A" type="radio" name="pilihan" id="pilihan" data-soal="<?= $data['soal']->id_soal ?>" value="A">
                                <label class="pilihan_item_label" for=""><?= $data['soal']->a ?></label>
                            </div>
                            <div class="pilihan_group">
                                <input <?= $data['jawaban_sekarang'] === "B" ? 'checked' : '' ?> class="pilihan_item" data-abc="B" type="radio" name="pilihan" id="pilihan" data-soal="<?= $data['soal']->id_soal ?>" value="B">
                                <label class="pilihan_item_label" for=""><?= $data['soal']->a ?></label>
                            </div>
                            <div class="pilihan_group">
                                <input <?= $data['jawaban_sekarang'] === "C" ? 'checked' : '' ?> class="pilihan_item" data-abc="C" type="radio" name="pilihan" id="pilihan" data-soal="<?= $data['soal']->id_soal ?>" value="C">
                                <label class="pilihan_item_label" for=""><?= $data['soal']->a ?></label>
                            </div>
                            <div class="pilihan_group">
                                <input <?= $data['jawaban_sekarang'] === "D" ? 'checked' : '' ?> class="pilihan_item" data-abc="D" type="radio" name="pilihan" id="pilihan" data-soal="<?= $data['soal']->id_soal ?>" value="D">
                                <label class="pilihan_item_label" for=""><?= $data['soal']->d ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?php if ($data['current'] !== $data['min']) : ?>
                    <a href="<?= site_url("ujian/{$data['id_ujian']}/{$data['id_mapel']}/{$data['back']}.html") ?>" class="btn btn-primary">Back</a>
                <?php endif; ?>
                <?php if ($data['current'] == $data['max']) : ?>
                    <a href="" class="btn btn-primary -right">SELESAI</a>
                <?php else : ?>
                    <a href="<?= site_url("ujian/{$data['id_ujian']}/{$data['id_mapel']}/{$data['next']}.html") ?>" class="btn btn-primary ">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($data['soal']->type == 1) : ?>
    <script>
        function simpanJawaban(param) {
            let data = new FormData();
            data.append('jawaban_sekarang', param.pilihan);
            data.append('id_soal', param.soal);
            data.append('id_ujian', `<?= $data['id_ujian'] ?>`);
            data.append('id_mapel', `<?= $data['id_mapel'] ?>`);
            data.append('type', "PG");

            axios.post(`<?= site_url('ujian/simpan') ?>/ujian/simpan`, data).then(function(dat) {
                if (dat.data === 'Y') {
                    document.getElementById('no_soal').style.color = 'green';
                    $.toast({
                        title: 'Suksess',
                        subtitle: 'Sekarang',
                        content: 'Jawaban anda berhasil di simpan.',
                        type: 'success',
                        delay: 3000
                    });
                } else {
                    $.toast({
                        title: 'Gagal',
                        subtitle: 'Sekarang',
                        content: 'Jawaban anda gagal di simpan.',
                        type: 'error',
                        delay: 3000
                    });
                }
            }).catch(function(e) {

            });

        }
        $(document).ready(function() {
            const pilihan = document.querySelectorAll('#pilihan');
            pilihan.forEach(function(elem, key) {
                elem.addEventListener('change', function(e) {
                    const pilihan = e.target.dataset.abc;
                    const soal = e.target.dataset.soal;
                    try {
                        simpanJawaban({
                            soal: soal,
                            pilihan: pilihan,
                        })
                    } catch (error) {
                        console.log(error);
                    };

                });
            })
        })
    </script>
<?php endif; ?>