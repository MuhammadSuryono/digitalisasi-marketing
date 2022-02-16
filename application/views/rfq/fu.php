 <!-- Begin Page Content -->
 <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
 <div class="container-fluid">

 	<!-- Page Heading -->
 	<h1 class="h3 mb-4 text-gray-800">Form FU Request</h1>
 	<!-- DataTales Example -->
 	<div class="card shadow mb-4">
 		<div class="card-header py-3">
 			<h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
 		</div>

 		<div class="card-body">
 			<a href="<?php echo base_url('rfq') ?>" class="btn btn-info mb-4">Kembali</a>
 			<table class="table table-bordered" cellspacing="0">
 				<tr>
 					<td width="200"><b>Nomor Request</b></td>
 					<td colspan="3"><?php echo $rfq['nomor_rfq'] ?></td>
 				</tr>
 				<tr>
 					<td><b>Nama Request</b></td>
 					<td width="400"><?php echo $rfq['nama_project'] ?></td>
 					<td width="150"><b>Kode Request</b></td>
 					<td><?php echo $rfq['kode_project'] ?></td>
 				</tr>
 			</table>
 			<form action="" method="POST" class="row justify-content-center" enctype="multipart/form-data">
 				<div class="col-xl-9 col-md-6 mb-4">
 					<div class="form-group row">
 						<div class="col-sm-4 mb-3 mb-sm-0">
 							<label for="user">Next FU Plan</label>
 							<input type="hidden" value="<?php echo $rfq['nomor_rfq'] ?>" name="nomor_rfq">
 							<input type="datetime-local" name="date" class="form-control form-control-user <?php if (form_error('date')) {
																												echo 'is-invalid';
																											} ?>" id="exampleInputEmail" value="<?php echo set_value('date'); ?>">
 							<?php echo form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
 						</div>
 						<div class="col-sm">
 							<label>-</label>
 							<input type="text" name="ket" class="form-control form-control-user <?php if (form_error('ket')) {
																										echo 'is-invalid';
																									} ?>" id="exampleInputEmail" value="<?php echo set_value('ket'); ?>">
 							<?php echo form_error('ket', '<small class="text-danger pl-3">', '</small>'); ?>
 						</div>
 					</div>
 					<div class="form-group">
 						<button class="btn btn-primary btn-block" type="submit">Add to schedule</button>
 					</div>
 				</div>
 			</form>
 			<div class="row justify-content-center">
 				<div class="col-xl-9 col-md-6 mb-4">
 					<table class="table" width="100%" cellspacing="0">
 						<thead>
 							<tr>
 								<th>Tanggal</th>
 								<th>Schedule</th>
 								<th></th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php foreach ($fu as $db) { ?>
 								<tr>
 									<td><?php echo $db['date'] ?></td>
 									<td><?php echo $db['ket'] ?></td>
 									<td>
 										<a href="<?php echo base_url('rfq/hapusFu') ?>/<?php echo $db['id_fu'] ?>/<?php echo $db['nomor_rfq'] ?>" class="btn btn-danger btn-sm tombol-hapus">Delete</a>
 									</td>
 								</tr>
 							<?php } ?>
 						</tbody>
 					</table>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>
 <!-- /.container-fluid -->