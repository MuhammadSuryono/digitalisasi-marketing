 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input User</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data User > Form Input New User</h6>
         </div>

         <div class="card-body">
             <form action="<?php echo base_url('user/tambah') ?>" method="POST" class="row">
                 <div class="col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">User</label>
                         <input type="text" name="user" class="form-control form-control-user <?php if(form_error('user')){ echo'is-invalid'; } ?>" placeholder="User" value="<?php echo set_value('user'); ?>">
                         <?php echo form_error('user', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Password</label>
                         <input type="password" name="password1" class="form-control form-control-user <?php if(form_error('password1')){ echo'is-invalid'; } ?>" placeholder="Password">
                         <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Repeat Password</label>
                         <input type="password" name="password2" class="form-control form-control-user" placeholder="Repeat password">

                     </div>
                     <div class="form-group">
                       <label for="user">Dept</label> - <a href="" data-toggle="modal" data-target="#dept">tambah</a>
                       <select name="dept" id="listDept" class="selectpicker show-tick form-control <?php if(form_error('dept')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih dept...">
                       <?php
                        $data = $this->Dept_model->getAllDept();
                        foreach ($data as $db) : ?>
          							<?php if (set_value('dept') == $db['id_dept'] ) { ?>
          							<option value="<?php echo $db['id_dept'] ?>" selected><?php echo $db['dept'] ?></option>
          							<?php }else{ ?>
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
                     <select name="jabatan" id="listJabatan" class="selectpicker show-tick form-control <?php if(form_error('jabatan')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih jabatan...">
                     <?php
                      $data = $this->Jabatan_model->getAllJabatan();
                      foreach ($data as $db) : ?>
                      <?php if (set_value('jabatan') == $db['id_jabatan'] ) { ?>
                      <option value="<?php echo $db['id_jabatan'] ?>" selected><?php echo $db['jabatan'] ?></option>
                      <?php }else{ ?>
                      <option value="<?php echo $db['id_jabatan'] ?>"><?php echo $db['jabatan'] ?></option>
                      <?php } ?>
                    <?php endforeach; ?>
                    </select>
                    <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                   </div>
                     <div class="form-group">
                         <label for="user">Email1</label>
                         <input type="text" name="email1" class="form-control form-control-user <?php if(form_error('email1')){ echo'is-invalid'; } ?> " placeholder="Email 1" value="<?php echo set_value('email1'); ?>">
                         <?php echo form_error('email1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Email2</label>
                         <input type="text" name="email2" class="form-control form-control-user" placeholder="Email 2" value="<?php echo set_value('email2'); ?>">
                         <?php echo form_error('email2', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="col-12 text-right">
                   <div class="form-group">
                       <button class="btn btn-primary" type="submit">Save</button>
                       <a href="<?php echo base_url('user') ?>" class=" btn btn-danger"> Back</a>
                   </div>
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

<script type="text/javascript">
$(".tambahDept").on("click", ".submitDataDept", function() {
  var val = $("#namaDept").val().trim();
  if(val == ''){
    Swal({
      title: 'Oops...',
      text: 'Nama departement harus di isi',
      type: 'error',
      confirmButtonText: 'Tutup'
    })
  }else{
    $.ajax({
        url: '<?php echo base_url('customer/tambahDeptAdam') ?>',
        type: 'post',
        data: {dept:val},
        success: function(respon) {
          if(respon == '0'){
            Swal({
              title: 'Oops...',
              text: 'Nama departement sudah ada',
              type: 'error',
              confirmButtonText: 'Tutup'
            })
          }else{
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
        error: function(jqXHR,error, errorThrown) {
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
  if(val == ''){
    Swal({
      title: 'Oops...',
      text: 'Nama jabatan harus di isi',
      type: 'error',
      confirmButtonText: 'Tutup'
    })
  }else{
    $.ajax({
        url: '<?php echo base_url('customer/tambahJabatanAdam') ?>',
        type: 'post',
        data: {jabatan:val},
        success: function(respon) {
          if(respon == '0'){
            Swal({
              title: 'Oops...',
              text: 'Nama jabatan sudah ada',
              type: 'error',
              confirmButtonText: 'Tutup'
            })
          }else{
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
        error: function(jqXHR,error, errorThrown) {
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
