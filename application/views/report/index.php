 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Jenis Permintaan</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
             <form action="<?=base_url('report/lihat')?>" method="post">
             <div class="row">
             <div class="col-md-6">
             <div class="form-group">
                         <label for="user">Tanggal Pertama <sup>*(MM/DD/YYYY)</sup> </label>
                         <input id="datepicker1" name="date1" class="form-control form-control-user <?php if(form_error('date1')){ echo'is-invalid'; } ?>" id="exampleInputEmail" value="<?php echo date('m-01-Y');  ?>">
                         <?php echo form_error('date1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
             
             </div>

             <div class="col-md-6">
             
                     <div class="form-group">
                         <label for="user">Tanggal Kedua <sup>*(MM/DD/YYYY)</sup></label>
                         <input id="datepicker2" name="date2" class="form-control form-control-user <?php if(form_error('date2')){ echo'is-invalid'; } ?>" id="exampleInputEmail" value="<?php echo date('m-d-Y');  ?>">
                         <?php echo form_error('date2', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
             
             </div>
             
             </div>


                 <button type="submit" class="btn btn-primary mb-2">Tampilkan Data</button>
                 </form>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Jenis Permintaan</th>
                             <?php foreach ($status as $st):?>
                             <th><?=$st['status']?></th>
                             <?php endforeach?>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($db as $data) :
                                ?>
                         <tr>
                                <td><b><?php echo $no ?></b></td>
                                <td><?php echo $data['jenis_permintaan'] ?></td>
                                <td><?php echo $data['ON_PROGRESS'] ?></td>
                                <td><?php echo $data['DEAL'] ?></td>
                                <td><?php echo $data['NO_DEAL'] ?></td>
                                <td><?php echo $data['PENDING'] ?></td>
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