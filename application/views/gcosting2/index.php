 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Group Costing Level 2</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-2">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Group Costing 1</th>
                             <th>Keterangan</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($costing as $data) :
                                $id_m = $data['id_g_c2'];
                                $m = $data['g_c2'];
                                $ket = $data['keterangan'];
                                ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['g_c2'] ?></td>
                             <td><?php echo $data['keterangan'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>groupCosting1/hapus/<?php echo $data['id_g_c2']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                     <a href="javascript:;" data-toggle="modal" data-target="#edit-methodology" data-id="<?php echo $id_m; ?>" data-m="<?php echo $m ?>" data-ket="<?php echo $ket ?>" class="btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>

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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Jenis Pekerjaan RFQ</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('groupCosting2/tambah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
						 <label>Group Costing 2</label>
                         <input type="text"  name="g_c2" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text"  name="keterangan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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

 <div class="modal fade" id="edit-methodology" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Jenis Pekerjaan RFQ</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('groupCosting2/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
						 <label>Group Costing 2</label>
                         <input type="text" id="m" name="g_c2" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" id="ket" name="keterangan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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