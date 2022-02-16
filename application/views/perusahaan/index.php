 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Perusahaan</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Perusahaan</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="<?php echo base_url('perusahaan/tambah') ?>" class="btn btn-primary mb-5">Add New Perusahaan</a>
                 <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Perusahaan</th>
                             <th>Bidang</th>
                             <th>Alamat</th>
                             <th>Kota</th>
                             <th>Negara</th>
                             <th>Telp/fax</th>
                             <th>Web</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($perusahaan as $data) : ?>
                         <tr>
                             <td class="align-middle"><b><?php echo $no ?></b></td>
                             <td class="align-middle"><?php echo $data['nama'] ?></td>
                             <td class="align-middle"><?php echo $data['bidang'] ?></td>
                             <td class="align-middle"><?php echo $data['alamat'] ?></td>
                             <td class="align-middle"><?php echo $data['kota'] ?></td>
                             <td class="align-middle"><?php echo $data['negara'] ?></td>
                             <td class="align-middle" class="align-middle"><?php echo $data['telp'] ?>/<?php echo $data['fax'] ?></td>
                             <td class="align-middle"><?php echo $data['web'] ?></td>
                             <td class="align-middle text-center">
                                     <a href="<?php echo base_url(); ?>perusahaan/hapus/<?php echo $data['id_perusahaan']; ?> " class="btn btn-danger btn-sm tombol-hapus" ><i class="fas fa-trash"></i> </a>
                                     <a href="<?php echo base_url(); ?>perusahaan/ubah/<?php echo $data['id_perusahaan']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> </a>
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
