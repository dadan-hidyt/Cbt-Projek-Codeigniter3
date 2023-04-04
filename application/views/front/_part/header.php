<!-- header -->
<div class="bg-autenticate bg-cbt p-4 text-white cbt-siswa-header">
<div class="row no-gutters">
            <div class="col-md-8 col-sm-8 col-6">
                <img src="https://unbk.smppgrisatubdl.com/assets/CBT/Assets/Images/logo.png" id="img-logo">
            </div>
            <div class="col-md-4 col-sm-4 col-6">
                <div class="user-header-info">
                    <div class="d-inline float-right user-header-thumb" id="img-account">
                        <div class="user-thumb-wrapper"><img src="https://unbk.smppgrisatubdl.com/assets/CBT/Assets/Images/no-image.png"></div>
                    </div>
                    <div class="d-inline float-right">
                        <div class="user-header-wrapper">
                            <div>
                                <b class='nama_siswa'><?= $auth->nama ?? 'Tidak diketahui' ?> | <?= $auth->nisn ?? 'Tidak diketahui' ?></b>
                            </div>
							<a href="https://unbk.smppgrisatubdl.com/logout" class="btn btn-sm btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
            </div>			
        </div>
</div>
<!-- e:header -->