 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Templates Project Plan</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal"  class="btn btn-primary mb-2">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Template Proyek</th>
                             <th class="text-center">Jumlah Kegiatan</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no= 1;
                        foreach ($templates as $data) {
                        $kegiatan = $this->db->get_where('jenis_kegiatan', array('id_template_project' => $data['id_template_project']))->result_array();
                        $jml = count($kegiatan);
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['nama_template'] ?></td>
                            <td class="text-center"><?php echo $jml ?> kegiatan</td>
                            <td  class="text-center">
                                <a href="<?php echo base_url('templateProjectPlan/hapus/'.$data['id_template_project']) ?>" class="btn btn-danger btn-sm tombol-hapus">delete</a>
                                <a href="<?php echo base_url('templateProjectPlan/view/'.$data['id_template_project']) ?>" class="btn btn-info btn-sm">Kegiatan <i class="fas fa-angle-double-right"></i></a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        }
                         ?>
                     </tbody>
                 </table>


             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Template Project Plan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('templateProjectPlan/tambah') ?>">
                     <div class="form-group">
                         <input type="text" name="nama_template" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Nama Template">
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
