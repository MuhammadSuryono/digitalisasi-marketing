 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Mata Uang</h1>
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
                             <th>Mata Uang</th>
                             <th>Simbol</th>
                             <th>Pemisah</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            // var_dump($db);
                            foreach ($db as $data) :
                            ?>
                             <tr>
                                 <td><b><?php echo $no ?></b></td>
                                 <td><?= $data['mata_uang'] ?></td>
                                 <td><?= $data['simbol_mata_uang'] ?></td>
                                 <td><?= $data['pemisah'] ?></td>
                                 <td>
                                     <center>
                                         <a href="<?php echo base_url(); ?>mataUang/hapus/<?php echo $data['id_mata_uang']; ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                         <button id="buttonEdit" data-toggle="modal" data-target="#edit-methodology" data-id="<?= $data['id_mata_uang'] ?>" data-m="" data-ket="" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button>

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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Mata Uang</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('mataUang/tambah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                         <label>Mata Uang</label>
                         <input type="text" name="mataUang" id="mataUang" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <div class="form-group">
                         <label>Simbol</label>
                         <input type="text" name="simbol" id="simbol" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <div class="form-group">
                         <label>Pemisah</label>
                         <input type="text" name="pemisah" id="pemisah" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <p>Example:</p>
                     <p class="text-center display-4" id="example"></p>
             </div>
             <div class=" modal-footer">
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
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Alasan batal</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('mataUang/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                         <label>Mata Uang</label>
                         <input type="text" name="mataUang" id="mataUangEdit" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <div class="form-group">
                         <label>Simbol</label>
                         <input type="text" name="simbol" id="simbolEdit" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <div class="form-group">
                         <label>Pemisah</label>
                         <input type="text" name="pemisah" id="pemisahEdit" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                     </div>
                     <p>Example:</p>
                     <p class="text-center display-4" id="exampleEdit"></p>
             </div>
             <div class=" modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button>
             </div>
             </form>
         </div>
     </div>
 </div>

 <script>
     $('#simbol').keyup(function() {
         format();
     })
     $('#pemisah').keyup(function() {
         format();
     })

     $('#simbolEdit').keyup(function() {
         formatEdit();
     })
     $('#pemisahEdit').keyup(function() {
         formatEdit();
     })

     function format() {
         const mataUang = $('#mataUang').val();
         const simbol = $('#simbol').val();
         const pemisah = $('#pemisah').val();
         $('#example').text(`${simbol} ${numberWithCommas('1000', pemisah)}`)
     }

     function formatEdit() {
         const mataUang = $('#mataUangEdit').val();
         const simbol = $('#simbolEdit').val();
         const pemisah = $('#pemisahEdit').val();
         $('#exampleEdit').text(`${simbol} ${numberWithCommas('1000', pemisah)}`)
     }

     function numberWithCommas(x, y) {
         return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, `${y}`);
     }
 </script>