 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input User</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data User > Form Edit User</h6>
         </div>

         <div class="card-body">
             <form action="" method="POST" class="row">
                 <div class="col-md-6 mb-4">
                     <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
                     <div class="form-group">
                         <label for="user">User</label>
                         <input type="text" name="user" class="form-control form-control-user" placeholder="User" value="<?php echo $user['nama_user'] ?>">
                         <?php echo form_error('user', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Dept</label>
                         <select name="dept" class="selectpicker show-tick form-control <?php if(form_error('dept')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih department...">
                             <?php
                                $data = $this->Dept_model->getAllDept();
                                foreach ($data as $db) : ?>
                             <?php if ($user['dept'] == $db['id_dept']) { ?>
                             <option value="<?php echo $db['id_dept'] ?>" selected><?php echo $db['dept'] ?></option>
                             <?php
                            } else { ?>
                             <option value="<?php echo $db['id_dept'] ?>"><?php echo $db['dept'] ?></option>
                             <?php
                            } ?>
                             <?php endforeach; ?>
							 <?php echo form_error('dept', '<small class="text-danger pl-3">', '</small>'); ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="user">Jabatan</label>
                         <select name="jabatan" class="selectpicker show-tick form-control <?php if(form_error('dept')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih jabatan...">
                             <?php
                                $data = $this->Jabatan_model->getAllJabatan();
                                foreach ($data as $db) : ?>
                             <?php if ($user['jabatan'] == $db['id_jabatan']) { ?>
                             <option value="<?php echo $db['id_jabatan'] ?>" selected><?php echo $db['jabatan'] ?></option>
                             <?php
                            } else { ?>
                             <option value="<?php echo $db['id_jabatan'] ?>"><?php echo $db['jabatan'] ?></option>
                             <?php
                            } ?>
                             <?php endforeach; ?>
                         </select>
                         <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Email1</label>
                         <input type="text" name="email1" class="form-control form-control-user" placeholder="Email 1" value="<?php echo $user['email1'] ?> ">
                         <?php echo form_error('email1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Email2</label>
                         <input type="text" name="email2" class="form-control form-control-user" placeholder="Email 2" value="<?php echo $user['email2'] ?>">
                         <?php echo form_error('email2', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="col-12 text-right">
                   <div class="form-group">
                       <button class="btn btn-primary" type="submit">Save</button>
                       <a href="<?php echo base_url('user') ?>" class=" btn btn-danger"> Back</a>
                   </div>
                 </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
