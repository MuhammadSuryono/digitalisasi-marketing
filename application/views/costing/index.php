 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Costing 
     </h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-2">Add </a>
                 <table class="table" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nomor Request</th>
                             <th>Nama Project</th>
                             <th>Methodology </th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($cc as $data) : ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['nomor_rfq'] ?></td>
                             <td><?php echo $data['nama_project'] ?></td>
                             <td><?php echo $data['methodology'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>costing/view/<?php echo $data['nomor_rfq'] ?>" class="btn btn-success btn-sm" >Costing </a>

                                     <button href="" data-toggle="modal" data-target="#rfq<?=$data['nomor_rfq']?>" class="btn btn-primary btn-sm" >Tambah Kota </button>
                               
                                     <a href="<?php echo base_url(); ?>costing/delete/<?php echo $data['nomor_rfq'] ?>" class="btn btn-danger btn-sm tombol-hapus" >Delete</a>
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
                 <form action="<?php echo base_url('costing/add') ?>" method="POST">
                    <div class="form-group">
                        <label>Request</label>
                        <select name="nomor_rfq" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project..." >
                        <?php foreach($idrfq as $id): ?>
                            <?php $db = $this->Rfq_model->getRfqById($id); ?> 
                             <option value="<?php echo $db['nomor_rfq'] ?>"><?php echo $db['nomor_rfq'] ?> - <?php echo $db['kode_project'] ?> - <?php echo $db['nama_project'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Methodology</label>
                        <select name="methodology" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project..." >
                        <?php foreach($metode as $db): ?>
                             <option value="<?php echo $db['id_methodology'] ?>"><?php echo $db['methodology'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <table class="table">
                            <?php foreach($kota as $db): ?>
                                <tr>
                                    <td><input type="checkbox" name="kota[]" value="<?php echo $db['id_city'] ?>"> </td>
                                    <td><?php echo $db['name_city'] ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
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


 <?php foreach($cc as $data) :?>
<div class="modal fade" id="rfq<?=$data['nomor_rfq']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">


             <form action="<?php echo base_url('costing/addKota') ?>" method="POST">
                    <div class="form-group">
                        <label>Request</label>
                        <input type="text" value="<?php echo $data['nomor_rfq']; ?>" name="nomor_rfq" class="form-control form-control-user"  readonly>
                    </div>

                    <div class="form-group">
                        <label>Methodology</label>
                        <select name="methodology" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project..." >
                        <?php foreach($metode as $db): ?>
                            <?php if ($db['id_methodology'] == $data['id_methodology']) { ?>
                             <option value="<?php echo $db['id_methodology'] ?>" selected><?php echo $db['methodology'] ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $db['id_methodology'] ?>"><?php echo $db['methodology'] ?></option>
                            <?php }?>

                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <table class="table">
                            
                            <?php foreach( $kota as $db): ?>
                                <tr>
                                    <td><input type="checkbox" name="kota[]" value="<?php echo $db['id_city'] ?>"> </td>
                                    <td><?php echo $db['name_city'] ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
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
                    <?php endforeach;?>