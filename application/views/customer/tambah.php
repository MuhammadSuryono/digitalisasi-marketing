 <!-- Begin Page Content -->
 <div class="container-fluid">
   <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
   <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Form Input Customer</h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">Data Customer > Form Input New Customer</h6>
     </div>

     <div class="card-body">
       <form action="<?php echo base_url('customer/tambah') ?>" method="POST" class="row">
         <div class="col-md-6 mb-4">
           <div class="form-group">
             <label for="user">Nama</label>
             <input type="text" name="nama" class="form-control form-control-user <?php if (form_error('nama')) {
                                                                                    echo 'is-invalid';
                                                                                  } ?>" placeholder="Nama customer" value="<?php echo set_value('nama'); ?>">
             <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>
           <div class="form-group">
             <label for="user">Sebutan</label>
             <select name="status" class="selectpicker show-tick form-control <?php if (form_error('status')) {
                                                                                echo 'is-invalid';
                                                                              } ?>" data-live-search="true" title="Pilih sebutan...">
               <?php
                $data = array('Mr', 'Mrs', 'Ms');
                foreach ($data as $db) : ?>
                 <?php if (set_value('status') == $db) { ?>
                   <option value="<?php echo $db ?>" selected><?php echo $db ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db ?>"><?php echo $db ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>

           <div class="form-group">
             <label for="user">Perusahaan</label> - <a href="" data-toggle="modal" data-target="#perusahaan">tambah</a>
             <select name="perusahaan" id="listPerusahaan" class="selectpicker show-tick form-control <?php if (form_error('perusahaan')) {
                                                                                                        echo 'is-invalid';
                                                                                                      } ?>" data-live-search="true" title="Pilih perusahaan...">
               <?php
                $data = $this->Perusahaan_model->getAllPerusahaan();
                foreach ($data as $db) : ?>
                 <?php if ($id == $db['id_perusahaan']) : ?>
                   <option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                 <?php else : ?>
                   <?php if (set_value('perusahaan') == $db['id_perusahaan']) { ?>
                     <option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                   <?php } else { ?>
                     <option value="<?php echo $db['id_perusahaan'] ?>"><?php echo $db['nama'] ?></option>
                   <?php } ?>
                 <?php endif; ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>

           <div class="form-group">
             <label for="user">Dept</label> - <a href="" data-toggle="modal" data-target="#dept">tambah</a>
             <select name="dept" id="listDept" class="selectpicker show-tick form-control <?php if (form_error('dept')) {
                                                                                            echo 'is-invalid';
                                                                                          } ?>" data-live-search="true" title="Pilih dept...">
               <?php
                $data = $this->Dept_model->getAllDept();
                foreach ($data as $db) : ?>
                 <?php if (set_value('dept') == $db['id_dept']) { ?>
                   <option value="<?php echo $db['id_dept'] ?>" selected><?php echo $db['dept'] ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db['id_dept'] ?>"><?php echo $db['dept'] ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('dept', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>

         </div>
         <div class="col-md-6 mb-4">

           <div class="form-group">
             <label for="user">Jabatan</label>- <a href="" data-toggle="modal" data-target="#jabatan">tambah</a>
             <select name="jabatan" id="listJabatan" class="selectpicker show-tick form-control <?php if (form_error('jabatan')) {
                                                                                                  echo 'is-invalid';
                                                                                                } ?>" data-live-search="true" title="Pilih jabatan...">
               <?php
                $data = $this->Jabatan_model->getAllJabatan();
                foreach ($data as $db) : ?>
                 <?php if (set_value('jabatan') == $db['id_jabatan']) { ?>
                   <option value="<?php echo $db['id_jabatan'] ?>" selected><?php echo $db['jabatan'] ?></option>
                 <?php } else { ?>
                   <option value="<?php echo $db['id_jabatan'] ?>"><?php echo $db['jabatan'] ?></option>
                 <?php } ?>
               <?php endforeach; ?>
             </select>
             <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
           </div>

           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <label for="user">Phone 1</label>
               <input type="number" name="hp1" class="form-control form-control-user <?php if (form_error('hp1')) {
                                                                                        echo 'is-invalid';
                                                                                      } ?>" placeholder="Phone 1" value="<?php echo set_value('hp1'); ?>">
               <?php echo form_error('hp1', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="col-sm-6">
               <label for="user">Phone 2</label>
               <input type="number" name="hp2" class="form-control form-control-user" placeholder="Phone 2" value="<?php echo set_value('hp2'); ?>">
             </div>
           </div>

           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <label for="user">Email 1</label>
               <input type="text" name="email1" class="form-control form-control-user <?php if (form_error('email1')) {
                                                                                        echo 'is-invalid';
                                                                                      } ?>" placeholder="Email 1" value="<?php echo set_value('email1'); ?>">
               <?php echo form_error('email1', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="col-sm-6">
               <label for="user">Email 2</label>
               <input type="text" name="email2" class="form-control form-control-user" placeholder="Email 2" value="<?php echo set_value('email2'); ?>">
             </div>
           </div>

           <div class="form-group">
             <label for="user">Catatan</label>
             <input type="text" name="catatan" class="form-control form-control-user" placeholder="Catatan" value="<?php echo set_value('catatan'); ?>">
           </div>
         </div>
         <div class="col-12 form-group text-right">
           <button class="btn btn-primary" type="submit">Save</button>
           <a href="<?php echo base_url('customer') ?>" class=" btn btn-danger"> Back</a>
         </div>
       </form>
     </div>
   </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <div class="modal fade" id="dept" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content tambahDept">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Dept</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <input type="text" name="dept" class="form-control form-control-user" id="namaDept" placeholder="Input Nama Dept">
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitDataDept">Save</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade" id="jabatan" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content tambahJabatan">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Jabatan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <input type="text" name="jabatan" class="form-control" id="namaJabatan" placeholder="Input Nama Jabatan">
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitDataJabatan">Save</button>
       </div>
     </div>
   </div>
 </div>

 <div class="modal fade bd-example-modal-xl" id="perusahaan" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
     <div class="modal-content tambahPerusahaan">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Input Perusahaan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="row">
           <div class="col-12 col-sm-6">
             <div class="form-group">
               <label for="user">Nama Perusahaan</label>
               <input type="text" name="nama" id="namaPerusahaan" class="form-control form-control-user" placeholder="Nama perusahaan">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
               <label for="user">Bidang Usaha</label>
               <select name="bidang" id="bidangPerusahaan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih bidang usaha...">
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
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-12 col-md-6">
             <div class="form-group">
               <label for="user">Alamat</label>
               <input type="text" name="alamat" id="alamatPerusahaan" class="form-control form-control-user" placeholder="Alamat perusahaan">
             </div>
           </div>
           <div class="col-12 col-md-3">
             <div class="form-group">
               <label for="user">Negara</label>
               <select name="negara" id="negaraPerusahaan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih negara...">
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
             </div>
           </div>
           <div class="col-12 col-md-3">
             <div class="form-group">
               <label for="user">Kota</label>
               <select name="kota" id="kotaPerusahaan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih kota...">
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
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-12 col-md-3">
             <div class="form-group">
               <label for="user">Telp</label>
               <input type="number" name="telp" id="telpPerusahaan" class="form-control form-control-user" placeholder="Telp perusahaan">
             </div>
           </div>
           <div class="col-12 col-md-3">
             <div class="form-group">
               <label for="user">Fax</label>
               <input type="number" name="fax" id="faxPerusahaan" class="form-control form-control-user" placeholder="Fax perusahaan">
             </div>
           </div>
           <div class="col-12 col-md-6">
             <div class="form-group">
               <label for="user">Website</label>
               <input type="text" name="web" id="webPerusahaan" class="form-control form-control-user" placeholder="Website perusahaan">
             </div>
           </div>
         </div>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary submitDataPerusahaan">Save</button>
       </div>
     </div>
   </div>
 </div>
 <script type="text/javascript">
   $(".tambahPerusahaan").on("click", ".submitDataPerusahaan", function() {
     var nama = $("#namaPerusahaan").val().trim();
     var bidang = $("#bidangPerusahaan").val().trim();
     var alamat = $("#alamatPerusahaan").val().trim();
     var negara = $("#negaraPerusahaan").val().trim();
     var kota = $("#kotaPerusahaan").val().trim();
     var telp = $("#telpPerusahaan").val().trim();
     var fax = $("#faxPerusahaan").val().trim();
     var web = $("#webPerusahaan").val().trim();
     if (nama == '' || bidang == '' || alamat == '' || negara == '' || kota == '' || telp == '' || web == '') {
       Swal({
         title: 'Oops...',
         text: 'Ada formulir yang masih kosong',
         type: 'error',
         confirmButtonText: 'Tutup'
       })

     } else {
       $.ajax({
         url: '<?php echo base_url('customer/tambahPerusahaanAdam') ?>',
         type: 'post',
         data: {
           nama: nama,
           bidang: bidang,
           alamat: alamat,
           negara: negara,
           kota: kota,
           telp: telp,
           fax: fax,
           web: web
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama perusahaan sudah ada',
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
             $('#listPerusahaan').append('<option value="' + respon + '">' + nama + '</option>');
             $('#listPerusahaan').selectpicker('refresh');
             $("#namaPerusahaan").val('');
             $("#bidangPerusahaan").val('');
             $("#alamatPerusahaan").val('');
             $("#negaraPerusahaan").val('');
             $("#kotaPerusahaan").val('');
             $("#telpPerusahaan").val('');
             $("#faxPerusahaan").val('');
             $("#webPerusahaan").val('');
             $('#perusahaan').modal('hide');
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
   $(".tambahDept").on("click", ".submitDataDept", function() {
     var val = $("#namaDept").val().trim();
     if (val == '') {
       Swal({
         title: 'Oops...',
         text: 'Nama departement harus di isi',
         type: 'error',
         confirmButtonText: 'Tutup'
       })
     } else {
       $.ajax({
         url: '<?php echo base_url('customer/tambahDeptAdam') ?>',
         type: 'post',
         data: {
           dept: val
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama departement sudah ada',
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
             $('#listDept').append('<option value="' + respon + '">' + val + '</option>');
             $('#listDept').selectpicker('refresh');
             $("#namaDept").val('');
             $('#dept').modal('hide');
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
   $(".tambahJabatan").on("click", ".submitDataJabatan", function() {
     var val = $("#namaJabatan").val().trim();
     if (val == '') {
       Swal({
         title: 'Oops...',
         text: 'Nama jabatan harus di isi',
         type: 'error',
         confirmButtonText: 'Tutup'
       })
     } else {
       $.ajax({
         url: '<?php echo base_url('customer/tambahJabatanAdam') ?>',
         type: 'post',
         data: {
           jabatan: val
         },
         success: function(respon) {
           if (respon == '0') {
             Swal({
               title: 'Oops...',
               text: 'Nama jabatan sudah ada',
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
             $('#listJabatan').append('<option value="' + respon + '">' + val + '</option>');
             $('#listJabatan').selectpicker('refresh');
             $("#namaJabatan").val('');
             $('#jabatan').modal('hide');
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