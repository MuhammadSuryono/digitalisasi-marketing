 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input City</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <form action="" method="POST" class="row">
                 <div class="col-xl-5 col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Nama Kota</label>
                         <input type="hidden" name="id" value="<?= $kota['id_city'] ?>">
                         <input type="text" name="city" class="form-control form-control-user <?php if(form_error('nama')){ echo'is-invalid'; } ?>" id="exampleInputEmail" value="<?php echo $kota['name_city'] ?>">
                         <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <?php foreach ($komponen as $db) { ?>
                     <?php $val = $this->db->get_where('city_kom',['id_kota_cost'=>$kota['id_city'], 'id_komponen_cost'=>$db['id_komponen']])->row_array();  ?>
                     <div class="form-group">
                         <label for="user"><?php echo $db['komponen'] ?></label>
                         <input type="text" name="<?php echo $db['id_komponen'] ?>" value="<?= $val['harga'] ?>" class="form-control form-control-user " id="exampleInputEmail">
                     </div>
                     <?php } ?>

                     <div class="form-group">
                         <button class="btn btn-primary" type="submit">Save</button>
                         <a href="<?php echo base_url('city') ?>" class=" btn btn-danger"> Back</a>
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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('perusahaan/tambahBidang') ?>">
					  <div class="form-group">
						 <label>Bidang Usaha Customer</label>
                         <input type="text" name="bidang" class="form-control form-control-user" aria-describedby="emailHelp"  required>
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" name="ket" class="form-control form-control-user" aria-describedby="emailHelp" required>
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