 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input User</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
         </div>

         <div class="card-body">
             <form action="<?php echo base_url('surat/tambah') ?>" method="POST" class="row">
                 <div class="col-xl-4 col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Jenis Surat</label>
                         <input type="text" name="jenis_surat" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>">
                         <?php echo form_error('user', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">

                         <textarea name="isi_surat" class="form-control" id="exampleTextarea" rows="10" placeholder="Isi surat..."></textarea>
                         <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group">
                         <button class="btn btn-primary" type="submit">Save</button>
                         <a href="<?php base_url('user') ?>" class=" btn btn-danger"> Back</a>
                     </div>

                 </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content --> 