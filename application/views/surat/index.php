 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Tables Daftar Surat</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="<?php echo base_url('surat/tambah') ?>" class="btn btn-primary mb-4">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Jenis Surat</th>
                             <th>Isi Surat</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($surat as $data) : ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['jenis_surat'] ?></td>
                             <td><?php echo $data['isi_surat'] ?></td>
                             <td width="200px">
                                 <center>
                                     <a href="<?php echo base_url(); ?>surat/hapus/<?= $data['id_surat']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash fa-sm"></i> Delete</a>
                                     <a href="<?php echo base_url(); ?>surat/ubah/<?= $data['id_surat']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pen fa-sm"></i> Edit</a>
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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="form-group">
                         <input type="text" name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="User">
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save</button>
             </div>
         </div>
     </div>
 </div> 