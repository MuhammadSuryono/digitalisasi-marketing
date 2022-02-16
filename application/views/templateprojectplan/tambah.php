 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Detail Kegiatan > <?php echo $template['nama_template'] ?></h6>
         </div>

         <div class="card-body">
           <a href="javascript:void(0)" onclick="addKegiatan()" class="btn btn-primary mb-5">Tambah Kegiatan</a><br>
           <small class="text-danger">*Perhatikan urutan nama kegiatan</small>
           <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th class="text-center align-middle">No</th>
                       <th class="text-center align-middle">Nama Kegiatan</th>
                       <th class="text-center align-middle">Action</th>
                   </tr>
               </thead>
               <tbody>
                  <?php
                  $no= 1;
                  foreach ($detail as $data) {
                  ?>
                  <tr>
                      <td class="text-center align-middle"><?php echo $no ?></td>
                      <td class="text-left align-middle"><?php echo $data['nama_kegiatan'] ?></td>
                      <td class="text-center align-middle">
                          <a href="javascript:void(0)" onclick="editKegiatan(<?= $data['id_pp_master'].','.$data['id_pp_kegiatan'].','.$data['id_template_pp'];?>)" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('templateProjectPlan/hapusKegiatan/'.$data['id_pp_kegiatan'].'/'.$data['id_template_pp']) ?>" class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash fa-sm"></i></a>
                      </td>
                  </tr>
                  <?php
                  $no++;
                  }
                   ?>
               </tbody>
           </table>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 </div>

 <div class="modal fade" id="modalAddKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalAddKegiatan" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Add Kegiatan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form method="POST" id="formKegiatan">
               <input type="hidden" value="<?php echo $template['id_template_project'] ?>" name="id_template_pp">
             <div class="modal-body" id="bodyTambahKegiatan">
               <div class="form-group">
                 <label>Pilih Kegiatan</label>
                 <select name="id_pp_master" id="pilihKegiatan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih kegiatan" required>
                 <option value="tambahbaru" class="font-weight-bold">Tambah Kegiatan Baru</option>
                 <optgroup label="Pilih Salah Satu Kegiatan">
                 <?php
                   foreach ($master as $data){
                     echo '<option value="'.$data['id_pp_master'].'">'.$data['nama_kegiatan'].'</option>';
                   }
                 ?>
                 </optgroup>
                 </select>
               </div>
               <div class="form-group" id="kegiatanBaru">
                 <label>Nama Kegiatan</label>
                 <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukan Nama Kegiatan">
                 <div class="text-danger text-justify mt-2"><small>*Untuk meminimalisir duplikasi data. Sebaiknya kroscek kembali apakah kegiatan tersebut memang benar belum tersedia di form Pilih Kegiatan</small></div>
               </div>
               <!-- <div class="form-group">
                 <div class="custom-control custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="undangan" value="1">
                   <label class="custom-control-label" for="cekProposal">Cek jika kegiatan ingin ditambahkan form kirim undangan</label>
                 </div>
               </div> -->
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
 $('#pilihKegiatan').change(function(){
     const id = $(this).val();
     if(id == 'tambahbaru'){
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').val('');
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').attr('required', 'true');
       $('#kegiatanBaru').show();
     }else{
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').removeAttr('required');
       $('#kegiatanBaru').hide();
     }
 });


 function addKegiatan(){
   $('#formKegiatan').attr('action', '<?php echo base_url('templateProjectPlan/tambahKegiatan') ?>');
   $('#modalAddKegiatan').modal('show');
   $('#exampleModalLabel').text('Form Add Kegiatan');
   $('select[name=id_pp_master]').val('');
   $('.selectpicker').selectpicker('refresh');
   $('#kegiatanBaru').hide();
 }

 function editKegiatan(val,id,idpp){
   $('#formKegiatan').attr('action', '<?php echo base_url('templateProjectPlan/ubahKegiatan/') ?>'+id+'/'+idpp);
   $('#modalAddKegiatan').modal('show');
   $('#exampleModalLabel').text('Form Edit Kegiatan');
   $('select[name=id_pp_master]').val(val);
   $('.selectpicker').selectpicker('refresh');
   $('#kegiatanBaru').hide();
 }

 $(document).ready( function() {
   $('#dataTable').dataTable({searching: false, paging: false, info: false});
   $('#kegiatanBaru').hide();
 });
 </script>
