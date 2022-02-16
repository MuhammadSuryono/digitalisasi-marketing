 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Bidang Usaha</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Bidang Usaha</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-5">Add New Bidang Usaha</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Bidang Usaha Customer</th>
                             <th>Keterangan</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($usaha as $data) :
                                $id_usaha = $data['id_usaha'];
                                $bidang = $data['bidang'];
                                $ket = $data['ket'];
                                ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['bidang'] ?></td>
                             <td><?php echo $data['ket'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>usaha/hapus/<?php echo $data['id_usaha']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                     <a href="javascript:;" data-toggle="modal" data-target="#edit-data2" data-id="<?php echo $id_usaha; ?>" data-bidang="<?php echo $bidang; ?>" data-ket="<?php echo $ket; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                 </center>
                             </td>
                         </tr>
                         <?php
                            $no++;
                        endforeach;
                        ?>
                     </tbody>
                 </table>


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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Bidang Usaha</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('usaha/tambah') ?>">
					  <div class="form-group">
						 <label>Bidang Usaha Customer</label>
                         <input type="text" name="bidang" class="form-control form-control-user" placeholder="Bidang usaha customer"  required>
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" name="ket" class="form-control form-control-user" placeholder="Keterangan" required>
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

 <div class="modal fade" id="edit-data2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Bidang Usaha</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('usaha/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
						 <label>Bidang Usaha Customer</label>
                         <input type="text" id="bidang" name="bidang" class="form-control form-control-user" placeholder="Bidang usaha customer" required>
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" id="ket" name="ket" class="form-control form-control-user" placeholder="Keterangan">
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
