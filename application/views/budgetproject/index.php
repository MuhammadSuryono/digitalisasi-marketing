 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Pagu Budget Project</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nomor Rfq</th>
                             <th>Kode Project</th>
                             <th>Nama Project</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $no= 1;
                        foreach ($rfq as $data) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data['nomor_rfq'] ?></td>
                            <td><?php echo $data['kode_project'] ?></td>
                            <td><?php echo $data['nama_project'] ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('budgetProject/view/'.$data['nomor_rfq']) ?>" class="btn btn-info btn-sm">view</a>
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
