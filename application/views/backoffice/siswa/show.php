<div class="container-fluid">
	<h4>Manage Siswa</h4>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="action border p-3 rounded">
						<a href="<?= site_url('backoffice/master/siswa/buat') ?>" id="tambah_siswa" class="btn btn-primary btn-sm">TAMBAH</a>
					</div>
				</div>
				<div class="card-body">
					<p class="alert alert-info">Data berhasil di tambahakn!</p>
					<table id="datatable" class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>NISN</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Alamat</th>
								<th>No Hp</th>
								<th>Email</th>
								<th>ACT</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($siswa)): ?>
								<?php $i = 0; ?>
								<?php foreach ($siswa as $row): $i++; ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $row->nisn ?></td>
										<td><?= $row->nis ?></td>
										<td><?= $row->nis ?></td>
										<td><?= $row->nama_kelas ?></td>
										<?php if (!empty($row->alamat)): ?>
											<td><?= $row->alamat ?></td>
										<?php else: ?>
											<td><i>Tidak di set</i></td>
										<?php endif ?>
										<?php if (!empty($row->no_hp)): ?>
											<td><?= $row->no_hp ?></td>
										<?php else: ?>
											<td><i>Tidak di set</i></td>
										<?php endif ?>
										<?php if (!empty($row->email)): ?>
											<td><?= $row->email ?></td>
										<?php else: ?>
											<td><i>Tidak di set</i></td>
										<?php endif ?>
										<td>
											<a title="Edit data"  href=""><i class="ti ti-edit-circle"></i></a>
											<a title="Hapus data"  href=""><i class="ti ti-trash"></i></a>
											<a title="Cetak kartu ujian"  href=""><i class="ti ti-credit-card"></i></a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal tambah -->


<!-- modal tambah -->
<script>
	window.onload = function(){
		$('#datatable').DataTable({
			responsive : true,
		});


		$('#tambah_siswa').on('click',async () => {
			$('#modal-tambah-siswa').modal('show');
		});
	}
</script>