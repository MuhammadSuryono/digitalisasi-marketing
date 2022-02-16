 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Form Input Perusahaan</h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">Data Perusahaan > Form Input New Perusahaan</h6>
     </div>

     <div class="card-body">
       <form action="<?php echo base_url('perusahaan/tambah') ?>" method="POST" class="row">
         <div class="col-md-6 mb-4">
           <div class="form-group">
             <label for="user">Nama Perusahaan</label>
             <input type="text" name="nama" class="form-control form-control-user <?php if (form_error('nama')) {
                                                                                    echo 'is-invalid';
                                                                                  } ?>" placeholder="Nama perusahaan" value="<?php echo set_value('nama'); ?>">
             <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
           <div class="form-group">
             <label for="user">Bidang Usaha</label> - <a href="" data-toggle="modal" data-target="#bidang">tambah</a>
             <select name="bidang" id="listBidang" class="selectpicker show-tick form-control <?php if (form_error('bidang')) {
                                                                                                echo 'is-invalid';
                                                                                              } ?>" data-live-search="true" title="Pilih bidang usaha...">
               <?php
                $data = $this->Usaha_model->getAllUsaha();
                foreach ($data as $db) : ?>
                 <?php if (set_value('bidang') == $db['id_usaha']) { ?>
                   <option value="<?php echo $db['id_usaha'] ?>" selected><?php echo $db['bidang'] ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db['id_usaha'] ?>"><?php echo $db['bidang'] ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('bidang', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
           <div class="form-group">
             <label for="user">Alamat</label>
             <input type="text" name="alamat" class="form-control form-control-user <?php if (form_error('alamat')) {
                                                                                      echo 'is-invalid';
                                                                                    } ?>" placeholder="Alamat perusahaan" value="<?php echo set_value('alamat'); ?>">
             <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
           <div class="form-group">
             <label for="user">Kota</label> - <a href="" data-toggle="modal" data-target="#kota">tambah</a>
             <select name="kota" id="listKota" class="selectpicker show-tick form-control <?php if (form_error('kota')) {
                                                                                            echo 'is-invalid';
                                                                                          } ?>" data-live-search="true" title="Pilih kota...">
               <?php
                $data = $this->Kota_model->getAllKota();
                foreach ($data as $db) : ?>
                 <?php if (set_value('kota') == $db['id_kota']) { ?>
                   <option value="<?php echo $db['id_kota'] ?>" selected><?php echo $db['kota'] ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db['id_kota'] ?>"><?php echo $db['kota'] ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
         </div>
         <div class="col-md-6 mb-4">
           <div class="form-group">
             <label for="user">Negara</label> - <a href="" data-toggle="modal" data-target="#negara">tambah</a>
             <select name="negara" id="listNegara" class="selectpicker show-tick form-control <?php if (form_error('negara')) {
                                                                                                echo 'is-invalid';
                                                                                              } ?>" data-live-search="true" title="Pilih negara...">
               <?php
                $data = $this->Negara_model->getAllNegara();
                foreach ($data as $db) : ?>
                 <?php if (set_value('negara') == $db['id_negara']) { ?>
                   <option value="<?php echo $db['id_negara'] ?>" selected><?php echo $db['negara'] ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db['id_negara'] ?>"><?php echo $db['negara'] ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('negara', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
           <div class="form-group row">
             <div class="col-sm-12 mb-3">
               <label for="user">Email</label>
               <input type="text" name="email" class="form-control form-control-user <?php if (form_error('email')) {
                                                                                        echo 'is-invalid';
                                                                                      } ?>" placeholder="Email perusahaan" value="<?php echo set_value('email'); ?>">
               <?php echo form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="col-sm-6 mb-3 mb-sm-0">
               <label for="user">Telp</label>
               <input type="number" name="telp" class="form-control form-control-user <?php if (form_error('telp')) {
                                                                                        echo 'is-invalid';
                                                                                      } ?>" placeholder="Telp perusahaan" value="<?php echo set_value('telp'); ?>">
               <?php echo form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="col-sm-6">
               <label for="user">Fax</label>
               <input type="number" name="fax" class="form-control form-control-user" placeholder="Fax perusahaan" value="<?php echo set_value('fax'); ?>">
             </div>
           </div>
           <div class="form-group">
             <label for="user">Web</label>
             <input type="text" name="web" class="form-control form-control-user <?php if (form_error('web')) {
                                                                                    echo 'is-invalid';
                                                                                  } ?>" placeholder="Website perusahaan" value="<?php echo set_value('web'); ?>">
             <?php echo form_error('web', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
         </div>
         <div class="col-12 text-right form-group">
           <button class="btn btn-primary" type="submit">Save</button>
           <a href="<?php echo base_url('perusahaan') ?>" class=" btn btn-danger"> Back</a>
         </div>
       </form>
     </div>
   </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <div class="modal fade" id="bidang" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content bidang">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <label>Bidang Usaha Customer</label>
           <input type="text" name="bidang" id="namaBidang" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Bidang usaha customer">
         </div>
         <div class="form-group">
           <label>Keterangan</label>
           <input type="text" name="ket" id="ketBidang" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Keterangan">
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitBidang">Save</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="kota" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content kota">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <label for="negaraKota">Pilih negara</label>
           <select name="id_negara" id="negaraKota" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih negara">
             <?php
              $negara = $this->Negara_model->getAllNegara();
              foreach ($negara as $db) :
              ?>
               <option value="<?php echo $db['id_negara'] ?>"><?php echo $db['negara'] ?></option>
             <?php endforeach; ?>
           </select>
         </div>
         <div class="form-group">
           <label for="namaKota">Input nama kota</label>
           <input type="text" name="kota" id="namaKota" class="form-control form-control-user" placeholder="Input Nama Kota">
         </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitKota">Save</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="negara" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content negara">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Negara</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <label for="namaNegara">Input nama negara</label>
           <input type="text" name="negara" id="namaNegara" class="form-control form-control-user" placeholder="Input Nama Negara">
         </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitNegara">Save</button>
       </div>
     </div>
   </div>
 </div>

 <script type="text/javascript">
   $(".negara").on("click", ".submitNegara", function() {
     var nama = $("#namaNegara").val().trim();
     if (nama == '') {
       Swal({
         title: 'Oops...',
         text: 'Nama negara harus di isi',
         type: 'error',
         confirmButtonText: 'Tutup'
       })
     } else {
       $.ajax({
         url: '<?php echo base_url('perusahaan/tambahNegaraAdam') ?>',
         type: 'post',
         data: {
           negara: nama
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama negara sudah ada',
               type: 'error',
               confirmButtonText: 'Tutup'
             })
           } else {
             Swal({
               title: 'Berhasil ditambahkan',
               type: 'success',
               showConfirmButton: false,
               timer: 500
             })
             $('#listNegara').append('<option value="' + respon + '">' + nama + '</option>');
             $('#listNegara').selectpicker('refresh');
             $("#namaNegara").val('');
             $('#negara').modal('hide');
           }
         },
         error: function(jqXHR, error, errorThrown) {
           Swal({
             title: 'Oops...',
             text: 'Gagal menambahkan, silahkan ulangi',
             type: 'error',
             confirmButtonText: 'Tutup'
           })
         }
       });
     }
   });
   $(".kota").on("click", ".submitKota", function() {
     var nama = $("#namaKota").val().trim();
     var negara = $("#negaraKota").val().trim();
     if (nama == '' || negara == '') {
       Swal({
         title: 'Oops...',
         text: 'Nama kota dan pilihan negara harus di isi',
         type: 'error',
         confirmButtonText: 'Tutup'
       })
     } else {
       $.ajax({
         url: '<?php echo base_url('perusahaan/tambahKotaAdam') ?>',
         type: 'post',
         data: {
           kota: nama,
           id_negara: negara
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama kota sudah ada',
               type: 'error',
               confirmButtonText: 'Tutup'
             })
           } else {
             Swal({
               title: 'Berhasil ditambahkan',
               type: 'success',
               showConfirmButton: false,
               timer: 500
             })
             $('#listKota').append('<option value="' + respon + '">' + nama + '</option>');
             $('#listKota').selectpicker('refresh');
             $('#negaraKota').selectpicker('refresh');
             $("#namaKota").val('');
             $('#kota').modal('hide');
           }
         },
         error: function(jqXHR, error, errorThrown) {
           Swal({
             title: 'Oops...',
             text: 'Gagal menambahkan, silahkan ulangi',
             type: 'error',
             confirmButtonText: 'Tutup'
           })
         }
       });
     }
   });
   $(".bidang").on("click", ".submitBidang", function() {
     var nama = $("#namaBidang").val().trim();
     var ket = $("#ketBidang").val().trim();
     if (nama == '' || ket == '') {
       Swal({
         title: 'Oops...',
         text: 'Nama bidang dan keterangan harus di isi',
         type: 'error',
         confirmButtonText: 'Tutup'
       })
     } else {
       $.ajax({
         url: '<?php echo base_url('perusahaan/tambahBidangAdam') ?>',
         type: 'post',
         data: {
           bidang: nama,
           ket: ket
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama bidang sudah ada',
               type: 'error',
               confirmButtonText: 'Tutup'
             })
           } else {
             Swal({
               title: 'Berhasil ditambahkan',
               type: 'success',
               showConfirmButton: false,
               timer: 500
             })
             $('#listBidang').append('<option value="' + respon + '">' + nama + '</option>');
             $('#listBidang').selectpicker('refresh');
             $("#namaBidang").val('');
             $("#ketBidang").val('');
             $('#bidang').modal('hide');
           }
         },
         error: function(jqXHR, error, errorThrown) {
           Swal({
             title: 'Oops...',
             text: 'Gagal menambahkan, silahkan ulangi',
             type: 'error',
             confirmButtonText: 'Tutup'
           })
         }
       });
     }
   });
 </script>