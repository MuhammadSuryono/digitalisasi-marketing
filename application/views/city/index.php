 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar City Costing</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                <a href="<?php echo base_url('city/tambah') ?>" class="btn btn-primary mb-4">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Name City</th>
                             <?php foreach ($komponen as $db ) {?>
                             <th><?php echo $db['komponen'] ?></th>
                             <?php } ?>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $no = 1;  ?>
                         <?php foreach ($city as $db) { ?>
                            <tr>
                                <td><?php echo $no  ?></td>
                                <td><?php echo $db['name_city']  ?></td>
                                <?php foreach ($komponen as $data ) {?>
                                    <td><?php echo $hasil[$db['id_city']][$data['id_komponen']] ?></td>
                                <?php } ?>
                                <td class="text-center"> <a href="<?= base_url('city/edit/'.$db['id_city']) ?>" class="btn btn-success">edit</a></td>
                            </tr>
                         <?php $no++;  ?>
                         <?php } ?>
                     </tbody>
                 </table>


             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->


