 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Download Bank Proposal</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Form Download</h6>
         </div>

         <div class="card-body">
            <form action="" enctype="multipart/form-data" method="POST" class="row justify-content-center">
                 <div class="col-lg-5">
                     
					 <div class="form-group">
                         <label for="user"><input type="hidden" name="input1" >Nomor Request</label>
                         <select name="rfq" class="selectpicker show-tick form-control <?php if(form_error('rfq')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Request...">
							<?php 
                                $data = $this->Rfq_model->getAllRfq();
                                foreach ($data as $db) : ?>
							<?php if (set_value('rfq') == $db['nomor_rfq'] ) { ?>
							<option value="<?php echo $db['nomor_rfq'] ?>" selected><?php echo $db['nomor_rfq'] ?> - <?php echo $db['nama_project'] ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db['nomor_rfq'] ?>"><?php echo $db['nomor_rfq'] ?> - <?php echo $db['nama_project'] ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						  <?php echo form_error('rfq', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
					 <div class="form-group">
                         <label for="user"><input type="hidden" name="input2" > Methodology</label>
                         <select name="methodology" class="selectpicker show-tick form-control <?php if(form_error('methodology')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih methodology...">
                             <?php 
                                $data = $this->Methodology_model->getAllMethodology();
                                foreach ($data as $db) : ?>
							<?php if (set_value('methodology') == $db['id_methodology'] ) { ?>
							<option value="<?php echo $db['id_methodology'] ?>" selected><?php echo $db['methodology'] ?> - <?php echo $db['keterangan'] ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db['id_methodology'] ?>"><?php echo $db['methodology'] ?> - <?php echo $db['keterangan'] ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						  <?php echo form_error('methodology', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
					 <div class="form-group">
                         <label for="user"><input type="hidden" name="input3" > Bidang Usaha</label>
                         <select name="usaha" class="selectpicker show-tick form-control <?php if(form_error('usaha')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih usaha...">
                             <?php 
                                $data = $this->Usaha_model->getAllUsaha();
                                foreach ($data as $db) : ?>
							<?php if (set_value('usaha') == $db['id_usaha'] ) { ?>
							<option value="<?php echo $db['id_usaha'] ?>" selected><?php echo $db['bidang'] ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db['id_usaha'] ?>"><?php echo $db['bidang'] ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						  <?php echo form_error('usaha', '<small class="text-danger pl-3">', '</small>'); ?>
					 </div>
					 <div class="form-group">
						 <button class="btn btn-primary btn-block" name="show" type="submit">Show</button>
			
					 </div>
				 </div>
             </form>
			 <div class="row justify-content-center" >
				<div class="col-lg-4">
					 <table class="table "  width="100%" cellspacing="0">
							 <thead>
								 <tr>
									 <th>No</th>
									 <th>Nama File</th>
									 <th></th>
								 </tr>
							 </thead>
							 <tbody>
							 <?php
							 if(isset($_POST['show'])){
								$no=1;
								foreach($hasil as $db):
							?>
								<tr>
									<td><?php echo $no ?></td>
									<td><a target="_blank" href="<?php echo base_url(); ?>/file/proposal/<?php echo $db['file'] ?>"><?php echo $db['file'] ?></a></td>
									<td></td>
								</tr>
							 <?php
								$no++;
								endforeach;
							 }
							 ?>
						   
							 </tbody>
						 </table>
					</div>
				</div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Jabatan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('jabatan/tambah') ?>">
                     <div class="form-group">
                         <input type="text" name="jabatan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Jabatan">
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

 <div class="modal fade" id="edit-jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Jabatan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('jabatan/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                         <input type="text" id="jabatan" name="jabatan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Input kota">
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