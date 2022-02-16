 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Edit Customer</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Customer > Form Edit Customer</h6>
         </div>
         <div class="card-body">
             <form action="" method="POST" class="row">
                 <div class="col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Nama</label>
						 <input type="hidden" name="id" value="<?php echo $customer['id_customer'] ?>">
                         <input type="text" name="nama" class="form-control form-control-user <?php if(form_error('nama')){ echo'is-invalid'; } ?>" placeholder="Nama customer" value="<?php echo $customer['nama']; ?>">
                         <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Sebutan</label>
                         <select name="status" class="selectpicker show-tick form-control <?php if(form_error('status')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih sebutan...">
                             <?php
                                $data = array('Mr','Mrs','Ms');
                                foreach ($data as $db) : ?>
							 <?php if ($customer['status'] == $db ) { ?>
							<option value="<?php echo $db ?>" selected><?php echo $db ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db ?>"><?php echo $db ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						 <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group">
                         <label for="user">Perusahaan</label>
                         <select name="perusahaan" id="listPerusahaan" class="selectpicker show-tick form-control <?php if(form_error('perusahaan')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih perusahaan...">
                             <?php
                                $data = $this->Perusahaan_model->getAllPerusahaan();
                                foreach ($data as $db) : ?>
                  							<?php if ($customer['perusahaan'] == $db['id_perusahaan'] ) { ?>
                  							<option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                  							<?php }else{ ?>
                                <option value="<?php echo $db['id_perusahaan'] ?>"><?php echo $db['nama'] ?></option>
                  							<?php } ?>
                              <?php endforeach; ?>
                         </select>
						  <?php echo form_error('perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

					 <div class="form-group">
                         <label for="user">Dept</label>
                         <select name="dept" class="selectpicker show-tick form-control <?php if(form_error('dept')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih dept...">
                             <?php
                                $data = $this->Dept_model->getAllDept();
                                foreach ($data as $db) : ?>
							<?php if ($customer['dept'] == $db['id_dept'] ) { ?>
							<option value="<?php echo $db['id_dept'] ?>" selected><?php echo $db['dept'] ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db['id_dept'] ?>"><?php echo $db['dept'] ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						  <?php echo form_error('dept', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="col-md-6 mb-4">
					 <div class="form-group">
                         <label for="user">Jabatan</label>
                         <select name="jabatan" class="selectpicker show-tick form-control <?php if(form_error('jabatan')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih jabatan...">
                             <?php
                                $data = $this->Jabatan_model->getAllJabatan();
                                foreach ($data as $db) : ?>
							<?php if ($customer['jabatan'] == $db['id_jabatan'] ) { ?>
							<option value="<?php echo $db['id_jabatan'] ?>" selected><?php echo $db['jabatan'] ?></option>
							<?php }else{ ?>
                             <option value="<?php echo $db['id_jabatan'] ?>"><?php echo $db['jabatan'] ?></option>
							<?php } ?>
                             <?php endforeach; ?>
                         </select>
						  <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
                         <label for="user">Phone 1</label>
                         <input type="number" name="hp1" class="form-control form-control-user <?php if(form_error('hp1')){ echo'is-invalid'; } ?>" placeholder="Phone 1" value="<?php echo $customer['hp1'];?>">
                         <?php echo form_error('hp1', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="col-sm-6">
						 <label for="user">Phone 2</label>
                         <input type="number" name="hp2" class="form-control form-control-user" placeholder="Phone 2" value="<?php echo $customer['hp2']; ?>">
						</div>
                     </div>

					 <div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
                         <label for="user">Email 1</label>
                         <input type="text" name="email1" class="form-control form-control-user <?php if(form_error('email1')){ echo'is-invalid'; } ?>" placeholder="Email 1" value="<?php echo $customer['email1']; ?>">
                         <?php echo form_error('email1', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="col-sm-6">
						 <label for="user">Email 2</label>
                         <input type="text" name="email2" class="form-control form-control-user" placeholder="Email 2" value="<?php echo $customer['email2']; ?>">
						</div>
                     </div>

					 <div class="form-group">
                         <label for="user">Catatan</label>
                         <input type="text" name="catatan" class="form-control form-control-user" placeholder="Catatan" value="<?php echo $customer['catatan']; ?>">
                     </div>



                 </div>
                 <div class="col-12 text-right form-group">
                     <button class="btn btn-primary" type="submit">Save</button>
                     <a href="<?php echo base_url('customer') ?>" class=" btn btn-danger"> Back</a>
                 </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
