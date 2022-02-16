 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Upload Bank Proposal</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4 ">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Form Upload</h6>
         </div>

         <div class="card-body">
            <form action="<?php echo base_url('proposal/tambah') ?>" enctype="multipart/form-data" method="POST" class="row">
                 <div class="col-xl-4 col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Date</label>
                         <input type="date" name="date" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>" required>
                         <?php echo form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
					 
					 <div class="form-group">
                         <label for="user">Nomor Request</label>
                         <select name="rfq" class="selectpicker show-tick form-control <?php if(form_error('rfq')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih Request..." required>
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
						  <?php echo form_error('nomor_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
					 
					 <div class="form-group">
                         <label for="user">Methodology</label>
                         <select name="methodology" class="selectpicker show-tick form-control <?php if(form_error('methodology')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih methodology..." required>
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
                         <label for="user">Bidang Usaha</label>
                         <select name="usaha" class="selectpicker show-tick form-control <?php if(form_error('usaha')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih usaha..." required>
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
                         <label for="user">Upload File</label>
                         <table class="table table-bordered" id="dynamic_field">  
							<tr>  
								 <td><input type="file" name="filedata[]" placeholder="Enter your Name" class="form-control name_list" /></td>  
								 <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
							</tr>  
						 </table>
                     </div>
					 <div class="form-group">
						 <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-upload"></i> Upload</button>
			
					 </div>
				 </div>
             </form>
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