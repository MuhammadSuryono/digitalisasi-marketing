 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Edit Perusahaan</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Perusahaan > Form Edit Perusahaan</h6>
         </div>

         <div class="card-body">
             <form action="" method="POST" class="row">
                 <div class="col-xl-5 col-md-6 mb-4">
                     <input type="hidden" name="id" value="<?php echo $perusahaan['id_perusahaan']; ?>">
                     <div class="form-group">
                         <label for="user">Nama Perusahaan</label>
                         <input type="text" name="nama" class="form-control form-control-user <?php if (form_error('nama')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['nama'] ?>">
                         <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Bidang Usaha</label>
                         <select name="bidang" class="selectpicker show-tick form-control <?php if (form_error('bidang')) {
                                                                                                echo 'is-invalid';
                                                                                            } ?>" data-live-search="true" title="Pilih bidang usaha...">
                             <?php
                                $data = $this->Usaha_model->getAllUsaha();
                                foreach ($data as $db) : ?>
                                 <?php if ($perusahaan['bidang'] == $db['id_usaha']) { ?>
                                     <option value="<?php echo $db['id_usaha'] ?>" selected><?php echo $db['bidang'] ?></option>
                                 <?php } else { ?>
                                     <option value="<?php echo $db['id_usaha'] ?>"><?php echo $db['bidang'] ?></option>
                                 <?php } ?>
                             <?php endforeach; ?>
                         </select>
                         <?php echo form_error('bidang', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Alamat</label>
                         <input type="text" name="alamat" class="form-control form-control-user <?php if (form_error('alamat')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['alamat'] ?>">
                         <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Kota</label>
                         <select name="kota" class="selectpicker show-tick form-control <?php if (form_error('kota')) {
                                                                                            echo 'is-invalid';
                                                                                        } ?>" data-live-search="true" title="Pilih kota...">
                             <?php
                                $data = $this->Kota_model->getAllKota();
                                foreach ($data as $db) : ?>
                                 <?php if ($perusahaan['kota'] == $db['id_kota']) { ?>
                                     <option value="<?php echo $db['id_kota'] ?>" selected><?php echo $db['kota'] ?></option>
                                 <?php } else { ?>
                                     <option value="<?php echo $db['id_kota'] ?>"><?php echo $db['kota'] ?></option>
                                 <?php } ?>
                             <?php endforeach; ?>
                         </select>
                         <?php echo form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="col-xl-5 col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Negara</label>
                         <input type="text" name="negara" class="form-control form-control-user <?php if (form_error('negara')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['negara'] ?>">
                         <?php echo form_error('negara', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group row">
                         <div class="col-sm-12 mb-3">
                             <label for="email">Email</label>
                             <input type="text" name="email" class="form-control form-control-user <?php if (form_error('email')) {
                                                                                                        echo 'is-invalid';
                                                                                                    } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['email'] ?>">
                             <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="col-sm-6 mb-3 mb-sm-0">
                             <label for="user">Telp</label>
                             <input type="number" name="telp" class="form-control form-control-user <?php if (form_error('telp')) {
                                                                                                        echo 'is-invalid';
                                                                                                    } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['telp'] ?>">
                             <?php echo form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="col-sm-6">
                             <label for="user">Fax</label>
                             <input type="number" name="fax" class="form-control form-control-user <?php if (form_error('fax')) {
                                                                                                        echo 'is-invalid';
                                                                                                    } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['fax'] ?>">
                             <?php echo form_error('fax', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="user">Web</label>
                         <input type="text" name="web" class="form-control form-control-user <?php if (form_error('web')) {
                                                                                                    echo 'is-invalid';
                                                                                                } ?>" id="exampleInputEmail" value="<?php echo $perusahaan['web'] ?>">
                         <?php echo form_error('web', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group">
                         <button class="btn btn-primary" type="submit">Save</button>
                         <a href="<?php echo base_url('perusahaan') ?>" class=" btn btn-danger"> Back</a>
                     </div>

                 </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->