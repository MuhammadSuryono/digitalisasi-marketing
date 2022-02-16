 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Kota</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Kota</h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-5">Add New Kota</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Kota</th>
                             <th>Negara</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($kota as $data) :
                                $id_kota = $data['id_kota'];
                                $kota = $data['kota'];
                                ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['kota'] ?></td>
                             <td><?php echo $data['negara'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>kota/hapus/<?php echo $data['id_kota']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash fa-sm"></i> Delete</a>
                                     <a href="javascript:;" data-toggle="modal" data-target="#edit-data" data-negara="<?php echo $data['id_negara'] ?>" data-id="<?php echo $id_kota; ?>" data-kota="<?php echo $kota; ?>" class="btn btn-success btn-sm edit"><i class="fas fa-pen fa-sm"></i> Edit</a>

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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('kota/tambah') ?>">
                    <div class="form-group">
                      <label>Pilih negara</label>
                        <select  name="id_negara" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih negara" required>
                        <?php
                        $negara = $this->Negara_model->getAllNegara();
                        foreach($negara as $db):
                         ?>
                            <option value="<?php echo $db['id_negara'] ?>"><?php echo $db['negara'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                     <div class="form-group">
                       <label>Nama kota</label>
                         <input type="text" name="kota" class="form-control form-control-user" placeholder="Input Nama Kota" required>
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
                        <label>Pilih negara</label>
                        <select id="negara" name="id_negara" class="form-control" data-live-search="true" required>
                        <?php
                        $negara = $this->Negara_model->getAllNegara();
                        foreach($negara as $db):
                         ?>
                            <option value="<?php echo $db['id_negara'] ?>"><?php echo $db['negara'] ?></option>
                        <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-group">
                       <label>Nama kota</label>
                         <input type="text" id="kota" name="kota" class="form-control form-control-user" placeholder="Input Nama Kota" required>
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
