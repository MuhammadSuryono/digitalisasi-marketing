 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Tables Komponen Costing</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-4">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Komponen</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($komponen as $data) :
                                $id_komponen = $data['id_komponen'];
                                $komponen = $data['komponen'];
                                ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['komponen'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>komponen/hapus/<?php echo $data['id_komponen']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash fa-sm"></i> Delete</a>
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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Komponen</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('komponen/tambah') ?>">
                     <div class="form-group">
                         <input type="text" name="komponen" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Komponen">
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

 <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('kota/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                      <div class="form-group">
                        <select id="negara" name="id_negara" class="form-control" data-live-search="true">
                        <?php 
                        $negara = $this->Negara_model->getAllNegara();
                        foreach($negara as $db):
                         ?>
                            <option value="<?php echo $db['id_negara'] ?>"><?php echo $db['negara'] ?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-group">
                         <input type="text" id="kota" name="kota" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Input kota">
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

<script type="text/javascript">
    $(document).on('click', '.edit', function(){
        var negara = $(this).attr('data-negara');

    $('#negara option[value='+ negara +']').attr('selected', 'selected');
        console.log(negara);
    });
</script>