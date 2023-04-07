<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<a href="" class="btn btn-primary">Back</a>
			</div>
			<div class="card-body">
				<form action="">
					<div class="row">
						<div class="col-6">
							<label for="nisn">NISN (No Induk Siswa Nasional)</label>
							<input type="text" placeholder="Ketikan nisn" name="nisn" class="form-control" id="nisn">
						</div>
						<div class="col-6">
							<label for="nis">NIS (No Induk Siswa)</label>
							<input type="text" class="form-control" placeholder="Ketikan NIS" id="nis">
						</div>
					</div>

					<div class="form-group mt-3">
						<label for="nama">Nama Siswa</label>
						<input type="text" id="nama" placeholder="Ketikan nama siswa" class="form-control">
					</div>
					
					<div class="form-group mt-3">
						<label for="kelas">kelas</label>
						<select id="select-kelas" name="" id="kelas" name='id_kelas' class="form-control">
							<option value="">XII-RPL-10</option>
						</select>
					</div>

					<div class="form-group mt-3">
						<label for="Alamat">Alamat</label>
						<textarea name="alamat" id="Alamat" cols="30" rows="4" class="form-control"></textarea>
					</div>

					<div class="form-group mt-3">
						<label for="NoHp">No HP</label>
						<input type="tel" id="NoHp" name="NoHp" placeholder="Ketikan nomor HP/Telpon" class="form-control">
					</div>
					<div class="form-group mt-3">
						<label for="email">Email</label>
						<input type="email" class="form-control" placeholder="Ketikan alamat email" id="email">
					</div>
					<div class="form-group mt-3">
						<label for="password">Password</label>
						<input type="tel" class="form-control" placeholder="ketikan password untuk siswa!">
					</div>
					<div class="form-group mt-4">
						<button class="btn btn-primary">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	window.onload = async () => {
		$('#select-kelas').select2({})
	}
</script>