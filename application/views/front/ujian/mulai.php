<?php $this->load->view('front/_part/header.php') ?>
<div class="container-fluid">
    <div class="cbt-content">
        <div class="card shadow rounded">
            <div class="card-header">
                <div class="row g-3 d-flex align-items-center">
                    <div class="col-md-8">
                        <div class="waktu-ujian"><i data-feather="wifi"></i>
                            <span class="text-info">Sisa Waktu: <span id="waktu_ujian"></span></span> &nbsp - &nbsp; 
                            <svg id="indikator_wifi" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dedede" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-wifi">
                                <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                                <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                                <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                                <line x1="12" y1="20" x2="12.01" y2="20"></line>
                            </svg> <span class="text-lg text-success" id="_ping"></span>
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
                    <button class="btn btn-primary" id="button_selesai">Selesai</button>
                <?php else : ?>
                    <a href="<?= site_url("ujian/{$data['id_ujian']}/{$data['id_mapel']}/{$data['next']}.html") ?>" class="btn btn-primary ">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {

        //countdown waktu ujian
        dcountdown('<?= date("M d, Y H:i:s", $data['waktu_akhir']); ?>', 'waktu_ujian', function(e) {
            if (e == true) {
                $.toast({
                    title: 'Suksess',
                    subtitle: 'Sekarang',
                    content: "Waktu Ujian telah habis!",
                    type: 'info',
                    delay: 2000
                });
                //selesaikan
                selesaikan();
            }
        }, function(hour, minute, second) {
            if (minute === 20 && second == 59) {
                $.toast({
                    title: 'Suksess',
                    subtitle: 'Sekarang',
                    content: `Waktu anda ${minute} : ${second} lagi! buruan kerjakan soal anda!`,
                    type: 'info',
                    delay: 6000
                });
            } else if (minute === 5 && second == 59) {
                $.toast({
                    title: 'Suksess',
                    subtitle: 'Sekarang',
                    content: `Waktu anda ${minute} : ${second} lagi! buruan kerjakan soal anda!`,
                    type: 'info',
                    delay: 6000
                });
            }
        });

        $('#button_selesai').on('click', function(e) {
            let sisa_waktu = $('#waktu_ujian').text();
            if (confirm('Apakah anda yakin ingin menyelesaikan ujian? Sisa waktu anda \n' + sisa_waktu)) {
                selesaikan();
            }
        })

    }
    //fungsi selesai ujian
    function selesaikan() {
        const data = new FormData();
        let sisa_waktu = $('#waktu_ujian').text();
        data.append('sisa_waktu', sisa_waktu);
        data.append('id_data_siswa_ujian', '<?= $data['id_data_siswa_ujian'] ?>');
        axios.post(window.base_url + 'selesai_ujian', data).then(function(e) {
            if (e.data.status === true) {
                $.toast({
                    title: 'Suksess',
                    subtitle: 'Sekarang',
                    content: `${e.data.msg}! Tunggu 3 detik untuk halaman akan otomatis ke halaman lain!`,
                    type: 'success',
                    delay: 3000
                });
                setTimeout(() => {
                    window.location.replace(`${window.base_url}selesai_ujian/summary/<?= $data['id_data_siswa_ujian'] ?>`);
                }, 3000);
            } else {
                $.toast({
                    title: 'Gagal',
                    subtitle: 'Sekarang',
                    content: `${e.data.msg}`,
                    type: 'error',
                    delay: 3000
                });
            }
        });
    }
</script>
<?php if ($data['soal']->type == 1) : ?>
    <script>
        //simpan jawaban
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
        //proses simpan jawaban
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
                        alert("Kesalahan saat menyimpan jawaban!")
                    };

                });
            });
        });
    </script>
<?php endif; ?>