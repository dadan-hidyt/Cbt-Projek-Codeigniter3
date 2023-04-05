<div class="container">
    <div class="col-md-5 mx-auto mt-5">
        <div class="cbt-auth-card shadow-sm rounded">
            <div class="cbt-auth-card-header">
                <div class="cbt-auth-logo">
                    <h4>LOGIN CBT MI 2 SUMEDANG</h4>
                    <h4>2023</h4>
                </div>
            </div>
            <div class="cbt-auth-card-content">
                <form id="form-login" method="POST" action="">
                    <div class="form-group">
                        <label for="" class="form-label">NO PESERTA</label>
                        <input type="text" name="np" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">PASSWORD</label>
                        <input type="text" name="pw" class="form-control">
                    </div>
                    <div class="form-group">
                        <button id="btn_login" name="btn-login" class="btn btn-block btn-primary">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    (function() {
        $(document).ready(async function() {
            const form_login = $('#form-login');
            form_login.on('submit', (dat) => {
                dat.preventDefault();
                const data = new FormData(dat.target)
                $('#btn_login').html('Loading...');
                $('#btn_login').addClass('disabled')

                axios.post(`${base_url}auth/cek`, data).then((e) => {
                    if (e.data.status === false) {
                        Toastify({
                            text: `${e.data.message}`,
                            close: true,
                            style: {
                                background: 'red'
                            }
                        }).showToast();
                    } else if (e.data.status === true) {
                        Toastify({
                            text: `${e.data.message}`,
                            position : 'left',
                            style: {
                                background: 'green'
                            }
                           
                        }).showToast();
                        setTimeout(function(){
                            window.location.replace(base_url+'home');
                        },4000);
                    }
                    $('#btn_login').html('Login');
                    $('#btn_login').removeClass('disabled')

                }).catch(function(e) {
                    Toastify({
                        text: `Error :${e.message}`,
                        close: true,
                        style: {
                            background: 'red'
                        }
                    }).showToast();
                    $('#btn_login').html('Login');
                    $('#btn_login').removeClass('disabled')
                });

            })
        });
    })();
</script>