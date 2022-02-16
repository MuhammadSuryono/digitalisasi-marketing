 <!-- Begin Page Content -->
 <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input Costing</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
         </div>
         <div class="card-body">
			<form action="<?php echo base_url('costing/input') ?>/<?php echo $req['nomor_rfq'] ?>" method="POST" class="row justify-content-center">
			 <div class="col-xl-4 col-md-6 mb-4">
				 <div class="form-group">
					 <label for="user">Nomor Request</label>
					 <input type="text" value="<?php echo $req['nomor_rfq'] ?>" name="nomor_rfq" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>" readonly>
					 <?php echo form_error('id_project', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 <div class="form-group">
					 <label for="user">Nama Request</label>
					 <input type="text" value="<?php echo $req['nama_project'] ?>" name="id_project" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>" readonly>
					 <?php echo form_error('id_project', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 <div class="form-group">
					 <label for="user">Kode Request</label>
					 <input type="text" value="<?php echo $req['kode_project'] ?>" name="id_project" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>" readonly>
					 <?php echo form_error('id_project', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 
				 <div class="form-group">
					 <label for="user">Group Costing 1</label>
					 <select name="g1" class="selectpicker show-tick form-control <?php if(form_error('g1')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Group Costing 1...">
						 <?php 
							$data = $this->GroupCosting1_model->getAllGroupCosting1();
							foreach ($data as $db) : ?>
						 <?php if (set_value('g1') == $db['g_c1'] ) { ?>
						<option value="<?php echo $db['id_g_c1'] ?>" selected><?php echo $db['g_c1'] ?></option>
						<?php }else{ ?>
						 <option value="<?php echo $db['id_g_c1'] ?>"><?php echo $db['g_c1'] ?></option>
						<?php } ?>
						 <?php endforeach; ?>
					 </select>
						 <?php echo form_error('g1', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
			 </div>
			 <div class="col-xl-5 col-md-6 mb-4">
			 	 <div class="form-group">
					 <label for="user">Group Costing 2</label>
					 <select name="g2" class="selectpicker show-tick form-control <?php if(form_error('g2')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Group Costing 2...">
						 <?php 
							$data = $this->GroupCosting2_model->getAllGroupCosting2();
							foreach ($data as $db) : ?>
						 <?php if (set_value('g2') == $db['g_c2'] ) { ?>
						<option value="<?php echo $db['id_g_c2'] ?>" selected><?php echo $db['g_c2'] ?></option>
						<?php }else{ ?>
						 <option value="<?php echo $db['id_g_c2'] ?>"><?php echo $db['g_c2'] ?></option>
						<?php } ?>
						 <?php endforeach; ?>
					 </select>
						 <?php echo form_error('g2', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 <div class="form-group">
					 <label for="user">Keterangan</label>
					 <input type="text" name="keterangan" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('keterangan'); ?>">
					 <?php echo form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 <div class="form-group">
					 <label for="user">Rp. Satuan</label>
					 <input type="number" name="rpsatuan" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('rpsatuan'); ?>">
					 <?php echo form_error('rpsatuan', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
				 <div class="form-group">
					 <label for="user">Jumlah</label>
					 <input type="number" name="jumlah" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('jumlah'); ?>">
					 <?php echo form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
				 </div>
			 </div>
			 <div class="col-xl-9 col-md-6 mb-4">
				 <div class="form-group">
					<button class="btn btn-primary btn-block" type="submit">Add</button>
				 </div>
			 </div>
			</form>
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Group Costing 1 </th>
                             <th>Group Costing 2</th>
                             <th>Keterangan</th>
                             <th>Rp. Satuan</th>
                             <th>Jumlah</th>
                             <th>Total</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                           foreach ($costing as $db) : 
						   $total[] = $db['rpsatuan']* $db['jumlah'];
						   $id = $db['id_costing'];
						   ?>
                         <tr>
							<td><?php echo $no ?></td>
							<td><?php echo $db['g_c1'] ?></td>
							<td><?php echo $db['g_c2'] ?></td>
							<td><?php echo $db['ket'] ?></td>
							<td><?php echo number_format($db['rpsatuan']) ?></td>
							<td><?php echo $db['jumlah'] ?></td>
							<td><?php echo number_format($db['rpsatuan'] * $db['jumlah']) ?></td>
							<td>
								<a href="<?php base_url() ?>../hapus/<?php echo $db['id_costing']; ?>/<?php echo $db['id_project']; ?>" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
								<a href="javascript:;" data-toggle="modal" data-target="#edit-costing" data-id="<?php echo $id; ?>" data-gb1="<?php echo $db['g_c1'] ?>" data-gb2="<?php echo $db['g_c1'] ?>" data-ket="<?php echo $db['ket'] ?>" data-st="<?php echo $db['rpsatuan'] ?>" data-jml="<?php echo $db['jumlah'] ?>"  class="btn btn-success btn-sm">Edit</a>
							</td>
                         </tr>
                         <?php
                            $no++;
                        endforeach;
                        ?>
                     </tbody>
						<tr>
							<th colspan="6">Total</th>
							<th colspan="2"><?php if(isset($total)) { echo number_format(array_sum($total)); }?></th>
						<tr>
                 </table>
				<a href="<?php echo base_url('rfq') ?>" class="btn btn-primary">Kembali</a>
         </div>
     </div>

 
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content --> 
 
  <div class="modal fade" id="edit-costing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Costing</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('costing/ubah') ?>/<?php echo $project['id_project'] ?> ">						
                     <div class="form-group">
						 <label>GroupCosting</label>
						 <input type="hidden" name="id" id="id">
						 <select id="gb1" name="g1" class="selectpicker show-tick form-control <?php if(form_error('g1')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Group Costing 1...">
							 <?php 
								$data = $this->GroupCosting1_model->getAllGroupCosting1();
								foreach ($data as $db) : ?>
							 <?php if (set_value('g1') == $db['g_c1'] ) { ?>
							<option value="<?php echo $db['id_g_c1'] ?>" selected><?php echo $db['g_c1'] ?></option>
							<?php }else{ ?>
							 <option value="<?php echo $db['id_g_c1'] ?>"><?php echo $db['g_c1'] ?></option>
							<?php } ?>
							 <?php endforeach; ?>
						 </select>
                     </div>
					 <div class="form-group">
						 <label for="user">Group Costing 2</label>
						 <select id="gb2" name="g2" class="selectpicker show-tick form-control <?php if(form_error('g2')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Group Costing 2...">
							 <?php 
								$data = $this->GroupCosting2_model->getAllGroupCosting2();
								foreach ($data as $db) : ?>
							 <?php if (set_value('g2') == $db['g_c2'] ) { ?>
							<option value="<?php echo $db['id_g_c2'] ?>" selected><?php echo $db['g_c2'] ?></option>
							<?php }else{ ?>
							 <option value="<?php echo $db['id_g_c2'] ?>"><?php echo $db['g_c2'] ?></option>
							<?php } ?>
							 <?php endforeach; ?>
						 </select>
							 <?php echo form_error('g2', '<small class="text-danger pl-3">', '</small>'); ?>
					 </div>
					 <div class="form-group">
						<label>Keterangan</label>
						<input type="text" id="ket" name="keterangan" class="form-control">
					 </div>
					 <div class="form-group">
						<label>Rp.Satuan</label>
						<input type="text" id="st" name="rpsatuan" class="form-control">
					 </div>
					 <div class="form-group">
						<label>Jumlah</label>
						<input type="text" id="jml" name="jumlah" class="form-control">
					 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button>
             </div>
             </form>
         </div>
     </div>
 </div> 
