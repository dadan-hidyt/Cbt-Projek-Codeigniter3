<script>
    $(document).ready(function() {
        window.setInterval(() => {
            cekPing();
        }, 5000);
    })
    // fungsi untu mengecek koneksi
    function cekPing() {
        const ping = new Ping();
        ping.ping(base_url + '', (err, e) => {
            let ping_element = $('#_ping');
            let indikator = $('#indikator_wifi');
            ping_element.html('Sedang mengecek koneksi...');
            if (e <= 40) {
                ping_element.html(`(${e}) <sup>Sangat Baik</sup>`);
                ping_element.css('color', 'green')
                if (indikator) {
                    indikator.attr('stroke', 'green')
                }
            } else if (e <= 80) {
                ping_element.html(`(${e}) <sup>Baik</sup>`)
                ping_element.css('color', 'blue');
                if (indikator) {
                    indikator.attr('stroke', 'blue')
                }
            } else if (e => 120) {
                ping_element.html(`(${e}) <sup>Buruk</sup>`)
                ping_element.css('color', 'red')
                if (indikator) {
                    indikator.attr('stroke', 'red')
                }
            } else if (e > 120) {
                ping_element.html(`(${e}) <sup>Buruk</sup>`)
                ping_element.css('color', 'red')
                if (indikator) {
                    indikator.attr('stroke', 'red')
                }
            }
        }).catch(() => true);
    }
</script>
</body>

</html>