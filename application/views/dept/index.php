 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Dept</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Departement</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-5">Add New Departement</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Dept</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($dept as $data) :
                                $id_dept = $data['id_dept'];
                                $dept = $data['dept'];
                            ?>
                             <tr>
                                 <td><b><?php echo $no ?></b></td>
                                 <td><?php echo $data['dept'] ?></td>
                                 <td>
                                     <center>
                                         <a href="<?php echo base_url(); ?>dept/hapus/<?php echo $data['id_dept']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                         <a href="javascript:;" data-toggle="modal" data-target="#edit-dept" data-id="<?php echo $id_dept; ?>" data-dept="<?php echo $dept; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Dept</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('dept/tambah') ?>">
                     <div class="form-group">
                         <input type="text" name="dept" class="form-control form-control-user" placeholder="Input Nama Dept" required>
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

 <div class="modal fade" id="edit-dept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Dept</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('dept/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                         <input type="text" id="dept" name="dept" class="form-control form-control-user" placeholder="Input Nama Dept" required>
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