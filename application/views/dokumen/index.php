 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Daftar Jenis Dokumen</h1>
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
                             <th>Dokumen</th>
                             <th>Keterangan</th>
                             <th>Email</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($dokumen as $data) :
                                $id_d = $data['id_dokumen'];
                                $d = $data['dokumen'];
                                $ket = $data['keterangan'];
                                $email = $data['email'];
                                ?>
                         <tr>
                             <td><b><?php echo $no ?></b></td>
                             <td><?php echo $data['dokumen'] ?></td>
                             <td><?php echo $data['keterangan'] ?></td>
                             <td><?php echo $data['email'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>dokumen/hapus/<?php echo $data['id_dokumen']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                     <a href="javascript:;" data-toggle="modal" data-target="#edit-dokumen" data-id="<?php echo $id_d; ?>" data-d="<?php echo $d ?>" data-ket="<?php echo $ket ?>" data-email="<?php echo $email ?>" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> Edit</a>

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
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Jenis Dokumen</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('dokumen/tambah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
						 <label>Dokumen</label>
                         <input type="text" name="dokumen" class="form-control form-control-user" placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" name="keterangan" class="form-control form-control-user" placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Email</label>
                         <input type="text" name="email" class="form-control form-control-user" placeholder="">
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

 <div class="modal fade" id="edit-dokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Jenis Dokumen</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('dokumen/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
						 <label>Dokumen</label>
                         <input type="text" id="d" name="dokumen" class="form-control form-control-user"  placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Keterangan</label>
                         <input type="text" id="ket" name="keterangan" class="form-control form-control-user" placeholder="">
                     </div>
					 <div class="form-group">
						 <label>Email</label>
                         <input type="text" id="email" name="email" class="form-control form-control-user" placeholder="">
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

<script>
 $(document).ready(function () {
 	$('#edit-dokumen').on('show.bs.modal', function (event) {
 		var div = $(event.relatedTarget);
 		var modal = $(this)

 		modal.find('#id').attr("value", div.data('id'));
 		modal.find('#d').attr("value", div.data('d'));
 		modal.find('#ket').attr("value", div.data('ket'));
 		modal.find('#email').attr("value", div.data('email'));
 	});
 });
</script>
