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
            ping_element.html('Sedang mengecek koneksi...');
            if (e <= 40) {
                ping_element.html(`Koneksi sangat baik (${e})`);
                ping_element.css('color', 'green')
            } else if (e <= 80) {
                ping_element.html(`Koneksi baik (${e})`)
                ping_element.css('color', 'green')
            } else if (e => 120) {
                ping_element.html(`Koneksi buruk (${e})`)
                ping_element.css('color', 'red')
            } else if (e > 120) {
                ping_element.html(`Koneksi sagat buruk (${e})`)
                ping_element.css('color', 'red')
            }
        }).catch(() => true);
    }
</script>
</body>

</html>